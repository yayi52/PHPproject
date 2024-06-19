<?php
session_start();
require_once 'config.php';

$Account = $password = "";
$Account_err = $password_err = $system_err = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty(trim($_POST["Account"]))) {
        $Account_err = "請輸入帳號";
    } else {
        $Account = trim($_POST["Account"]);
    }

    if (empty(trim($_POST["password"]))) {
        $password_err = "請輸入密碼";
    } else {
        $password = trim($_POST["password"]);
    }
}
if (empty($Account_err) && empty($password_err)) {
    $sql = "SELECT id,username,account,password FROM users WHERE account = '$Account' and password = md5('$password')";
    $result =$conn->query($sql);
    if (!empty($result)) {
        if($result->num_rows ==1){
            $row = $result->fetch_assoc();
            $_SESSION["loggedin"] = true;
            $_SESSION["id"] = $row["id"];
            $_SESSION["username"] = $row["username"];
            $_SESSION["Account"] = $row["account"];
            $_SESSION["password"] = $row["password"];
            header("location: index.php");
        }
        else if(($conn->query("SELECT * from users where account = '$Account'"))->num_rows == 0 && 
        ($conn->query("SELECT * from users where password = md5('$password')"))->num_rows == 1){
            $Account_err = "帳號有誤!";
        }
        else if(($conn->query("SELECT * from users where password = md5('$password')"))->num_rows == 0 &&
        ($conn->query("SELECT * from users where account = '$Account'"))->num_rows == 1){
            $password_err = "密碼有誤!";
        }
    }
}
$conn->close();
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
    <h2>租車系統登入<br><img src="car1.jpg" alt="Car Image"></h2>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <div>
            <label>帳號：</label>
            <input type="text" name="Account" value="<?php echo $Account; ?>">
            <span><?php echo $Account_err; ?></span>
        </div>    
        <div>
            <label>密碼：</label>
            <input type="password" name="password">
            <span><?php echo $password_err; ?></span>
        </div>
        <div>
            <span><br></span>
            <input type="submit" value="登入">
            <a href="register.php">註冊</a>
            <a href="employee.php">員工登入</a>
        </div>
    </form>
    </div>
</body>
</html>