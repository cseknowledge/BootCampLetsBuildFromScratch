
<?php
class TemplateCompiler {

    protected $data = [];
    public function compile($content, array $data) {
        $this->data = $data;
        $content = $this->parseIfStatements($content, $data);
        $content = $this->compileVariables($content, $data);
        return $content;
    }

    public function compileVariables($content, $data) {
        $content = preg_replace_callback('/\{\{(.+?)\}\}/', function ($matches) {
            $variable = trim($matches[1]);
            return $this->getValueForVariable($variable);
        }, $content);

        return $content;
    }

    protected function getValueForVariable($variable) {
        $keys = explode('.', $variable);
        $value = $this->data;
        foreach ($keys as $key) {
            if (isset($value[ltrim($key, "$")])) {
                $value = $value[ltrim($key, "$")];
            } else {
                return '';
            }
        }

        return $value;
    }

    protected function parseIfStatements($content, $data) {
        return $content;
    }

    protected function parseForStatements($content, $data) {
        return $content;
    }

    protected function parseForEachStatements($content, $data) {
        return $content;
    }
}