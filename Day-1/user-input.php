<?php

$input1 = (int)readline("Give your first input: ");

$input2 = (int)readline("Give your second input: ");
if(is_numeric(isset($input1)) && is_numeric(isset($input2))) {
    echo "Total is: ".($input1+$input2);
} else {
    echo "You are not provided inputs correctly.";
}