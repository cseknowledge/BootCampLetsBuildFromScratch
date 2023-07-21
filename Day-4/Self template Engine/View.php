
<?php

include '../../Day-3/CLI.php';
include 'TemplateCompiler.php';
include 'FileManager.php';

class View {

    static $cache_enabled = FALSE;
    protected $data = [];
    protected $sections = [];
    protected $layout;    
    protected $templatePath;
    static $cache_path = 'cache/';
    protected $templateCompiler;
    protected $fileManager;
    protected $cli;

    public function __construct($templatePath, TemplateCompiler $templateCompiler, FileManager $fileManager) {
        $this->templatePath = $templatePath;
        $this->templateCompiler = $templateCompiler;
        $this->fileManager = $fileManager;
        $this->cli = new CLI();
    }

    public function setData(array $data) {
        $this->data = $data;
    }

    public function make($file, $data = null) {
        if ($data !== null) {
            $this->setData($data);
        }

        $content = $this->getTemplateContent('pages/'.$file);
        $content = $this->includeSubviews($content, $data);
        $parsedContent = $this->templateCompiler->compile($content, $this->data);

        $compiledFileName = $this->fileManager->sanitizeFileName($file) . '_view.php';
        $this->fileManager->putContents($compiledFileName, $parsedContent);

        $this->evaluate($parsedContent);

        // $this->show($compiledFileName);
    }

    protected function getTemplateContent($template) {
        $templateFile = $this->templatePath . '/' . $this->templateExtension($template);
        return $this->fileManager->getContents($templateFile);
    }

    protected function templateExtension($template) {
        return $template . '.pte.php';
    }

    protected function includeSubviews($content, $data)
    {
         // Parse @extends
         $content = preg_replace_callback('/@extends\(\'(.*)\'\)/', function ($matches) {
            $layoutPath = $matches[1];
            $layoutPath = str_replace('.', '/', $layoutPath,);
            $this->layout = $matches[1];
            return $this->getTemplateContent($layoutPath);
        }, $content);

        // Parse @include
        $content = preg_replace_callback('/@include\(\'(.*)\'\)/', function ($matches) {
            $includePath = $matches[1];
            $includePath = str_replace('.', '/', $includePath,);
            return $this->getTemplateContent($includePath);
        }, $content);

        // Parse @section and @yield
        $content = preg_replace_callback('/@section\(\'(.*)\'\)([\s\S]*?)@endsection/', function ($matches) {
            $this->sections[$matches[1]] = trim($matches[2]);
            return '';
        }, $content);

        // Parse @yield
        $content = preg_replace_callback('/@yield\(\'(.*)\'\)/', function ($matches) {
            return $this->sections[$matches[1]] ?? '';
        }, $content);

        // Parse @if, @elseif, @else
        $content = preg_replace_callback('/@if\((.*)\)([\s\S]*?)@elseif\((.*)\)([\s\S]*?)@else([\s\S]*?)@endif/', function ($matches) {
            return $matches[1] ? $matches[2] : ($matches[3] ? $matches[4] : $matches[5]);
        }, $content);

        $content = preg_replace_callback('/@if\((.*)\)([\s\S]*?)@elseif\((.*)\)([\s\S]*?)@endif/', function ($matches) {
            return $matches[1] ? $matches[2] : ($matches[3] ? $matches[4] : '');
        }, $content);

        $content = preg_replace_callback('/@if\((.*)\)([\s\S]*?)@else([\s\S]*?)@endif/', function ($matches) {
            return $matches[1] ? $matches[2] : $matches[3];
        }, $content);

        $content = preg_replace_callback('/@if\((.*)\)([\s\S]*?)@endif/', function ($matches) {
            return $matches[1] ? $matches[2] : '';
        }, $content);

        // Replace Blade @foreach directive with PHP foreach loop
        $content = preg_replace('/@foreach\s*\((.*)\)/', '<?php foreach ($1): ?>', $content);
        $content = str_replace('@endforeach', '<?php endforeach; ?>', $content);

        // Replace Blade @for directive with PHP for loop
        $content = preg_replace('/@for\s*\((.*)\)/', '<?php for ($1): ?>', $content);
        $content = str_replace('@endfor', '<?php endfor; ?>', $content);

        // Replace Blade @while directive with PHP while loop
        $content = preg_replace('/@while\s*\((.*)\)/', '<?php while ($1): ?>', $content);
        $content = str_replace('@endwhile', '<?php endwhile; ?>', $content);

        // Replace Blade variables with PHP echo statements
        $content = preg_replace('/{{\s*(.*)\s*}}/', '<?php echo $1; ?>', $content);

        return $content;
    }

    public function show($compiled_file_name) {
        $command = 'php cache/'.$compiled_file_name;

        exec($command, $output, $returnCode);

        if ($returnCode === 0) {
            echo $this->cli->set_color("Script executed successfully: ". PHP_EOL, "green") . PHP_EOL;
            echo implode(PHP_EOL, $output). PHP_EOL;
        } else {
            echo $this->cli->set_color("An error occurred while executing the script.", "red") . PHP_EOL;
            echo $this->cli->set_color("Error code: $returnCode", "red") . PHP_EOL;
        }
    }

    public function evaluate($content) {
        echo $this->cli->set_color("Script executed successfully: ". PHP_EOL, "green") . PHP_EOL;
        extract($this->data);
        eval('?>' . $content);
    }

}


$items = ['item1' => 'Item 1', 'item2' => 'Item 2', 'item3' => 'Item 3'];


$templatePath = 'view';
$templateCompiler = new TemplateCompiler();
$fileManager = new FileManager();
$view = new View($templatePath, $templateCompiler, $fileManager);
$view->make('index', ['title' => "Ahmed Shamim's Template Engine", 'name' => "Md. Arif Dewan", 'user' => '', 'items' => $items]);
