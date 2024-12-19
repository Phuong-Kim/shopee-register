<?php
session_start();
require 'sample.php';

error_reporting(E_ALL);
ini_set('display_errors', 1);
// var_dump($_POST);
// die;
// check email đã có trong cơ sở dữ liệu chưa ?
if (isset($_POST["email"]) && isset($_POST["password"])) {
    // var_dump(isset($_POST["email"]) && isset($_POST["password"]));
    // die;
    $id = isset($_POST['id']) ? $_POST['id'] : null;
    $email = $_POST['email'];
    $password = $_POST['password'];
    // $name = $_POST['name'];

    // Kiểm tra xem email, password đã tồn tại chưa
    // $checkEmail = "SELECT * FROM users WHERE email='$email'";
    // $checkPassword = "SELECT * FROM users WHERE password='$password'";
    // $result = $conn->query($checkEmail);
    // $result = $conn->query($checkPassword);
    $query = "SELECT * FROM users WHERE email='$email' AND password='$password'";
    $result = $conn->query($query);
    // var_dump($result->num_rows);
    // die;
    if ($result && $result->num_rows > 0) {
        // Lấy thông tin người dùng
        $user = $result->fetch_assoc();

        // Đăng nhập thành công
        echo "Bạn đã đăng nhập thành công";
        $_SESSION['username'] = $user['name'];
        header("Location: trang_nguoi_dung.php");
        exit();
    } else {
        echo "Email hoặc mật khẩu không chính xác. Vui lòng đăng nhập lại.";
        echo '<br><br>';
        echo '<form action="login.php" method="get">';
        echo '<button type="submit">Quay lại trang đăng nhập</button>';
        echo '</form>';
    }
} else {
    echo "Vui lòng nhập thông tin đăng nhập.";
}
