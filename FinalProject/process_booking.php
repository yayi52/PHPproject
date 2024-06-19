<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $rental_date = $_POST['rental_date'];
    $brand = $_POST['brand'];

    // 這裡可以處理數據，保存到數據庫
    // 為了簡單起見，我們將結果顯示在頁面上
    echo "<h1>預約成功</h1>";
    echo "<p>預約日期: " . htmlspecialchars($rental_date) . "</p>";
    echo "<p>預約品牌: " . htmlspecialchars($brand) . "</p>";
} else {
    echo "<p>請從表單提交預約。</p>";
}
?>
