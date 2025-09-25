#!/usr/bin/env php
<?php
require __DIR__ . '/../vendor/autoload.php';
use JalaliConverter\JalaliConverter;

$argv = $_SERVER['argv'] ?? [];
if (count($argv) < 4) {
    echo "Usage: php convert.php <gy> <gm> <gd>\n";
    exit(1);
}
$gy = (int)$argv[1];
$gm = (int)$argv[2];
$gd = (int)$argv[3];

list($jy,$jm,$jd) = JalaliConverter::gregorianToJalali($gy,$gm,$gd);
echo "Gregorian: {$gy}-{$gm}-{$gd}\n";
echo "Jalali: " . JalaliConverter::formatJalali($jy,$jm,$jd) . "\n";
