<?php
session_start();
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}

require_once 'config.php';

$id = $_GET["id"];
$car = $rental_date = $return_date = "";

$sql = "SELECT * FROM rental_records WHERE id = $id AND user_id = " . $_SESSION["id"];
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $car = $row["car"];
    $rental_date = $row["rental_date"];
    $return_date = $row["return_date"];
} else {
    header("location: index.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $car = $_POST["car"];
    $rental_date = $_POST["rental_date"];
    $return_date = $_POST["return_date"];

    $sql = "UPDATE rental_records SET car = ?, rental_date = ?, return_date = ? WHERE id = ? AND user_id = ?";
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("sssii", $car, $rental_date, $return_date, $id, $_SESSION["id"]);
        if ($stmt->execute()) {
            header("location: index.php");
        } else {
            echo "Something went wrong. Please try again later.";
        }
        $stmt->close();
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
            <label>車輛品牌</label>
            <input type="text" name="car" value="<?php echo $car; ?>" required>
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
            <input type="submit" value="Submit">
        </div>
    </form>
</body>
</html>