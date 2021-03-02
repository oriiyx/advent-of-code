<?php

declare(strict_types=1);

const lowestNumberPossible  = 0;
const largestNumberPossible = (2 ** 32) - 1;

$rawInputData   = file_get_contents('input-list.txt');
$arrayInputData = preg_split("/\s+/", $rawInputData);

$task = '5-8
0-2
4-7';
$chunks = preg_split("/\s+/", $task);


foreach (xrange(lowestNumberPossible, 999, 1) as $number) {
    var_dump($number);
    $processedNumber = determineIfNumberIsOutOfRange(intval($number), $arrayInputData);

    if (!is_null($processedNumber)) {
        var_dump('Here is a number out of range: ' . $processedNumber);
    }
}



/**
 * Method determineIfNumberIsOutOfRange
 *
 * @param int $number 
 * @param array $ranges 
 *
 * @return int|null
 */
function determineIfNumberIsOutOfRange(int $number, array $ranges)
{
    $checkingState = false;

    foreach ($ranges as $range) {
        $checkingState = processANumberInRange($number, $range);

        if (!$checkingState) {
            return null;
        }
    }

    return $number;
}

/**
 * Method processANumberInRange
 *
 * @param int $number 
 * @param string $range 
 *
 * @return void
 */
function processANumberInRange(int $number, string $range): bool
{
    $rangeExploded = explode('-', $range);
    $rangeArray = range($rangeExploded[0], $rangeExploded[1]);

    if (in_array($number, $rangeArray)) {
        return false;
    }

    return true;
}

/**
 * Method xrange
 *
 * @param int $start 
 * @param int $limit 
 * @param int $step 
 *
 * @return Generator
 */
function xrange(int $start, int $limit, int $step = 1)
{
    if ($start <= $limit) {
        if ($step <= 0) {
            throw new LogicException('Step must be positive');
        }

        for ($i = $start; $i <= $limit; $i += $step) {
            yield $i;
        }
    } else {
        if ($step >= 0) {
            throw new LogicException('Step must be negative');
        }

        for ($i = $start; $i >= $limit; $i += $step) {
            yield $i;
        }
    }
}
