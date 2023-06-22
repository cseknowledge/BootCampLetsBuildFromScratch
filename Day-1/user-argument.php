<?php

function ordinal($number) {
    $ends = array('th','st','nd','rd','th','th','th','th','th','th');
    if ((($number % 100) >= 11) && (($number%100) <= 13))
        return $number. 'th';
    else
        return $number. $ends[$number % 10];
}

$message = null;

for ($i=0; $i <count($argv) ; $i++) { 
    if($i==0) {
        continue;
    } else {
        $message .= 'Your '.ordinal($i).' argument is: '.$argv[$i]. PHP_EOL;
    }
}
echo $message;