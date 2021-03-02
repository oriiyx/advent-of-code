<?php

declare(strict_types=1);

const lowestNumberPossible  = 0;
const largestNumberPossible = (2 ** 32) - 1;

$rawInputData   = file_get_contents('input-list.txt');
$arrayInputData = preg_split("/\s+/", $rawInputData);

//    $task = '5-8
//0-2
//4-7';
//    $chunks = preg_split("/\s+/", $task);

$jsonStream = fopen('number-collection.json', 'w');

saveDataIntoJsonFile($jsonStream);
//    getRemainingNumbers($chunks);

function saveDataIntoJsonFile($jsonStream)
{

    $rawSplitNumberInHalf = largestNumberPossible / 2;
    $firstHalfEnd         = intval(floor($rawSplitNumberInHalf));
    $firstQuarterStart           = intval(floor($firstHalfEnd / 2));
    $firstQuarterEnd           = intval(ceil($firstHalfEnd / 2));
    var_dump($firstQuarterStart);
    var_dump($firstQuarterEnd);
    $secondHalfStart      = intval(ceil($rawSplitNumberInHalf));

    insertDataIntoStream(lowestNumberPossible, $firstQuarterStart, $jsonStream);

    fclose($jsonStream);
}

/**
 * @param int $beginnerInteger
 * @param int $endingInteger
 * @param $jsonStream
 * @return bool
 */
function insertDataIntoStream(int $beginnerInteger, int $endingInteger, $jsonStream): bool
{
    $tempArray = array();

    //        for ($i = $beginnerInteger; $i <= $endingInteger; $i++) {
    for ($i = 0; $i <= 9; $i++) {
        array_push($tempArray, $i);
    }
    var_dump($tempArray);
    $jsonData          = json_encode($tempArray);
    $successfullyWrote = fwrite_stream($jsonStream, $jsonData);

    // Delete arrays from memory
    unset($tempArray);
    unset($jsonData);

    if ($successfullyWrote === false) {
        return false;
    }
    return true;
}

// Perform check to ensure whole string is written in case network stream ends before
function fwrite_stream($fp, $string)
{
    for ($written = 0; $written < strlen($string); $written += $fwrite) {
        $fwrite = fwrite($fp, substr($string, $written));
        if ($fwrite === false) {
            return $written;
        }
    }

    return $written;
}

function getRemainingNumbers($chunks)
{
    $jsonStream = fopen('number-collection.json', 'r+');
    $lineOfText = array();
    while (!feof($jsonStream)) {
        $lineOfText = json_decode(fgets($jsonStream));
    }

    foreach ($chunks as $range) {
        $rangeArray = explode('-', $range);
        foreach (range($rangeArray[0], $rangeArray[1]) as $item) {
            if (($key = array_search($item, $lineOfText)) !== false) {
                unset($lineOfText[$key]);
            }
        }
    }
}
