<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Kết nối đến cơ sở dữ liệu (giả sử đã có file cấu hình kết nối DB, ví dụ `sample.php`)
require 'sample.php';

// Kiểm tra xem POST có chứa đầy đủ thông tin không
if (empty($_POST['name']) || empty($_POST['email'])) {
    die("Tên người dùng và email không được để trống!");
}

// Lấy dữ liệu từ POST request
$name = $_POST['name'];
$email = $_POST['email'];

// Kiểm tra xem email đã tồn tại chưa
$sql_check = "SELECT * FROM users WHERE email = ?";
$stmt_check = $conn->prepare($sql_check);
$stmt_check->bind_param("s", $email);
$stmt_check->execute();
$result = $stmt_check->get_result();

if ($result->num_rows > 0) {
    // Nếu email đã tồn tại, không tạo lại người dùng
    echo "Người dùng đã tồn tại!";
} else {

    $randomPassword = mt_rand(10000000, 99999999); // Tạo số ngẫu nhiên từ 10000000 đến 99999999

    // Mã hóa mật khẩu bằng bcrypt
    $hashedPassword = password_hash($randomPassword, PASSWORD_BCRYPT);

    // SQL query để chèn người dùng mới vào cơ sở dữ liệu
    $sql = "INSERT INTO users (name, email, password) VALUES (?, ?, ?)";
    // Chuẩn bị câu lệnh SQL
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $name, $email, $hashedPassword);


    // Thực thi câu lệnh SQL
    if ($stmt->execute()) {
        $_SESSION['userName'] = $name;
        $_SESSION['userEmail'] = $email;
        echo "Người dùng đã được tạo thành công!";
    } else {
        echo "Lỗi khi tạo người dùng: " . $stmt->error;
    }
    $stmt->close();
}

// Đóng kết nối
$conn->close();