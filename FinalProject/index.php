<?php
session_start();
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}

require_once 'config.php';
$user_id = $_SESSION["id"];

$sql = "SELECT * FROM rental_records WHERE user_id = '$user_id'";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
    <link rel="stylesheet" href="style.css">
</head>
<body backgroun-color="#000000">
    <h1 align="center">你好, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>. 歡迎來到租車管理系統！<br><img src="car.jpg" alt="Car Image"></h1>    
    
    <h2>你的租車紀錄</h2>
    <a href="add_record.php">新增紀錄</a>
    <table>
        <tr>
            <th>車輛品牌</th>
            <th>始租日期</th>
            <th>歸還日期</th>
            <th>更改紀錄</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["car"] . "</td>";
                echo "<td>" . $row["rental_date"] . "</td>";
                echo "<td>" . $row["return_date"] . "</td>";
                echo "<td><a href='edit_record.php?id=" . $row["id"] . "'>Edit</a> | <a href='delete_record.php?id=" . $row["id"] . "'>Delete</a></td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='5'>No records found</td></tr>";
        }
        ?>
        
    </table>
    <br><p><a href="logout.php">登出</a></p>
    </div>
</body>
</html>
<?php $conn->close(); ?>