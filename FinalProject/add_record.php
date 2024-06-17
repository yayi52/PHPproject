<?php
session_start();
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}

require_once 'config.php';

$car = $rental_date = $return_date = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_SESSION["id"];
    $car = $_POST["car"];
    $rental_date = $_POST["rental_date"];
    $return_date = $_POST["return_date"];

    if(!empty($return_date)){
        $sql = "INSERT INTO rental_records (user_id, car, rental_date, return_date) VALUES ('$id', '$car', '$rental_date', '$return_date')";
    }
    else {
        $sql = "INSERT INTO rental_records (user_id, car, rental_date) VALUES ('$id', '$car', '$rental_date')";
    }
    $conn ->query($sql);
    header("location: index.php");
    $conn->close();
}
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Record</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>新增租車紀錄</h2>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <div>
            <label>車輛品牌：</label>
            <input type="text" name="car" required>
        </div>
        <div>
            <label>租借日期：</label>
            <input type="date" name="rental_date" required>
        </div>
        <div>
            <label>歸還日期：</label>
            <input type="date" name="return_date">
        </div>
        <div>
            <input type="submit" value="登錄">
        </div>
    </form>
</body>
</html>