<?php
session_start();
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}

require_once 'config.php';

$id = $_GET["id"];
$sql = "DELETE FROM rental_records WHERE id = $id ";
$conn->query($sql);
$conn->close();
header("location: view_records.php");
exit;
?>