<?php

$input = '';
$history = [];
$availableCommands = ['ls', 'pwd', 'echo', 'tail', 'cat', 'touch', 'mkdir', 'whoami', 'tail', 'grep', 'find', 'sed'];
echo "Unix commands like \e[1m".implode(', ', $availableCommands)."\e[0m are available.".PHP_EOL;
echo 'You can run multiple command using "|" operator.'.PHP_EOL;

while (strtolower($input) !== 'exit') {
    $input = readline("phpShell> ");
    array_push($history, $input);

    $inputs = explode(" ", $input);
    if(!in_array(trim($inputs[0]), $availableCommands) && strtolower($input) !== 'exit') {
        echo "Command not found". PHP_EOL;
    }
    executeShellCommand($input);
}

function executeShellCommand($input) {
    $response = shell_exec($input);
    echo $response.PHP_EOL;
}