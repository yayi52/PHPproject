<?php
session_start();
    $password = '';
    $password_err = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty(trim($_POST["nothing"]))){
        $password_err = "請輸入密碼";
    }
    else {
        $password = trim($_POST["nothing"]);
    }
}
if(!empty($password_err)){
    $_SESSION["loggedin"] = true;
    header("location: view_records.php");
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>會員登入</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
    <h2>租車系統登入</h2>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    <div>
            <label>員工密碼：</label>
            <input type="password" name="nothing">
            <span><?php echo $password_err; ?></span>
    </div>
    <div>
            <span><br></span>
            <input type="submit" value="確定">
            <a href="login.php">回登入頁</a>
    </div>