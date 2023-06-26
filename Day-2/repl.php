<?php

// Start the REPL loop
while (true) {
    // Display the prompt
    echo "> ";

    $input = trim(fgets(STDIN));

    if(strtolower($input) === 'exit') {
        break;
    }

    if(substr($input, 0, 4) === 'echo') {
        echo "> ";
        eval($input);
        echo PHP_EOL;
    } else {
        eval($input);
    }
}