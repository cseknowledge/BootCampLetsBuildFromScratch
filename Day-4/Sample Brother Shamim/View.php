<?php
require_once('../../Day-3/CLI.php');
Class View {
    public function make($file, $data=null) {
        $content = file_get_contents($file.'.pte.php');

        $parsed_content = preg_replace('/{{/', '<?php', $content);
        $parsed_content = preg_replace('/}}/', '?>', $parsed_content);

        preg_match_all('/\$\w+/', $parsed_content, $variables);

        foreach ($variables[0] as $variable) {
            $parsed_content = str_replace($variable, 'echo "'. $data[ltrim($variable, "$")].'";', $parsed_content);
        }

        $compiled_file_name = $file.'_view.php';
        file_put_contents($compiled_file_name, $parsed_content);

        self::show($compiled_file_name);
    }

    public function show($compiled_file_name) {
        $cli = new CLI();

        $command = 'php '.$compiled_file_name;

        exec($command, $output, $returnCode);

        if ($returnCode === 0) {
            echo $cli->set_color("Script executed successfully: ". PHP_EOL, "green") . PHP_EOL;
            echo implode(PHP_EOL, $output). PHP_EOL;
        } else {
            echo $cli->set_color("An error occurred while executing the script.", "red") . PHP_EOL;
            echo $cli->set_color("Error code: $returnCode", "red") . PHP_EOL;
        }
    }
}

(new View)->make('index', ['title' => "Ahmed Shamim's Template Engine", 'name' => "Md. Arif Dewan"]);