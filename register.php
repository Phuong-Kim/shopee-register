<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>register</title>
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
    <div class="part-2-rgister">
        <div class="container bacground-form">
            <div class="container col-md-5 register-form">
                <h5>Đăng ký </h5>
                <form action="confirmation_code.php" class="part-2-form" method="post">
                    <div class="mb-3 mt-3">
                        <input type="text" class="form-control" id="email" placeholder="email" name="email">
                    </div>
                    <div>
                        <!-- <a href="./confirmation_code.php">TIẾP THEO</a> -->
                        <button type="submit" class="btn col-md-12 text-white btn-warning" value="btnsubmit">Kiểm
                            tra</button>
                    </div>

                    <!-- Hộp thoại tùy chỉnh -->
                    <!-- <div id="customConfirm" class="custom" style="display:none; position:fixed; top:50%; left:50%; transform:translate(-50%, -50%);
                        background:white; border:1px solid #ccc; padding:20px; z-index:1000;">
                        <p>Chúng tôi sẽ gửi mã xác minh qua Zalo đến (+84)....</p>
                        <button onclick="cancel()" class="box_custom">Hủy bỏ</button>
                        <button onclick="otherMethods()" class="box_custom">Các phương thức khác</button>
                        <button onclick="sendToZalo()" class="box_custom-zalo">Gửi đến
                            Zalo</button>
                    </div> -->

                    <!-- Overlay để làm mờ nền -->
                    <!-- <div id="overlay"
                        style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(0,0,0,0.5); z-index:999;">
                    </div> -->

                    <!-- <script>
                        function confirmNext() {
                            document.getElementById('customConfirm').style.display = 'block';
                            document.getElementById('overlay').style.display = 'block';
                        }

                        function sendToZalo() {
                            // Chuyển hướng đến trang PHP mới
                            console.log('sendToZalo called');
                            window.location.href = './confirmation_code.php';
                        }

                        function otherMethods() {
                            alert("Bạn đã chọn các phương thức khác.");
                            closeCustomConfirm();
                        }

                        function cancel() {
                            alert("Hủy gửi tin nhắn.");
                            closeCustomConfirm();
                        }

                        function closeCustomConfirm() {
                            document.getElementById('customConfirm').style.display = 'none';
                            document.getElementById('overlay').style.display = 'none';
                        }
                    </script> -->

                    <div class="color-graylight display-flex">
                        <div class="col-md-5">
                            <hr>
                        </div>
                        <div>HOẶC</div>
                        <div class="col-md-5">
                            <hr>
                        </div>
                    </div>
                    <div class="button-fb display-flex">
                        <button type="submit" class="btn-fb"><span class="color-blue"><i
                                    class="fa-brands fa-facebook"></i></span> Facebook</button>
                        <button type="submit" class="btn-fb"><span class="color-red"><i
                                    class="fa-solid fa-g"></i></span> Google</button>
                    </div>
                    <div class="rule-register">
                        <p>
                            Bằng việc đăng kí, bạn đã đồng ý với Shopee về<br>
                            <span class="color-red">Điều khoản dịch vụ</span> & <span class="color-red">Chính sách bảo
                                mật</span>
                        </p>
                    </div>
                    <div class="color-graylight rule-register">Bạn đã có tài khoản? <span class="color-red">Đăng
                            nhập</span>
                    </div>
                </form>
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
            <p>Địa chỉ: Tầng 4-5-6, Tòa nhà Capital Place, số 29 đường Liễu Giai, Phường Ngọc Khánh, Quận Ba Đình, Thành
                phố
                Hà Nội, Việt Nam. Tổng đài hỗ trợ: 19001221 - Email: cskh@hotro.shopee.vn</p>
            <p>Chịu Trách Nhiệm Quản Lý Nội Dung: Nguyễn Bùi Anh Tuấn</p>
            <p>Mã số doanh nghiệp: 0106773786 do Sở Kế hoạch & Đầu tư TP Hà Nội cấp lần đầu ngày 10/02/2015</p>
            <p>© 2015 - Bản quyền thuộc về Công ty TNHH Shopee</p>
        </div>
    </div>
</body>

</html>