<?php

$inputData = file_get_contents('input.txt');
$numbers = explode("\n", $inputData);

foreach ($numbers as $i => $number) {
    $numbers[$i] = convertStingToBinary($number);
}

$lenFirst = strlen($numbers[0]);
$lenSecond = strlen($numbers[1]);

if ($lenFirst > $lenSecond) {
    echo '>';
    return;
}

if ($lenFirst < $lenSecond) {
    echo '<';
    return;
}

for ($i = 0; $i < $lenFirst; ++$i) {
    if ($numbers[0][$i] > $numbers[1][$i]) {
        echo '>';
        return;
    }

    if ($numbers[0][$i] < $numbers[1][$i]) {
        echo '<';
        return;
    }
}

echo '=';

function convertStingToBinary($string)
{
    return str_replace(
        ['zero', 'one'],
        ['0', '1'],
        $string
    );
}
