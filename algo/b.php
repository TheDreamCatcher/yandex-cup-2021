<?php

$inputData = file_get_contents('input.txt');
$data = explode("\n", $inputData);
$picture = [];

$k = $data[0];
$plate = [];
$plateSet = [];

for ($i = 1; $i <= $k * 2; $i += 2) {
    $plate[0] = $data[$i];
    $plate[1] = $data[$i + 1];

    $hash = getHashForPlate($plate);
    if (empty($plateSet[$hash])) {
        $plateSet[$hash] = 0;
    }
    $plateSet[$hash]++;
}

$rowNumber = $k * 2 + 1;
list($n, $m) = explode(' ', $data[$rowNumber]);

$rowNumber++;

for ($i = 0; $i < $n; $i += 2) {
    for ($j = 0; $j < $m; $j += 2) {
        $plate[0][0] = $data[$rowNumber + $i][$j];
        $plate[0][1] = $data[$rowNumber + $i][$j + 1];
        $plate[1][0] = $data[$rowNumber + $i + 1][$j];
        $plate[1][1] = $data[$rowNumber + $i + 1][$j + 1];

        $hash = getHashForPlate($plate);

        if (empty($plateSet[$hash])) {
            echo 'No';
            return;
        }

        $plateSet[$hash]--;
    }
}

echo 'Yes';

function getHashForPlate($plate)
{
    $currentHash = $plate[0][0] . $plate[0][1] . $plate[1][1] . $plate[1][0];
    $resultHash = $currentHash;

    for ($i = 0; $i < 3; ++$i) {
        $lastChar = $currentHash[3];
        $currentHash = $lastChar . substr($currentHash, 0, 3);

        if ($resultHash < $currentHash) {
            $resultHash = $currentHash;
        }
    }
    return $resultHash;
}
