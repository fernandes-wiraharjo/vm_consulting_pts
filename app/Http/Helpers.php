<?php

function formatCurrency($value, $beforeValue = 'Rp', $afterValue = '') {
    $output = $beforeValue . number_format($value, 0, ',', '.') . $afterValue;

    return $output;
}

function multiplyTimeByNumber($time, $number) {
    $timeArray = explode(":", $time);
    $seconds = ($timeArray[0]) * 60 * 60 + ($timeArray[1]) * 60 + ($timeArray[2]);

    $result = ($seconds / 3600) * $number;

    return $result;
}
