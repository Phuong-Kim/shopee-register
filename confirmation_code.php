<?php
require 'sample.php';

error_reporting(E_ALL);
ini_set('display_errors', 1);

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);



// check email đã có trong cơ sở dữ liệu chưa ?
if (isset($_POST["email"])) {
    // var_dump($_POST["btnsubmit"]);
    // die;
    $id = isset($_POST['id']) ? $_POST['id'] : null;
    $email = $_POST['email'];
    // $veryfycode = $_POST['veryfycode'];
    // $dateNow = $_POST['dateNow'];

    // Kiểm tra xem email đã tồn tại chưa
    $checkEmail = "SELECT * FROM users WHERE email='$email'";
    $result = $conn->query($checkEmail);
    // var_dump($result->num_rows);
    // die;
    if ($result->num_rows > 0) {
        // Email đã tồn tại
        // echo "Email đã được đăng ký, Vui lòng đăng nhập.";
        $data = $result->fetch_assoc();

        if (is_null($data["type"])) {
            // echo ' chua xac thuc';
            $verifycode = random_int(100000, 999999);
            date_default_timezone_set('Asia/Ho_Chi_Minh');
            $datenow = date('Y-m-d H:i:s'); // Sử dụng định dạng ngày giờ chuẩn cho SQL
            $sqladdcode = "UPDATE users SET veryfycode = '$verifycode', dateNow = '$datenow'  WHERE email = '$email'";
            // var_dump($sqladdcode);
            // die;
            if ($conn->query($sqladdcode) === TRUE) {
                // Gửi email
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

                if (!$mail->send()) {
                    echo 'Mailer Error: ' . $mail->ErrorInfo;
                } else {
                    echo 'Email đã được gửi với mã xác thực.';
                }
                $conn->query($sqladdcode);
            } else {
                echo 'Đã xác thực';
            }
        } else {
            // Thực hiện chèn dữ liệu
            $six_digit_random_number = random_int(100000, 999999);
            // $sql = "INSERT INTO users (email)
            // VALUES('$email')";


            // if ($conn->query($sql)) {
            //     echo "New record created successfully";
            // } else {
            //     echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            // }
        }
    } else {
        $sqlUpdateOtp = "INSERT INTO users (email, type) VALUES ('$email', 'true')";
        $conn->query($sqlUpdateOtp);
        $verifycode = random_int(100000, 999999);
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $datenow = date('Y-m-d H:i:s'); // Sử dụng định dạng ngày giờ chuẩn cho SQL
        $sqladdcode = "UPDATE users SET veryfycode = '$verifycode', dateNow = '$datenow'  WHERE email = '$email'";
        if ($conn->query($sqladdcode) === TRUE) {
            // Gửi email
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

            if (!$mail->send()) {
                echo 'Mailer Error: ' . $mail->ErrorInfo;
            } else {
                echo 'Email đã được gửi với mã xác thực.';
            }
            $conn->query($sqladdcode);
        } else {
            echo 'Đã xác thực';
        }
    }
}
// Nếu chưa thì lưu vào csdl user và tạo tự động 6 số trong cột verifycode
// gửi email code verify 6 số vào email vừa tạo ở trên .
// form
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>nhập mã xác nhận</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/js/splide.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/css/splide.min.css">
    <link rel="stylesheet" href="./css/style.css">
</head>

<body>
    <!-- phần I top -->
    <div class="header-color-register">
        <div class="container header-register display-flex">
            <div class="header-register-left display-flex">
                <div class="img-logo-register display-flex col-md-6">
                    <img src="./image/shopee-register.png" alt="" />
                </div>
                <div class="col-md-6 dk">Đăng ký</div>
            </div>
            <div class="question color-red">Bạn cần giúp đỡ?</div>
        </div>
    </div>
    <!-- phần 2- nội dung -->
    <div class="confirmation_color">
        <div class="container confirmation_content">
            <div class="display-flex change change-number">
                <div class="confirm-number">
                    <p class="number-confirmation col-md-3">1</p>
                    <p class="color-green">Xác minh số điện thoại</p>
                </div>
                <div class="confirm-number color-graylight"><i class="fa-solid fa-arrow-right"></i></div>
                <div class="confirm-number">
                    <p class="number-confirmation-creat col-md-3">2</p>
                    <p class="color-graylight">Tạo mật khẩu</p>
                </div>
                <div class="confirm-number color-graylight"><i class="fa-solid fa-arrow-right"></i></div>
                <div class="confirm-number">
                    <p class="number-confirmation-creat col-md-3"><i class="fa-solid fa-check"></i></p>
                    <p class="color-graylight">Hoàn thành</p>
                </div>
            </div>
            <div class="display-flex change">
                <div class="code-cofirm col-md-6">

                    <div class="enter-total display-flex">
                        <div class="btn-back">
                            <a href="register.php" class="color-red"><i class="fa-solid fa-arrow-left"></i></a>
                        </div>
                        <div class="enter">Nhập mã xác nhận</div>
                    </div>
                    <div class="code-zalo">
                        <div>
                            <div>Mã xác thực sẽ được gửi qua Zalo đến </div>
                            <div class="zalo-total display-flex change">
                                <div>
                                    <img src="https://deo.shopeemobile.com/shopee/shopee-pcmall-live-sg/assets/daaa5f88f6f86384.png"
                                        alt="" class="col-md-6">
                                </div>
                                <div>(+84) 942 554 563</div>
                            </div>
                        </div>
                    </div>
                    <form action="next.php" method="POST">
                        <input type="text" value="<? echo $email; ?>" name='email'>
                        <div class="display-flex change pd-gach">
                            <input type="text" name="1" id="1" class="input-code">
                            <input type="text" name="2" id="2" class="input-code">
                            <input type="text" name="3" id="3" class="input-code">
                            <input type="text" name="4" id="4" class="input-code">
                            <input type="text" name="5" id="5" class="input-code">
                            <input type="text" name="6" id="6" class="input-code">
                        </div>

                        <button type="submit" class="next-register col-md-8" name='btn_next'>Kế tiếp</button>

                    </form>
                    <div class="question-you">
                        <p>
                            Bạn vẫn chưa nhận được?<br>
                            <span class="color-blue">Gửi lại</span> hoặc <span class="color-blue">thử Các phương
                                thức
                                khác</span>
                        </p>
                    </div>


                </div>
            </div>
        </div>
    </div>
    <!-- phần III footer -->
    <!-- phần 1 chăm sóc khác hàng -->
    <div class="part-10">
        <div class=" display-flex container">
            <!-- chăm sóc khác hàng -->
            <div class="care-customer col-md-2">
                <div class="title-footer">CHĂM SÓC KHÁCH HÀNG</div>
                <ul class="part-10-ul">
                    <li>Trung tâm trợ giúp</li>
                    <li>Shopee Blog</li>
                    <li>Shopee Mall</li>
                    <li>Hướng dẫn mua hàng</li>
                    <li>Hướng dẫn bán hàng</li>
                    <li>Thanh toán</li>
                    <li>Shopee Xu</li>
                    <li>Vận chuyển</li>
                    <li>Trả hàng & Hoàn tiền</li>
                    <li>Liên hệ Shopee</li>
                    <li>Chính sách bảo hành</li>
                </ul>
            </div>
            <!-- VỀ SHOPEE -->
            <div class="go-shopee col-md-2">
                <div class="title-footer">VỀ SHOPEE</div>
                <ul class="part-10-ul">
                    <li>Giới thiệu về Shopee Việt Nam</li>
                    <li>Tuyển dụng</li>
                    <li>Điều Khoản Shopee</li>
                    <li>Chính sách bảo mật</li>
                    <li>Chính Hãng</li>
                    <li>Kênh Người bán</li>
                    <li>Flash Sales</li>
                    <li>Chương trình Tiếp thị liên kết Shopee</li>
                    <li>Liên Hệ Với Truyền Thông</li>
                </ul>
            </div>
            <!-- THANH TOÁN -->
            <div class="pay col-md-3">
                <div class="title-footer">THANH TOÁN</div>
                <div>
                    <div class="pay-card display-flex">
                        <div class="col-md-3"><img src="./image/visa.png" alt=""></div>
                        <div class="col-md-3"><img src="./image/mastercard.png" alt=""></div>
                        <div class="col-md-3"><img src="./image/jcb.jpg" alt=""></div>
                    </div>
                    <div class="pay-card display-flex">
                        <div class="col-md-3"><img src="./image/JACKET.png" alt=""></div>
                        <div class="col-md-3"><img src="./image/COD.png" alt=""></div>
                        <div class="col-md-3"><img src="./image/tra-dop-0.png" alt=""></div>
                    </div>
                    <div class="col-md-3"><img src="./image/SPAY.webp" alt=""></div>
                </div>
                <h5>ĐƠN VỊ VẬN CHUYỂN</h5>
                <div>
                    <div class="pay-card display-flex">
                        <div class="col-md-3"><img src="./image/shopee-express.png" alt=""></div>
                        <div class="col-md-3"><img src="./image/logo-giao-hang-tiet-kiem.jpg" alt=""></div>
                        <div class="col-md-3"><img src="./image/GHN.webp" alt=""></div>
                    </div>
                    <div class="pay-card display-flex">
                        <div class="col-md-3"><img src="./image/vietel-post.png" alt=""></div>
                        <div class="col-md-3"><img src="./image/Buu-dien-V.png" alt=""></div>
                        <div class="col-md-3"><img src="./image/J-va-T.webp" alt=""></div>
                    </div>
                    <div class="pay-card display-flex">
                        <div class="col-md-3"><img src="./image/grap-express.jpg" alt=""></div>
                        <div class="col-md-3"><img src="./image/ninja.png" alt=""></div>
                        <div class="col-md-3"><img src="./image/best-express.png" alt=""></div>
                    </div>
                    <div><img src="./image/be.png" alt=""></div>
                </div>
            </div>
            <!-- THEO DÕI CHÚNG TÔI TRÊN -->
            <div class="follow-we col-md-2">
                <div class="title-footer">THEO DÕI CHÚNG TÔI TRÊN</div>
                <div class="display-flex">
                    <p class="follow-we-icon"><i class="fa-brands fa-facebook"></i></p>
                    <p>Facebook</p>
                </div>
                <div class="display-flex">
                    <p class="follow-we-icon"><i class="fa-brands fa-instagram"></i></p>
                    <p>Instagram</p>
                </div>
                <div class="display-flex">
                    <p class="follow-we-icon"><i class="fa-brands fa-linkedin"></i></p>
                    <p>LinkedIn</p>
                </div>
            </div>
            <!-- TẢI ỨNG DỤNG SHOPEE NGAY THÔI -->
            <div class="dowload-now col-md-2">
                <div class="title-footer">TẢI ỨNG DỤNG SHOPEE NGAY THÔI</div>
                <div class="dowload-now-content display-flex">
                    <div class="follow-we-icon col-md-6"><img
                            src="https://deo.shopeemobile.com/shopee/shopee-pcmall-live-sg/productdetailspage/d91264e165ed6facc617.png"
                            alt=""></div>
                    <div class="dowload-now-content-right col-md-6">
                        <div><img
                                src="https://deo.shopeemobile.com/shopee/shopee-pcmall-live-sg/productdetailspage/39f189e19764dab688d3.png"
                                alt=""></div>
                        <div><img
                                src="https://deo.shopeemobile.com/shopee/shopee-pcmall-live-sg/productdetailspage/f4f5426ce757aea491dc.png"
                                alt=""></div>
                        <div><img
                                src="https://deo.shopeemobile.com/shopee/shopee-pcmall-live-sg/productdetailspage/1ae215920a31f2fc75b0.png"
                                alt=""></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <hr>
        </div>
        <!-- phần 11 bản quyền -->
        <div class="copyright display-flex container">
            <div>
                © 2024 Shopee. Tất cả các quyền được bảo lưu.
            </div>
            <div class="display-flex">
                <p>Quốc gia & Khu vực:</p>
                <p>Singapore</p>
                <p class="hr-search"></p>
                <p>Indonesia</p>
                <p class="hr-search"></p>
                <p>Đài Loan</p>
                <p class="hr-search"></p>
                <p>Thái Lan</p>
                <p class="hr-search"></p>
                <p>Malaysia</p>
                <p class="hr-search"></p>
                <p>Việt Nam</p>
                <p class="hr-search"></p>
                <p>Philippines</p>
                <p class="hr-search"></p>
                <p>Brazil</p>
                <p class="hr-search"></p>
                <p>México</p>
                <p class="hr-search"></p>
                <p>Colombia</p>
                <p class="hr-search"></p>
                <p>Chile</p>
            </div>
        </div>
    </div>
    <!-- phần 2 footer -->
    <div class="footer container">
        <!-- phần 1 -->
        <div class="display-flex">
            <p> CHÍNH SÁCH BẢO MẬT </p>
            <p class="hr-straight"></p>
            <p> QUY CHẾ HOẠT ĐỘNG</p>
            <p class="hr-straight"></p>
            <p>CHÍNH SÁCH VẬN CHUYỂN</p>
            <p class="hr-straight"></p>
            <p>CHÍNH SÁCH TRẢ HÀNG VÀ HOÀN TIỀN</p>
        </div>
        <!-- phần 2 -->
        <div class="registered display-flex">
            <div class="col-md-1"><img src="./image/da-dang-ky.png" alt=""></div>
            <div class="col-md-1"><img src="./image/da-dang-ky.png" alt=""></div>
            <div class="col-md-1"><img src="./image/cty-shopee.png" alt=""></div>
        </div>
        <!-- phần 3 -->
        <div class="shopee-company">Công ty TNHH Shopee</div>
        <!-- phần 4 -->
        <div class="footer-information">
            <p>Địa chỉ: Tầng 4-5-6, Tòa nhà Capital Place, số 29 đường Liễu Giai, Phường Ngọc Khánh, Quận Ba Đình,
                Thành
                phố
                Hà Nội, Việt Nam. Tổng đài hỗ trợ: 19001221 - Email: cskh@hotro.shopee.vn</p>
            <p>Chịu Trách Nhiệm Quản Lý Nội Dung: Nguyễn Bùi Anh Tuấn</p>
            <p>Mã số doanh nghiệp: 0106773786 do Sở Kế hoạch & Đầu tư TP Hà Nội cấp lần đầu ngày 10/02/2015</p>
            <p>© 2015 - Bản quyền thuộc về Công ty TNHH Shopee</p>
        </div>
    </div>
</body>

<script src="./javascript/javaconfirm.js"></script>

</html>