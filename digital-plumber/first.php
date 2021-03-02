<?php
$pipes = [
    0 => [
        2
    ],
    1 => [
        1
    ],
    2 => [
        0,
        3,
        4
    ],
    3 => [
        2,
        4
    ],
    4 => [
        2,
        3,
        6
    ],
    5 => [
        6
    ],
    6 => [
        4,
        5
    ]
];

$mappedPipes = [];

foreach ($pipes as $key => $pipe) {
    if ($key === 0) {
        array_push($mappedPipes, 0);
        foreach ($pipe as $item) {
            array_push($mappedPipes, $item);
        }
        continue;
    }
    foreach ($pipe as $item) {
        if (in_array($key, $mappedPipes)) {
            foreach ($mappedPipes as $mappedPipe) {
                array_push($mappedPipes, $item);
            }
        }

        foreach ($mappedPipes as $mappedPipe) {
            if ($item === $mappedPipe) {
                array_push($mappedPipes, $item);
            }
        }
    }

}
$mappedPipes = array_unique($mappedPipes);
var_dump($mappedPipes);
