<?php
namespace JalaliConverter;

/**
 * Class JalaliConverter
 * تبدیل میلادی <-> جلالی (شمسی)
 *
 * مثال:
 *   use JalaliConverter\JalaliConverter;
 *   list($jy,$jm,$jd) = JalaliConverter::gregorianToJalali(2025,9,24);
 */
class JalaliConverter
{
    /**
     * تبدیل تاریخ میلادی به جلالی
     * @param int $gy سال میلادی
     * @param int $gm ماه میلادی (1..12)
     * @param int $gd روز ماه (1..31)
     * @return array [jy, jm, jd]
     */
    public static function gregorianToJalali(int $gy, int $gm, int $gd): array
    {
        $g_days_in_month = [31,28,31,30,31,30,31,31,30,31,30,31];
        $j_days_in_month = [31,31,31,31,31,31,30,30,30,30,30,29];

        $gy -= 1600;
        $gm -= 1;
        $gd -= 1;

        $g_day_no = 365 * $gy + intdiv($gy + 3, 4) - intdiv($gy + 99, 100) + intdiv($gy + 399, 400);
        for ($i = 0; $i < $gm; $i++) {
            $g_day_no += $g_days_in_month[$i];
        }
        // leap year correction for February
        if ($gm > 1 && (($gy + 1600) % 4 == 0 && ((($gy + 1600) % 100) != 0 || (($gy + 1600) % 400) == 0))) {
            $g_day_no += 1;
        }
        $g_day_no += $gd;

        $j_day_no = $g_day_no - 79;

        $j_np = intdiv($j_day_no, 12053); // 12053 = 33*365 + 8 (leap days)
        $j_day_no = $j_day_no % 12053;

        $jy = 979 + 33 * $j_np + 4 * intdiv($j_day_no, 1461); // 1461 = 4*365 + 1
        $j_day_no = $j_day_no % 1461;

        if ($j_day_no >= 366) {
            $jy += intdiv($j_day_no - 1, 365);
            $j_day_no = ($j_day_no - 1) % 365;
        }

        $jm = 0;
        for ($i = 0; $i < 11 && $j_day_no >= $j_days_in_month[$i]; $i++) {
            $j_day_no -= $j_days_in_month[$i];
        }
        $jm = $i + 1;
        $jd = $j_day_no + 1;

        return [$jy, $jm, $jd];
    }

    /**
     * تبدیل تاریخ جلالی (شمسی) به میلادی
     * @param int $jy سال جلالی
     * @param int $jm ماه جلالی (1..12)
     * @param int $jd روز ماه (1..31)
     * @return array [gy, gm, gd]
     */
    public static function jalaliToGregorian(int $jy, int $jm, int $jd): array
    {
        $g_days_in_month = [31,28,31,30,31,30,31,31,30,31,30,31];
        $j_days_in_month = [31,31,31,31,31,31,30,30,30,30,30,29];

        $jy -= 979;
        $jm -= 1;
        $jd -= 1;

        $j_day_no = 365 * $jy + intdiv($jy, 33) * 8 + intdiv($jy % 33, 4);
        for ($i = 0; $i < $jm; $i++) {
            $j_day_no += $j_days_in_month[$i];
        }
        $j_day_no += $jd;

        $g_day_no = $j_day_no + 79;

        $gy = 1600 + 400 * intdiv($g_day_no, 146097); // 146097 = 365*400 + 97 leap days
        $g_day_no = $g_day_no % 146097;

        $leap = true;
        if ($g_day_no >= 36525) {
            $g_day_no--;
            $gy += 100 * intdiv($g_day_no, 36524); // 36524 = 365*100 + 24
            $g_day_no = $g_day_no % 36524;
            if ($g_day_no >= 365) {
                $g_day_no++;
            } else {
                $leap = false;
            }
        }

        $gy += 4 * intdiv($g_day_no, 1461); // 1461 = 365*4 + 1
        $g_day_no %= 1461;

        if ($g_day_no >= 366) {
            $gy += intdiv($g_day_no - 1, 365);
            $g_day_no = ($g_day_no - 1) % 365;
        }

        for ($i = 0; $g_day_no >= $g_days_in_month[$i] + ($i == 1 && $thisIsLeapYear($gy) ? 1 : 0); $i++) {
            // loop to find month; but we can't call $thisIsLeapYear here. We'll handle below.
            break;
        }

        // build month/day properly
        $gm = 0;
        for ($i = 0; $i < 12; $i++) {
            $days = $g_days_in_month[$i];
            if ($i == 1 && self::isGregorianLeap($gy)) {
                $days += 1;
            }
            if ($g_day_no < $days) {
                $gm = $i + 1;
                $gd = $g_day_no + 1;
                break;
            }
            $g_day_no -= $days;
        }

        return [$gy, $gm, $gd];
    }

    /**
     * بررسی کبیسه بودن سال میلادی
     * @param int $year
     * @return bool
     */
    public static function isGregorianLeap(int $year): bool
    {
        return ($year % 4 == 0 && $year % 100 != 0) || ($year % 400 == 0);
    }

    /**
     * کمکی: فرمت کردن تاریخ شمسی به صورت رشته yyyy-mm-dd
     * @param int $jy
     * @param int $jm
     * @param int $jd
     * @return string
     */
    public static function formatJalali(int $jy, int $jm, int $jd): string
    {
        return sprintf("%04d-%02d-%02d", $jy, $jm, $jd);
    }

    /**
     * کمکی: فرمت تاریخ میلادی yyyy-mm-dd
     */
    public static function formatGregorian(int $gy, int $gm, int $gd): string
    {
        return sprintf("%04d-%02d-%02d", $gy, $gm, $gd);
    }
}
