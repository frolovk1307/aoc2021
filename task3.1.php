<?php
$input = file_get_contents('./input3.txt');
$input = explode("\n", $input);

$bitThreshold = count($input) / 2;

$totals = [];
foreach ($input as $bitString) {
    foreach (array_filter(str_split($bitString)) as $index => $value) {
        $totals[$index] = ($totals[$index] ?? 0) + 1;
    }
}
ksort($totals);

$gamma = [];
$epsilon = [];
foreach ($totals as $index => $bitCount) {
    $bitValue = (int)($bitCount > $bitThreshold);
    $gamma[$index] = $bitValue;
    $epsilon[$index] = 1 - $bitValue;
}
$gamma = bindec(implode($gamma));
$epsilon = bindec(implode($epsilon));

$result = $gamma * $epsilon;
echo $result . "\n";
