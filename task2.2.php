<?php
$input = file_get_contents('./input2.txt');
$input = explode("\n", $input);

$horizontalOffset = 0;
$depth = 0;
$aim = 0;
foreach ($input as $commandInput) {
    [$command, $value] = explode(' ', $commandInput);
    switch ($command) {
        case 'forward':
            $horizontalOffset += $value;
            $depth += $aim * $value;
            break;
        case 'up':
            $aim -= $value;
            break;
        case 'down':
            $aim += $value;
            break;
    }
}

$result = $horizontalOffset * $depth;
echo $result . "\n";
