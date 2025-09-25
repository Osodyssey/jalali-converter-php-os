# 📅 Jalali Converter for PHP / تبدیل تاریخ شمسی برای PHP

یک کتابخانه‌ی سبک، دقیق و ماژولار برای تبدیل تاریخ **میلادی (Gregorian)** به **جلالی/شمسی (Jalali/Shamsi)** و بالعکس.  
A lightweight and precise PHP library for converting **Gregorian dates** to **Jalali/Shamsi dates** and vice versa.

---

## ✨ ویژگی‌ها / Features
- 🔄 **دوطرفه / Two-way Conversion**: میلادی → شمسی و شمسی → میلادی  
- 📦 **ساختار استاندارد و ماژولار / Modular & PSR-4, Composer-ready**  
- 🖥️ **نمونه وب / Web Example**: داخل `public/index.php`  
- 🛠️ **CLI Tool**: استفاده در خط فرمان (`bin/convert.php`)  
- ✅ **تست واحد / Unit Tests**: با PHPUnit  
- 📖 **کد تمیز و مستند / Clean & Well-Documented Code**  

---

## 📂 ساختار پروژه / Project Structure
jalali-converter-php-os/
├─ .gitignore
├─ LICENSE
├─ composer.json
├─ README.md
├─ src/
│ └─ JalaliConverter.php
├─ public/
│ └─ index.php
├─ bin/
│ └─ convert.php
├─ tests/
│ └─ JalaliConverterTest.php

yaml
---

## 🚀 نصب و اجرا / Installation & Usage

### ۱. نصب وابستگی‌ها / Install Dependencies
bash
composer install
۲. استفاده در کد / Usage in Code
php
require 'vendor/autoload.php';

use JalaliConverter\JalaliConverter;

list($jy, $jm, $jd) = JalaliConverter::gregorianToJalali(2025, 9, 24);
echo "Jalali: " . JalaliConverter::formatJalali($jy, $jm, $jd);
// خروجی: 1404-07-02
🌐 اجرای نمونه وب / Run Web Example
bash
php -S localhost:8000 -t public
بعد برو به: http://localhost:8000

💻 اجرای CLI / Run CLI Tool
bash
php bin/convert.php 2025 9 24
خروجی / Output:

yaml
Gregorian: 2025-9-24
Jalali: 1404-07-02
🧪 تست‌ها / Run Tests
bash
./vendor/bin/phpunit --testdox
🔧 توابع کلیدی / Key Functions
gregorianToJalali($gy, $gm, $gd) → تبدیل میلادی به شمسی / Convert Gregorian to Jalali

jalaliToGregorian($jy, $jm, $jd) → تبدیل شمسی به میلادی / Convert Jalali to Gregorian

isGregorianLeap($year) → بررسی سال کبیسه میلادی / Check Gregorian Leap Year

formatJalali($jy, $jm, $jd) → خروجی رشته‌ای شمسی / Jalali formatted string (YYYY-MM-DD)

formatGregorian($gy, $gm, $gd) → خروجی رشته‌ای میلادی / Gregorian formatted string (YYYY-MM-DD)

📜 لایسنس / License
انتشار تحت لایسنس MIT.
MIT License — free to use for personal or commercial projects.

🤝 مشارکت / Contributing
پروژه متن‌باز است.
This is an Open-Source project.

Pull Request بدهید 🚀 / Submit a Pull Request

Bug Report باز کنید 🐛 / Open an Issue

به بهبود README و تست‌ها کمک کنید 📑 / Help improve docs and tests

⭐️ حمایت / Support
اگر این پروژه به کارتان آمد، ⭐️ روی ریپو بزنید تا افراد بیشتری آن را ببینند.
If you find this project useful, give it a ⭐️ to help more people discover it.
