<?php
require __DIR__ . '/../vendor/autoload.php';

use JalaliConverter\JalaliConverter;

$today = new DateTime(); // الان سرور
list($jy,$jm,$jd) = JalaliConverter::gregorianToJalali(
    (int)$today->format('Y'),
    (int)$today->format('n'),
    (int)$today->format('j')
);

?>
<!doctype html>
<html lang="fa">
<head>
  <meta charset="utf-8">
  <title>نمونه تبدیل تاریخ</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <style>body{font-family: Tahoma, Arial; direction: rtl; padding:20px}</style>
</head>
<body>
  <h1>تبدیل تاریخ میلادی → شمسی</h1>
  <p>تاریخ امروز میلادی: <?= (new DateTime())->format('Y-m-d') ?></p>
  <p>معادل شمسی: <?= JalaliConverter::formatJalali($jy,$jm,$jd) ?></p>
  <hr/>
  <h2>تبدیل دستی</h2>
  <form method="get">
    <label>سال میلادی: <input name="gy" value="<?= htmlspecialchars($_GET['gy'] ?? '') ?>"></label>
    <label>ماه: <input name="gm" value="<?= htmlspecialchars($_GET['gm'] ?? '') ?>"></label>
    <label>روز: <input name="gd" value="<?= htmlspecialchars($_GET['gd'] ?? '') ?>"></label>
    <button type="submit">تبدیل</button>
  </form>

<?php
if (!empty($_GET['gy']) && !empty($_GET['gm']) && !empty($_GET['gd'])) {
    $gy = (int)$_GET['gy'];
    $gm = (int)$_GET['gm'];
    $gd = (int)$_GET['gd'];
    try {
        list($jy2,$jm2,$jd2) = JalaliConverter::gregorianToJalali($gy,$gm,$gd);
        echo "<p>نتیجه: " . JalaliConverter::formatJalali($jy2,$jm2,$jd2) . "</p>";
    } catch (Throwable $e) {
        echo "<p style='color:red'>خطا: " . htmlspecialchars($e->getMessage()) . "</p>";
    }
}
?>

</body>
</html>
