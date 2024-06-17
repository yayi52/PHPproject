<?php
session_start();
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}

require_once 'config.php';

$id = $_GET["id"];
$sql = "DELETE FROM rental_records WHERE id = ? AND user_id = ?";
if ($stmt = $conn->prepare($sql)) {
    $stmt->bind_param("ii", $id, $_SESSION["id"]);
    $stmt->execute();
    $stmt->close();
}

$conn->close();
header("location: index.php");
exit;
?>