<?php
require_once 'config.php';

$sql = "CREATE DATABASE IF NOT EXISTS car_rental";
if ($conn->query($sql) === FALSE) {
    echo "Error creating database: " . $conn->error;
}

$conn->select_db(DB_NAME);

$users_table = "CREATE TABLE IF NOT EXISTS users (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(30) NOT NULL UNIQUE,
    account VARCHAR(30) NOT NULL,
    password VARCHAR(255) NOT NULL
)";

$records_table = "CREATE TABLE IF NOT EXISTS rental_records (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    user_id INT(6) UNSIGNED NOT NULL,
    car VARCHAR(50) NOT NULL,
    rental_date DATE NOT NULL,
    return_date DATE,
    FOREIGN KEY (user_id) REFERENCES users(id)
)";

$users_value = "insert into users(username, account , password) values('蔡尚倫' , 'alex210620' , md5('d0932849649')),
('蔡尚原', 'mark210502' , md5('d0928712701')),
('郭翊丞', '11024249' , md5('d11024249')),
('蔡曜羽', '11024160' , md5('d11024160'))";

if ($conn->query($users_table) === FALSE || $conn->query($records_table) === FALSE || $conn->query($users_value) ===False) {
    echo "Error creating tables: " . $conn->error;
}

$conn->close();
?>