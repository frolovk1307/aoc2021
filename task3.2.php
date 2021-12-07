<?php
$input = file_get_contents('./input3.txt');
$input = explode("\n", $input);

$biCriteriaReducerForOxygen = fn(array $bits) => (int)(array_sum($bits) >= (count($bits) / 2));
$biCriteriaReducerForCo2 = fn(array $bits) => (int)(array_sum($bits) < (count($bits) / 2));

$reportValuesReducer = function ($values, $bitCriteriaReducer) {
    $position = 0;
    while (count($values) > 1) {
        $bitCriteria = $bitCriteriaReducer(array_column($values, $position));
        $values = array_filter($values, fn($value) => $value[$position] === $bitCriteria);
        $position++;
    }

    return array_shift($values);
};

$matrix = array_map(fn($binaryStr) => array_map('intval', str_split($binaryStr)), $input);

$oxygenRating = bindec(implode($reportValuesReducer($matrix, $biCriteriaReducerForOxygen)));
$co2rating = bindec(implode($reportValuesReducer($matrix, $biCriteriaReducerForCo2)));

$result = $oxygenRating * $co2rating;

echo $result . "\n";
