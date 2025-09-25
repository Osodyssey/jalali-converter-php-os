<?php
use PHPUnit\Framework\TestCase;
use JalaliConverter\JalaliConverter;

final class JalaliConverterTest extends TestCase
{
    public function testGregorianToJalaliKnownDates()
    {
        // 2021-03-20 -> 1399-12-30 (end of 1399 in some years depending on leap)
        [$jy,$jm,$jd] = JalaliConverter::gregorianToJalali(2021, 3, 20);
        $this->assertEquals('2021-03-20', JalaliConverter::formatGregorian(2021,3,20));
        $this->assertIsInt($jy);
        $this->assertEquals(1399, $jy);

        // 2025-09-24 -> expected (example) check structure
        [$jy2,$jm2,$jd2] = JalaliConverter::gregorianToJalali(2025,9,24);
        $this->assertEquals(4, strlen((string)$jy2));
        $this->assertTrue($jm2 >= 1 && $jm2 <= 12);
        $this->assertTrue($jd2 >= 1 && $jd2 <= 31);
    }

    public function testIsGregorianLeap()
    {
        $this->assertTrue(JalaliConverter::isGregorianLeap(2020));
        $this->assertFalse(JalaliConverter::isGregorianLeap(1900));
        $this->assertTrue(JalaliConverter::isGregorianLeap(2000));
    }
}
