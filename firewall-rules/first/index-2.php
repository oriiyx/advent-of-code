<?php
    declare(strict_types=1);

    const lowestNumberPossible  = 0;
    const largestNumberPossible = (2 ** 32) - 1;
    const largestNumberPossible = 9;

    $rawInputData   = file_get_contents('input-list.txt');
    $arrayInputData = preg_split("/\s+/", $rawInputData);


    $task = '5-8
0-2
4-7';
    $chunks = preg_split("/\s+/", $task);

    function xrange($start, $limit, $step = 1) {
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

    foreach (xrange(lowestNumberPossible, largestNumberPossible, 1) as $number){
        print_r($number);
    }