<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
require 'sample.php';

// Kiểm tra xem POST có chứa đầy đủ thông tin không
if (empty($_POST['name']) || empty($_POST['email'])) {
    die("Tên người dùng và email không được để trống!");
}
// Lấy dữ liệu từ POST request
$name = $_POST['name'];
$email = $_POST['email'];

$password = generateRandomPassword(12);
echo "Mật khẩu tự động được tạo là: " . $password . "<br>";
// Mã hóa mật khẩu trước khi lưu vào DB (sử dụng bcrypt)
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// SQL query để chèn người dùng mới vào cơ sở dữ liệu
$sql = "INSERT INTO users (name, password, email) VALUES (?, ?, ?)";

// Chuẩn bị câu lệnh SQL
$stmt = $conn->prepare($sql);
$stmt->bind_param("sss", $name, $hashed_password, $email);

// Thực thi câu lệnh SQL
if ($stmt->execute()) {
    echo "Người dùng đã được tạo thành công!";
} else {
    echo "Lỗi khi tạo người dùng: " . $stmt->error;
}

// Đóng kết nối
$stmt->close();
$conn->close();
function generateRandomPassword($length = 12)
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ!@#$%^&*()-_=+';
    $password = '';
    $charactersLength = strlen($characters);

    for ($i = 0; $i < $length; $i++) {
        $password .= $characters[rand(0, $charactersLength - 1)];
    }

    return $password;
}
