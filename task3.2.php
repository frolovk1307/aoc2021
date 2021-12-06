<?php
$input = file_get_contents('./input3.txt');
$input = explode("\n", $input);

$matrix = array_map(fn($binaryStr) => array_map('intval', str_split($binaryStr)), $input);

$oxygenRating = 0;
$co2rating = 0;

$currentPosition = 0;

$count = array_sum(array_column($matrix, $currentPosition));

$oxygenRows = [];
$co2Rows = [];
foreach ($matrix as $matrixRow) {
    $bit = $matrixRow[$currentPosition];


}

//echo $result . "\n";
