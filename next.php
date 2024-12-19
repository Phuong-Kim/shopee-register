<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
require 'sample.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);
// var_dump($_POST);
// die;
$veryfycode = $_POST[1] . $_POST[2] . $_POST[3] . $_POST[4] . $_POST[5] . $_POST[6];
// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
if (isset($_POST['btn_next'])) {
    // $veryfycode = $_GET['veryfycode'];
    $email = $_POST['email'];  // Lấy email đã lưu từ session
    // var_dump($email);die;

    // Truy vấn để kiểm tra mã OTP và thời gian tạo OTP (10 phút hợp lệ)
    $sql = "SELECT * FROM users
                    WHERE email='$email' 
                    AND veryfycode='$veryfycode' 
                    "; // OTP hợp lệ trong 10 phút AND dateNow > NOW() - INTERVAL 1 MINUTE

    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    // var_dump(($result->num_rows > 0));die;
    $name = $row['name'];

    if ($result->num_rows > 0) {
        echo "OTP hợp lệ, bạn đã đăng ký thành công!";

        // Xóa OTP khỏi cơ sở dữ liệu để không thể dùng lại

        $sqlcheckexistacc = "select * from users where email = '$email' ";
        $resultexist = $conn->query($sql);

        if (!empty($name)) {
            echo "xin chao bạn $name";
            $sqlUpdateOtp = "UPDATE users SET type='true' WHERE email='$email'";
            $conn->query($sqlUpdateOtp);
        } else {
            echo " hãy nhập thông tin cho tài khoản mới";

?>
            <form action="dangkythongtin.php" method="post">
                <div class="mb-3 mt-3">
                    <input type="text" class="form-control" id="name" placeholder="name" name="name">
                </div>
                <div class="mb-3 mt-3">
                    <input type="text" class="form-control" id="password" placeholder="password" name="password">
                </div>
                <div class="mb-3 mt-3">
                    <input type="text" class="form-control" id="email" placeholder="email" name="email">
                </div>
                <div class="mb-3 mt-3">
                    <input type="number" class="form-control" id="numberphone" placeholder="numberphone" name="numberphone">
                </div>
                <div>
                    <button type="submit" class="btn col-md-12 text-white btn-warning" value="btnsubmit">lưu</button>
                </div>

            </form>

        <?php
        }

        // Bạn có thể thêm các bước tiếp theo ở đây (ví dụ: kích hoạt tài khoản)
    } else {
        echo "Mã OTP không hợp lệ hoặc đã hết hạn.";
        echo "$email";
        $email = $_POST['email'];
        $verifycode = random_int(100000, 999999);
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $datenow = date('Y-m-d H:i:s'); // Sử dụng định dạng ngày giờ chuẩn cho SQL
        $sqladdcode = "UPDATE users SET veryfycode = '$verifycode', dateNow = '$datenow'  WHERE email = '$email'";

        if ($conn->query($sqladdcode) === TRUE) {
            $mail->isSMTP();
            $mail->SMTPDebug = 2;
            $mail->Host = 'smtp.gmail.com';
            $mail->Port = 587;
            $mail->SMTPAuth = true;
            $mail->Username = 'thuongthikimphuong@gmail.com'; // Dùng email của chính mình
            $mail->Password = 'uspgflbvzqgtobqy';
            $mail->setFrom('test@hostinger-tutorials.com', 'Your Name');
            $mail->addReplyTo('test@hostinger-tutorials.com', 'Your Name');
            $mail->addAddress($email, 'Người Nhận'); // Mail của người nhận
            $mail->Subject = 'Mã xác thực';
            $mail->isHTML(true);
            $mail->Body = '<h2 style="Arial">Mã xác thực</h2> Mã code của bạn là: ' . $verifycode; // Nội dung cần gửi
            $mail->send();
            echo 'Message has been sent';

        ?>
            <form action="" method="post">
                <input type="text">
                <input type="text">

            </form>


<?php
        } else {
            echo 'Email đã được gửi với mã xác thực.';
        }
    }
}

$conn->close();
