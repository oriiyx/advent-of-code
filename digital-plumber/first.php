<?php

$pipes = array();

$handle = fopen("input.txt", "r");

if ($handle) {
    while (!feof($handle)) {
        $line = fgets($handle);

        $explodedString = explode(' <-> ', $line);
        $secondaryIntegers = explode(',', $explodedString[1]);

        foreach ($secondaryIntegers as $integer) {
            $pipes[intval($explodedString[0])][] = intval($integer);
        }
    }
}

fclose($handle);

$mappedPipes = array();

arrayChecker($mappedPipes, $pipes);

function arrayChecker(array $mappedPipes, array $pipes)
{
    $oldArray = $mappedPipes;

    $mappedPipes = getPipes($pipes, $mappedPipes);

    $mappedPipes = array_unique($mappedPipes);

    if (array_values($oldArray) == array_values($mappedPipes)) {
        var_dump('same');
        var_dump(count($mappedPipes));
    } else {
        unset($oldArray);
        arrayChecker($mappedPipes, $pipes);
    }
}

function getPipes(array $pipes, array $mappedPipes): array
{
    foreach ($pipes as $key => $pipe) {
        if ($key === 0) {
            array_push($mappedPipes, 0);
            foreach ($pipe as $item) {
                array_push($mappedPipes, $item);
            }
            $mappedPipes = array_unique($mappedPipes);
            continue;
        }
        foreach ($pipe as $item) {
            if (in_array($key, $mappedPipes)) {
                array_push($mappedPipes, $item);
            }

            foreach ($mappedPipes as $mappedPipe) {
                if ($item === $mappedPipe) {
                    array_push($mappedPipes, $item);
                }
            }
            $mappedPipes = array_unique($mappedPipes);
        }
    }

    return $mappedPipes;
}