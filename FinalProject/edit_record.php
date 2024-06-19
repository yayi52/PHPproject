<?php
session_start();
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}

require_once 'config.php';

$id = $_GET["id"];
$car = $rental_date = $return_date = $done = "";

$sql = "SELECT * FROM rental_records WHERE id = $id  ";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $car = $row["car"];
    $rental_date = $row["rental_date"];
    $return_date = $row["return_date"];
    $done = $row["done"];
} else {
    header("location: view_records.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $car = $_POST["car"];
    $rental_date = $_POST["rental_date"];
    $return_date = $_POST["return_date"];
    $done = $_POST["done"];

    $sql = "UPDATE rental_records SET car = '$car', rental_date = '$rental_date', return_date = '$return_date', done ='$done' WHERE id = $id ";
    if($result = $conn->query($sql)){
        header("location: view_records.php");
    }
    else {
        echo "Something went wrong. Please try again later.";
    }
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Record</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>更改紀錄</h2>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . "?id=" . $id; ?>" method="post">
        <div>
            <label for="brand">車輛品牌</label>
            <select id="brand" name="car" required>
            <option value="Toyota">Toyota
            <option value="Honda">Honda
            <option value="Ford">Ford
            <option value="BMW">BMW
            <option value="Audi">Audi
            </select><br><br>
        </div>
        <div>
            <label>租借日期</label>
            <input type="date" name="rental_date" value="<?php echo $rental_date; ?>" required>
        </div>
        <div>
            <label>歸還日期</label>
            <input type="date" name="return_date" value="<?php echo $return_date; ?>">
        </div>
        <div>
            <label>交車完成(Y/N)</label>
            <input type="radio" name="done" value="Y" checked>Y
            <input type="radio" name="done" value="N">N<br>
        </div>
        <div>
            <input type="submit" value="確定">
        </div>
    </form>
</body>
</html>