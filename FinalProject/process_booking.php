<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $rental_date = $_POST['rental_date'];
    $brand = $_POST['brand'];

    // �o�̥i�H�B�z�ƾڡA�O�s��ƾڮw
    // ���F²��_���A�ڭ̱N���G��ܦb�����W
    echo "<h1>�w�����\</h1>";
    echo "<p>�w�����: " . htmlspecialchars($rental_date) . "</p>";
    echo "<p>�w���~�P: " . htmlspecialchars($brand) . "</p>";
} else {
    echo "<p>�бq��洣��w���C</p>";
}
?>
