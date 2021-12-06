<?php
$input = file_get_contents('./input1.txt');
$input = explode("\n", $input);

$increasesCount = 0;
$windowSize = 3;
$index = 0;

do {
    $windowA = array_slice($input, $index, $windowSize);
    $windowB = array_slice($input, $index + 1, $windowSize);
    $index++;
    $sumA = array_sum($windowA);
    $sumB = array_sum($windowB);
    $increasesCount += $sumA < $sumB ? 1 : 0;
} while (count($windowA) === 3 and count($windowB) === 3);

echo $increasesCount . "\n";
