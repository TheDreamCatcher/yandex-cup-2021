<?php

$inputData = file_get_contents('input.txt');
[$n, $m] = explode(' ',$inputData);

$mx = [];

$set = [];

$z = 1;
for ($i = 0; $i < $n; ++$i) {
    for ($j = 0; $j < $m; ++$j) {
        $set[$z] = 1;

        $mx[$i][$j] = $z++;
    }
}


while ($n * $m > 1) {
    if ($m > $n) {
        $m /= 2;
        for ($i = 0; $i < $n; ++$i) {
            for ($j = 0; $j < $m; ++$j) {
                $mx[$i][$j] += $mx[$i][$m * 2 - 1 - $j];
                $set[$mx[$i][$j]] = 1;
            }
        }
    } else {
        $n /= 2;
        for ($j = 0; $j < $m; ++$j) {
            for ($i = 0; $i < $n; ++$i) {
                $mx[$i][$j] += $mx[$n * 2 - 1 - $i][$j];
                $set[$mx[$i][$j]] = 1;
            }
        }
    }
}

echo count($set);
