<?php
$input = file_get_contents('./input4.txt');
$input = explode("\n\n", $input);

$cardCardinality = 5;

$inputValues = explode(",", array_shift($input));

$cards = array_map(function ($cardAsString) use ($cardCardinality) {
    $cardAsString = preg_replace('/\h{2,}/', ' ', $cardAsString);
    $rowStrings = explode("\n", $cardAsString);
    $rowStrings = array_map('trim', $rowStrings);

    return [
        'values' => array_map(fn($row) => explode(" ", $row), $rowStrings),
        'markedValues' => [],
        'filledCounts' => [
            'rows' => array_fill(0, $cardCardinality, 0),
            'columns' => array_fill(0, $cardCardinality, 0),
        ],
    ];
}, $input);

foreach ($inputValues as $inputValue) {
    foreach ($cards as $cardIndex => &$card) {
        foreach ($card['values'] as $rowIndex => $rowValues) {
            foreach ($rowValues as $columnIndex => $value) {
                if ($value == $inputValue) {
                    if (!isset($card['filledCounts']['columns'][$columnIndex])) {
                        var_dump($rowValues);
                        die;
                    }

                    array_push($card['markedValues'], $inputValue);
                    $card['filledCounts']['rows'][$rowIndex] += 1;
                    $card['filledCounts']['columns'][$columnIndex] += 1;

                    if (
                        $card['filledCounts']['rows'][$rowIndex] == $cardCardinality
                        || $card['filledCounts']['columns'][$columnIndex] == $cardCardinality
                    ) {
                        if (count($cards) > 1) {
                            unset($cards[$cardIndex]);
                            break 2;
                        }

                        $unmarkedValues = array_merge(...$card['values']);
                        $unmarkedValues = array_diff($unmarkedValues, $card['markedValues']);

                        $result = $inputValue * array_sum($unmarkedValues);

                        break 4;
                    }
                }
            }
        }
    }
}

echo $result . "\n";
