<?php
$input = file_get_contents('./input2.txt');
$input = explode("\n", $input);

$horizontalOffset = 0;
$depth = 0;
foreach ($input as $commandInput) {
    [$command, $value] = explode(' ', $commandInput);
    switch ($command) {
        case 'forward':
            $horizontalOffset += $value;
            break;
        case 'up':
            $depth -= $value;
            break;
        case 'down':
            $depth += $value;
            break;
    }
}

$result = $horizontalOffset * $depth;
echo $result . "\n";
