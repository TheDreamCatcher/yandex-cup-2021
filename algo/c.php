<?php

$maxTimeOut = 2;

while (true) {
    $start = microtime(true);
    generateTest();

    $inputData = file_get_contents('input.txt');
    $data = explode("\n", $inputData);

    $k = $data[0];

    $a = explode(' ', $data[1]);
    $b = explode(' ', $data[2]);

    $totalAmountOfBalls = array_sum($a);
    $totalBoxes = $totalAmountOfBalls;

    for ($i = 0; $i < $k; ++$i) {
        if ($b[$i] != 0) {
            $totalBoxes = min(
                $totalBoxes,
                (int) ($a[$i] / $b[$i])
            );
        }
    }

    if ($totalBoxes < 1) {
        echo '0';
        die();
    }

    while ($totalAmountOfBalls / $totalBoxes != (int) ($totalAmountOfBalls / $totalBoxes)) {
        $totalBoxes--;

        if ($totalBoxes < 1) {
            echo '1';
            die();
        }
    }

    $ballsInBox = $totalAmountOfBalls / $totalBoxes;

    $freeBalls = [];

    for ($i = 0; $i < $k; ++$i) {
        $freeBalls[$i] = $a[$i] - $b[$i] * $totalBoxes;
    }

    $freeColor = 0;

    $result = $totalBoxes . ' ' . $ballsInBox . PHP_EOL;

    for ($box = 0; $box < $totalBoxes; $box++) {
        $needToFeel = $ballsInBox;

        for ($color = 0; $color < $k; $color++) {
            if ($b[$color] > 0) {
                $needToFeel -= $b[$color];
                for ($j = 0; $j < $b[$color]; $j++) {
                    $result .= ($color + 1) . ' ';
                }
            }
        }

        while ($needToFeel > 0) {

            $end = microtime(true);

            if ($end - $start > $maxTimeOut) {
                echo 'timelimit 0';
                die();
            }

            if ($freeBalls[$freeColor] > 0) {
                $result .= ($freeColor + 1) . ' ';
                $freeBalls[$freeColor]--;
                $needToFeel--;
            } else {
                $freeColor++;
            }

            if ($freeColor >= $k) {
                echo '2';
                die();

            }
        }

        $end = microtime(true);

        if ($end - $start > $maxTimeOut) {
            echo 'timelimit 1';
            die();
        }

        $result .= PHP_EOL;
    }

    if (validateResult($result)) {
        if ($end - $start > $maxTimeOut) {
            echo 'timelimit 1';
            die();
        }

        echo 'Valid ' . number_format($end - $start, 3) . ' ' . date('H:i:s') . PHP_EOL;
    } else {
        echo 'FOUND!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!';
        die();
    }
}

function validateResult($result)
{
    $data = explode("\n", trim($result));
    [$boxCount, $ballsCount] = explode(' ', trim($data[0]));

    if ($boxCount != count($data) - 1) {
        return false;
    }

    for ($i = 1; $i <= $boxCount; ++$i) {
        if ($ballsCount != count(explode(' ', trim($data[$i])))) {
            return false;
        }

    }

    return true;
}

function generateTest()
{
    $k = random_int(1, 100000);
    $a = [];
    $b = [];
    $total = 100000;

    for ($i = 0; $i < $k; ++$i) {
        $a[$i] = random_int(1, max(1, min($total, 100000)));
        $total -= $a[$i];
        $b[$i] = random_int(0, $a[$i]);
    }

    file_put_contents('input.txt',
        "{$k}\n" . implode(' ', $a) . "\n" . implode(' ', $b)
    );
}
