<?php
session_start();
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}

require_once 'config.php';

$sql = "SELECT rental_records.id, users.username, rental_records.car, rental_records.rental_date, rental_records.return_date FROM rental_records JOIN users ON rental_records.user_id = users.id";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>All Rental Records</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>所有的租借紀錄<br><img max-width= "10%" src="car2..jpg" alt="Car Image"></h2>
    <a href="login.php">回首頁</a>
    <table>
        <tr>
            <th>計數</th>
            <th>使用者名稱</th>
            <th>車輛品牌</th>
            <th>租借日期</th>
            <th>歸還日期</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["id"] . "</td>";
                echo "<td>" . $row["username"] . "</td>";
                echo "<td>" . $row["car"] . "</td>";
                echo "<td>" . $row["rental_date"] . "</td>";
                echo "<td>" . $row["return_date"] . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='5'>No records found</td></tr>";
        }
        ?>
    </table>
</body>
</html>
<?php $conn->close(); ?>