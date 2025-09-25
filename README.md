# 📅 Jalali Converter for PHP  
یک کتابخانه‌ی سبک، دقیق و ماژولار برای تبدیل تاریخ **میلادی (Gregorian)** به **جلالی/شمسی (Jalali/Shamsi)** و بالعکس.  

---

## ✨ ویژگی‌ها
- 🔄 تبدیل دوطرفه: میلادی → شمسی و شمسی → میلادی  
- 📦 ساختار استاندارد و ماژولار (PSR-4, Composer-ready)  
- 🖥️ نمونه تحت وب (داخل `public/index.php`)  
- 🛠️ ابزار CLI برای استفاده در خط فرمان (`bin/convert.php`)  
- ✅ پوشش تست واحد (Unit Test) با PHPUnit  
- 📖 کد تمیز و مستند برای توسعه و یادگیری  

---

## 📂 ساختار پروژه
jalali-converter-php/
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
Copy code

---

## 🚀 نصب و اجرا

### ۱. نصب وابستگی‌ها
```bash
composer install
۲. استفاده در کد
php
require 'vendor/autoload.php';

use JalaliConverter\JalaliConverter;

list($jy, $jm, $jd) = JalaliConverter::gregorianToJalali(2025, 9, 24);
echo "Jalali: " . JalaliConverter::formatJalali($jy, $jm, $jd);
// خروجی: 1404-07-02
🌐 اجرای نمونه وب
bash
Copy code
php -S localhost:8000 -t public
بعد برو به:
👉 http://localhost:8000

💻 اجرای CLI
bash
Copy code
php bin/convert.php 2025 9 24
خروجی:

yaml
Copy code
Gregorian: 2025-9-24
Jalali: 1404-07-02
🧪 تست‌ها
bash
Copy code
./vendor/bin/phpunit --testdox
🔧 توابع کلیدی
gregorianToJalali($gy, $gm, $gd) → تبدیل میلادی به شمسی

jalaliToGregorian($jy, $jm, $jd) → تبدیل شمسی به میلادی

isGregorianLeap($year) → بررسی سال کبیسه میلادی

formatJalali($jy, $jm, $jd) → خروجی رشته‌ای شمسی (YYYY-MM-DD)

formatGregorian($gy, $gm, $gd) → خروجی رشته‌ای میلادی (YYYY-MM-DD)

📜 لایسنس
انتشار تحت لایسنس MIT.
شما آزادید برای هر نوع پروژه (شخصی یا تجاری) استفاده کنید.

🤝 مشارکت
پروژه بازمتن (Open Source) است.

Pull Request بدهید 🚀

Bug Report باز کنید 🐛

یا به بهبود README و تست‌ها کمک کنید 📑

⭐️ حمایت
اگر این پروژه به کارتان آمد، ⭐️ روی ریپو بزنید تا افراد بیشتری آن را ببینند.

yaml
---

این README برای GitHub خیلی شیک و کامل دیده می‌شه (با ایموجی، ساختار بخش‌بندی و کد نمونه).  

می‌خوای همین رو **فارسی + انگلیسی دوزبانه** کنم تا پروژه‌ت حرفه‌ای‌تر دیده بشه؟
