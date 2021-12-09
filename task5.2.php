<?php
$input = file_get_contents('./input5.txt');
$input = explode("\n", $input);

$input = array_map(function ($input) {
    preg_match('/(\d+)\D*(\d+)\D*(\d+)\D*(\d+)/', $input, $matches);
    return array_combine(
        ['x1', 'y1', 'x2', 'y2'],
        array_map('intval', array_slice($matches, 1))
    );
}, $input);

//$xValues = array_unique(array_merge(array_column($input, 'x1'), array_column($input, 'x2')));
//$yValues = array_unique(array_merge(array_column($input, 'y1'), array_column($input, 'y2')));
//$extremes = [
//    'minX' => min($xValues),
//    'maxX' => max($xValues),
//    'minY' => min($yValues),
//    'maxY' => max($yValues),
//];
//
//$heightsMap = array_fill(
//    $extremes['minX'],
//    $extremes['maxX'] - $extremes['minX'] + 1,
//    array_fill($extremes['minY'], $extremes['maxY'] - $extremes['minY'] + 1, 0)
//);
//
//$drawMap = function () use ($extremes, &$heightsMap) {
//    $minX = $extremes['minX'];
//    $maxX = min($extremes['maxX'], 200);
//    $minY = $extremes['minY'];
//    $maxY = min($extremes['maxY'], 200);
//    for ($y = $minY; $y <= $maxY; $y++) {
//        for ($x = $minX; $x <= $maxX; $x++) {
//            echo empty($heightsMap[$x][$y]) ? '.' : ($heightsMap[$x][$y] > 9 ? '^' : $heightsMap[$x][$y]);
//        }
//        echo "\n";
//    }
//};

$dangerAreasCount = 0;
foreach ($input as $line) {
    $xStepModifier = $line['x2'] <=> $line['x1'];
    $yStepModifier = $line['y2'] <=> $line['y1'];

    if (
        $line['x1'] !== $line['x2']
        && $line['y1'] !== $line['y2']
        && abs($line['x1'] - $line['x2']) !== abs($line['y1'] - $line['y2'])
    ) {
        continue;
    }

    $x = $line['x1'];
    $y = $line['y1'];
    do {
        $heightsMap[$x][$y] = ($heightsMap[$x][$y] ?? 0) + 1;

        if ($heightsMap[$x][$y] === 2) { //at least two
            $dangerAreasCount++;
        }

        $x += $xStepModifier;
        $y += $yStepModifier;
    } while ($x !== ($line['x2'] + $xStepModifier) || $y !== ($line['y2'] + $yStepModifier));
}

echo $dangerAreasCount . "\n";