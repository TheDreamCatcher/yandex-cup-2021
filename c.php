<?php

$inputData = file_get_contents('input.txt');
$data = explode("\n", $inputData);

$k = $data[0];

$a = explode(' ', $data[1]);
$b = explode(' ', $data[2]);

$totalAmountOfBalls = array_sum($a);
$totalBoxes = $totalAmountOfBalls;

$freeBalls = [];

for ($i = 0; $i < $k; ++$i) {
    if ($b[$i] != 0) {
        $totalBoxes = min(
            $totalBoxes,
            (int) ($a[$i] / $b[$i])
        );
    }
}

while ($totalAmountOfBalls / $totalBoxes != (int) ($totalAmountOfBalls / $totalBoxes)) {
    $totalBoxes--;
}

$ballsInBox = $totalAmountOfBalls / $totalBoxes;

for ($i = 0; $i < $k; ++$i) {
    $freeBalls[$i] = $a[$i] - $b[$i] * $totalBoxes;
}

$freeColor = 0;

echo $totalBoxes . ' ' . $ballsInBox . PHP_EOL;

for ($i = 0; $i < $totalBoxes; $i++) {
    $needToFeel = $ballsInBox;

    for ($color = 0; $color < $k; $color++) {
        if ($b[$color] > 0) {
            $needToFeel -= $b[$color];
            for ($j = 0; $j < $b[$color]; $j++) {
                echo ($color + 1) . ' ';
            }
        }
    }

    while ($needToFeel > 0) {
        if ($freeBalls[$freeColor]) {
            echo ($freeColor + 1) . ' ';
            $freeBalls[$freeColor]--;
            $needToFeel--;
        } else {
            $freeColor++;
        }
    }

    echo PHP_EOL;
}
