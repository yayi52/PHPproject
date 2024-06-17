<?php
require_once 'config.php';

$username = $password =  $account = "";
$username_err = $password_err = $account_err = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty(trim($_POST["username"]))) {
        $username_err = "請輸入使用者名稱";
    } else {
        $sql = "SELECT id FROM users WHERE username = ?";
        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("s", $param_username);
            $param_username = trim($_POST["username"]);
            if ($stmt->execute()) {
                $stmt->store_result();
                if ($stmt->num_rows == 1) {
                    $username_err = "這個使用者名稱已被使用";
                } else {
                    $username = trim($_POST["username"]);
                }
            } else {
                echo "錯誤發生，請稍侯再試";
            }
            $stmt->close();
        }
    }

    if (empty(trim($_POST["password"]))) {
        $password_err = "請輸入密碼";
    } else {
        $password = trim($_POST["password"]);
    }
    if (empty(trim($_POST["Account"]))) {
        $account_err = "請輸入帳號";
    } 
    else {
        $sql = "SELECT id FROM users WHERE account = ?";
        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("s", $param_account);
            $param_account = trim($_POST["Account"]);
            if ($stmt->execute()) {
                $stmt->store_result();
                if ($stmt->num_rows == 1) {
                    $account_err = "這個帳號已被使用";
                } 
                else {
                    $account = trim($_POST["Account"]);
                }
            } 
            else {
                echo "錯誤發生，請稍侯再試";
            }
            $stmt->close();
        }
    }
    if (empty($username_err) && empty($password_err) && empty($account_err)) {
        $sql = "INSERT INTO users (username, password , account) VALUES ('$username', md5('$password'), '$account')";
        $conn->query($sql);
        header("location: login.php");
    }

$conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <div class="container">
            <div id="branding">
                <h1>租車管理系統</h1>
            </div>
        </div>
    </header>
    <div class="container">
        <h2>註冊會員</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div>
                <label>使用者名稱：</label>
                <input type="text" name="username" value="<?php echo $username; ?>">
                <span><?php echo $username_err; ?></span>
            </div>  
            <div>
                <label>帳號：</label>
                <input type="text" name="Account" value="<?php echo $account; ?>">
                <span><?php echo $account_err; ?></span>
            </div>  
            <div>
                <label>密碼：</label>
                <input type="password" name="password">
                <span><?php echo $password_err; ?></span>
            </div>
            <div>
                <input type="submit" value="確定註冊">
            </div>
    </form>
</body>
</html>