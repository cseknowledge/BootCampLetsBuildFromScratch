<?php

$input = '';
$history = [];
echo "Unix commands like ls, pwd, echo, tail, cat, touch, mkdir, whoami, tail are available.".PHP_EOL;
echo 'You can run multiple command using "|" operator.'.PHP_EOL;
while (strtolower($input) !== 'exit') {
    $input = readline("phpShell> ");
    array_push($history, $input);
    if(strpos($input, '|') !== false) {
        $inputs = explode("|", $input);
        for ($i=0; $i <count($inputs) ; $i++) {
            executeShellCommand(trim($inputs[$i]));
        }
    } else {
        executeShellCommand($input);
    }
}

function executeShellCommand($input) {
    switch ($input) {
        case substr($input, 0, 2) === 'ls':
            exec($input, $output);
            foreach($output as $value) {
                echo $value. PHP_EOL;
            }
            break;
        case'free':
            exec($input, $output);
            foreach($output as $value) {
                echo $value. PHP_EOL;
            }
            break;
        case 'pwd':
            echo  exec($input).PHP_EOL;
            break;
        case substr($input, 0, 4) === 'echo':
            echo  exec($input).PHP_EOL;
            break;
        case substr($input, 0, 4) === 'tail': // tail -n 10 /you/file/full/path/here
            echo  exec($input).PHP_EOL;
            break;
        case substr($input, 0, 3) === 'cat': // cat /var/log/mail.log 2>&1
            echo  exec($input).PHP_EOL;
            break;
        case substr($input, 0, 5) === 'mkdir':
            echo  exec($input).PHP_EOL;
            break;
        case substr($input, 0, 5) === 'touch':
            echo  exec($input).PHP_EOL;
            break;
        case 'whoami':
            echo  exec($input).PHP_EOL;
            break;
        case 'exit':
            break;
        case 'history':
            array_pop($history);
            foreach($history as $value) {
                echo $value. PHP_EOL;
            }
            break;
        default:
            echo "Command not found". PHP_EOL;
    }
}