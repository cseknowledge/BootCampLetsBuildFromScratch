<?php

while (true) {
    echo "> ";

    $input = trim(fgets(STDIN));

    if (empty($input)) {
        continue;
    }

    if ($input === 'exit') {
        break;
    }

    while (!empty($input) && substr_count($input, '{') !== substr_count($input, '}')) {
        $nextLine = readline('  ');
        $input .= "\n" . $nextLine;
    }

    if (!str_ends_with($input, ';')) {
        $input = $input . ";";
    }

    if(substr($input, 0, 4) === 'echo' || substr($input, 0, 7) === 'print_r') {
        echo "> ";
        eval($input);
        echo PHP_EOL;
    } else {
        eval($input);
    }
}

?>