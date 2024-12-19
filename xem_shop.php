<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>SHOPEE</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/js/splide.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/css/splide.min.css">
    <link rel="stylesheet" href="./css/style.css" />
</head>

<body>
    <!-- phần header -->
    <div class="header-bacgroud">
        <div class="header container">
            <div class="header-top display-flex">
                <!-- header top -->
                <div class="header-top-left col-md-6 display-flex">
                    <div class="header-top-left-content">Kênh người bán</div>
                    <div class="hr-head"></div>
                    <div class="header-top-left-content">Trở thành Người bán Shopee</div>
                    <div class="hr-head"></div>
                    <div class="header-top-left-content">Tải ứng dụng</div>
                    <div class="hr-head"></div>
                    <div class="connect-fb display-flex header-top-left-content">
                        <p>Kết nối</p>
                        <p><i class="fa-brands fa-facebook"></i></p>
                        <p><i class="fa-brands fa-instagram"></i></p>
                    </div>
                </div>
                <div class="header-top-right col-md-6 display-flex">
                    <div><i class="fa-regular fa-bell"></i> Thông báo</div>
                    <div class="display-flex">
                        <div><img src="./image/dau-hoi.png" alt="" /></div>
                        <div>Hỗ trợ</div>
                    </div>
                    <div class="display-flex">
                        <div><img src="./image/trai-dat.png" alt="" /></div>
                        <div>Tiếng việt</div>
                        <div><i class="fa-solid fa-angle-down"></i></div>
                    </div>
                    <?php
                    session_start();
                    if (!isset($_SESSION['username'])) {
                        header("Location: login.php");
                        exit();
                    }
                    ?>
                    <div class="a-1 display-flex">

                        <i class="fa-regular fa-circle-user"></i>

                        <p><?php echo htmlspecialchars($_SESSION['username']); ?></p>
                    </div>
                </div>
            </div>
            <div class="header-bottom display-flex">
                <div class="header-bottom-left display-flex">
                    <img src="./image/logo.png" alt="" />
                </div>
                <div class="header-bottom-center">
                    <div class="input-header display-flex">
                        <div>
                            <input type="text" name="" id="" placeholder="Shopee bao ship 0Đ - Đăng ký ngay!" />
                        </div>
                        <div class="search"><img src="./image/search.png" alt="" /></div>
                    </div>
                    <div class="header-bottom-center-content display-flex">
                        <p>Điện Thoại 8plus Giá Rẻ</p>
                        <p>Labubu</p>
                        <p>A iPhone 15 Pro Max Giá Rẻ 1k</p>
                        <p>Áo Thun Hot Trend 2024</p>
                        <p>Ốp Lưng</p>
                        <p>Mua Hàng 0 Đồng</p>
                        <p>Tai Nghe Bluetooth</p>
                    </div>
                </div>
                <div class="header-bottom-right display-flex">
                    <img src="./image/xe-hang.png" alt="" />
                </div>
            </div>
        </div>
    </div>

    <!-- phần 1 thông tin shop -->
    <div class="part-2 container display-flex">
        <!-- phần 2 bên trái -->

        <div class="col-md-4 shop_wallpaper">
            <div class="overlay"></div>
            <div class="display-flex show_seeshop">
                <div class="col-md-4 img_seeshop"><img src="./image/image/anh_shop.webp" alt=""></div>
                <div class="show_seeshop_right">
                    <p>LEGENDARY T'SHOP</p>
                    <p>Online 2 phút trước</p>
                </div>
            </div>
            <div class="display-flex col-md-8 show_seeshop show_seeshop_bottom">
                <p class="follow-seeshop col-md-6">+ Theo dõi</p>
                <p class="display-flex follow-seeshop col-md-6 follow-seeshop-span">
                    <span><i class="fa-solid fa-comment-dots"></i></span>
                    <span>Chat</span>
                </p>
            </div>
        </div>

        <!-- phần 2 bên phải -->
        <div class="part-2-right col-md-8 display-flex">
            <div class="col-md-6">
                <div class="display-flex">
                    <p class="mg_5px"><i class="fa-solid fa-shop"></i></p>
                    <p>Sản phẩm : <span class="color-red">160</span></p>
                </div>
                <div class="display-flex ">
                    <p class="mg_5px"><i class="fa-solid fa-user-plus"></i></p>
                    <p>Đang theo dõi : <span class="color-red">523</span></p>
                </div>
                <div class="display-flex ">
                    <p class="mg_5px"><i class="fa-regular fa-message"></i></p>
                    <p>Tỷ lệ phản hồi chat : <span class="color-red">99% (Trong vài giờ)</span></p>
                </div>
                <div class="display-flex ">
                    <p class="mg_5px"><i class="fa-solid fa-x"></i></p>
                    <p>Tỷ lệ shop hủy đơn : <span class="color-red">1%</span></p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="display-flex">
                    <p class="mg_5px"><i class="fa-solid fa-people-line"></i></p>
                    <p>Người theo dõi : <span class="color-red">1,1tr</span></p>
                </div>
                <div class="display-flex ">
                    <p class="mg_5px"><i class="fa-regular fa-star"></i></p>
                    <p>Đánh giá : <span class="color-red">4.4 (426,4k Đánh Giá)</span></p>
                </div>
                <div class="display-flex ">
                    <p class="mg_5px"><i class="fa-solid fa-user-plus"></i></p>
                    <p>Tham gia : <span class="color-red">4 Năm Trước</span></p>
                </div>

            </div>
        </div>
    </div>

    <!-- phần 2 thanh điều hướng -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light container">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Dạo</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="">TẤT CẢ SẢN PHẨM</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="">Top bán chạy</a>
                    </li>

                </ul>
            </div>
        </div>
    </nav>

    <!-- phần 3 voucher -->
    <div class="voucher_total container">
        <h5>VOUCHER</h5>
        <div class="voucher color-red display-flex">
            <div class="voucher_left">
                <p>Giảm đ5K<br>
                    Đơn Tối Thiểu đ70K<br>
                    <span>HSD:30.11.2024</span>
                </p>
            </div>
            <div class="voucher_right">
                Lưu
            </div>
        </div>
    </div>

    <!-- phần 4 gợi ý cho bạn-->
    <div class="part-5 container gycb">
        <div class="title-shop">GỢI Ý CHO BẠN</div>
        <div class="part-5-content display-flex">
            <section id="other-products" class="splide container" aria-label="Splide Basic HTML Example">
                <div class="splide__track">
                    <ul class="splide__list">
                        <li class="splide__slide col-md-4">
                            <div class="part-5-shirt">
                                <!-- ảnh sản phẩm -->
                                <div class="relative part-5-shirt-img">
                                    <div class="present col-md-2">-83%</div>
                                    <div><img
                                            src="https://down-vn.img.susercontent.com/file/vn-11134207-7r98o-ltf1kwpmpi4t30"
                                            alt="">
                                    </div>
                                    <div class="sale"><img src="./image/qc-9-9.png" alt=""></div>
                                </div>
                                <!-- thông tin -->
                                <div class="part-5-information col-md-12 display-flex">
                                    <p><span>Yêu thích</span>Áo thun tay lỡ unisex form rộng cổ V, áo phông Winhouse
                                        phối viền chất liệu
                                        cotton thoáng mát.</p>
                                </div>
                                <!-- giá -->
                                <div class="part-5-price display-flex">
                                    <p class="display-flex"><span class="d">đ</span>10.000</p>
                                    <p>Đã bán 3,6k</p>
                                </div>
                            </div>
                        </li>
                        <li class="splide__slide col-md-4">
                            <div class="part-5-shirt">
                                <!-- ảnh sản phẩm -->
                                <div class="relative part-5-shirt-img">
                                    <div class="present col-md-2">-83%</div>
                                    <div><img
                                            src="https://down-vn.img.susercontent.com/file/vn-11134207-7r98o-lsjmfky2uuo434.webp"
                                            alt="">
                                    </div>
                                    <div class="sale"><img src="./image/qc-9-9.png" alt=""></div>
                                </div>
                                <!-- thông tin -->
                                <div class="part-5-information col-md-12 display-flex">
                                    <p><span>Yêu thích</span>Áo thun tay lỡ unisex form rộng cổ V, áo phông Winhouse
                                        phối viền chất liệu
                                        cotton thoáng mát.</p>
                                </div>
                                <!-- giá -->
                                <div class="part-5-price display-flex">
                                    <p class="display-flex"><span class="d">đ</span>10.000</p>
                                    <p>Đã bán 8,9k</p>
                                </div>
                            </div>
                        </li>
                        <li class="splide__slide col-md-4">
                            <div class="part-5-shirt">
                                <!-- ảnh sản phẩm -->
                                <div class="relative part-5-shirt-img">
                                    <div class="present col-md-2">-83%</div>
                                    <div><img
                                            src="https://down-vn.img.susercontent.com/file/vn-11134207-7r98o-lys7osrthv7xa3.webp"
                                            alt="">
                                    </div>
                                    <div class="sale"><img src="./image/qc-9-9.png" alt=""></div>
                                </div>
                                <!-- thông tin -->
                                <div class="part-5-information col-md-12 display-flex">
                                    <p><span>Yêu thích</span>Áo thun tay lỡ unisex form rộng cổ V, áo phông Winhouse
                                        phối viền chất liệu
                                        cotton thoáng mát.</p>
                                </div>
                                <!-- giá -->
                                <div class="part-5-price display-flex">
                                    <p class="display-flex"><span class="d">đ</span>10.000</p>
                                    <p>Đã bán 3,6k</p>
                                </div>
                            </div>
                        </li>
                        <li class="splide__slide col-md-4">
                            <div class="part-5-shirt">
                                <!-- ảnh sản phẩm -->
                                <div class="relative part-5-shirt-img">
                                    <div class="present col-md-2">-83%</div>
                                    <div><img
                                            src="https://down-vn.img.susercontent.com/file/vn-11134207-7r98o-lx74q80verizd2.webp"
                                            alt="">
                                    </div>
                                    <div class="sale"><img src="./image/qc-9-9.png" alt=""></div>
                                </div>
                                <!-- thông tin -->
                                <div class="part-5-information col-md-12 display-flex">
                                    <p><span>Yêu thích</span>Áo thun tay lỡ unisex form rộng cổ V, áo phông Winhouse
                                        phối viền chất liệu
                                        cotton thoáng mát.</p>
                                </div>
                                <!-- giá -->
                                <div class="part-5-price display-flex">
                                    <p class="display-flex"><span class="d">đ</span>10.000</p>
                                    <p>Đã bán 191</p>
                                </div>
                            </div>
                        </li>
                        <li class="splide__slide col-md-4">
                            <div class="part-5-shirt">
                                <!-- ảnh sản phẩm -->
                                <div class="relative part-5-shirt-img">
                                    <div class="present col-md-2">-83%</div>
                                    <div><img
                                            src="https://down-vn.img.susercontent.com/file/vn-11134207-7r98o-lvh4j7ovz1wk3a.webp"
                                            alt="">
                                    </div>
                                    <div class="sale"><img src="./image/qc-9-9.png" alt=""></div>
                                </div>
                                <!-- thông tin -->
                                <div class="part-5-information col-md-12 display-flex">
                                    <p><span>Yêu thích</span>Áo thun tay lỡ unisex form rộng cổ V, áo phông Winhouse
                                        phối viền chất liệu
                                        cotton thoáng mát.</p>
                                </div>
                                <!-- giá -->
                                <div class="part-5-price display-flex">
                                    <p class="display-flex"><span class="d">đ</span>10.000</p>
                                    <p>Đã bán 3,6k</p>
                                </div>
                            </div>
                        </li>
                        <li class="splide__slide col-md-4">
                            <div class="part-5-shirt">
                                <!-- ảnh sản phẩm -->
                                <div class="relative part-5-shirt-img">
                                    <div class="present col-md-2">-81%</div>
                                    <div><img
                                            src="https://down-vn.img.susercontent.com/file/vn-11134207-7r98o-lx74q80vhkux60.webp"
                                            alt="">
                                    </div>
                                    <div class="sale"><img src="./image/qc-9-9.png" alt=""></div>
                                </div>
                                <!-- thông tin -->
                                <div class="part-5-information col-md-12 display-flex">
                                    <p><span>Yêu thích</span>Áo thun tay lỡ unisex form rộng cổ V, áo phông Winhouse
                                        phối viền chất liệu
                                        cotton thoáng mát.</p>
                                </div>
                                <!-- giá -->
                                <div class="part-5-price display-flex">
                                    <p class="display-flex"><span class="d">đ</span>10.000</p>
                                    <p>Đã bán 198</p>
                                </div>
                            </div>
                        </li>
                        <li class="splide__slide col-md-4">
                            <div class="part-5-shirt">
                                <!-- ảnh sản phẩm -->
                                <div class="relative part-5-shirt-img">
                                    <div class="present col-md-2">-83%</div>
                                    <div><img
                                            src="https://down-vn.img.susercontent.com/file/vn-11134207-7r98o-lxkw8w4f48gpbc.webp"
                                            alt="">
                                    </div>
                                    <div class="sale"><img src="./image/qc-9-9.png" alt=""></div>
                                </div>
                                <!-- thông tin -->
                                <div class="part-5-information col-md-12 display-flex">
                                    <p><span>Yêu thích</span>Áo thun tay lỡ unisex form rộng cổ V, áo phông Winhouse
                                        phối viền chất liệu
                                        cotton thoáng mát.</p>
                                </div>
                                <!-- giá -->
                                <div class="part-5-price display-flex">
                                    <p class="display-flex"><span class="d">đ</span>10.000</p>
                                    <p>Đã bán 3,6k</p>
                                </div>
                            </div>
                        </li>
                        <li class="splide__slide col-md-4">
                            <div class="part-5-shirt">
                                <!-- ảnh sản phẩm -->
                                <div class="relative part-5-shirt-img">
                                    <div class="present col-md-2">-83%</div>
                                    <div><img
                                            src="https://down-vn.img.susercontent.com/file/vn-11134207-7r98o-lxkw8w4f2tw92a.webp"
                                            alt="">
                                    </div>
                                    <div class="sale"><img src="./image/qc-9-9.png" alt=""></div>
                                </div>
                                <!-- thông tin -->
                                <div class="part-5-information col-md-12 display-flex">
                                    <p><span>Yêu thích</span>Áo thun tay lỡ unisex form rộng cổ V, áo phông Winhouse
                                        phối viền chất liệu
                                        cotton thoáng mát.</p>
                                </div>
                                <!-- giá -->
                                <div class="part-5-price display-flex">
                                    <p class="display-flex"><span class="d">đ</span>10.000</p>
                                    <p>Đã bán 3,6k</p>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </section>
        </div>
    </div>

    <!-- phần 5 áo khoác thu đông -->
    <div class=" container gycb">
        <div class="title-shop">ÁO KHOÁC THU ĐÔNG</div>
        <div class="part-6-content display-flex">

            <div class="part-6-like part-5-shirt col-md-3">
                <!-- ảnh sản phẩm -->
                <div class="relative part-5-shirt-img">
                    <div class="present col-md-2">-72%</div>
                    <div class="you-like"><img
                            src="https://down-vn.img.susercontent.com/file/vn-11134207-7r98o-lymhcxlyv25dfb.webp"
                            alt="">
                    </div>
                    <div class="sale_5"><img src="./image/qc-9-9.png" alt=""></div>
                </div>
                <!-- thông tin -->
                <div class="part-5-information col-md-12 display-flex product_son_5">
                    <p><span>Yêu thích</span>Tất Thể Thao Nam Nữ Phù Hợp Với Nhiều Màu Sắc Họa Tiết Tiếng Anh Vớ
                        Trắng
                        Giữa Ống
                        Tất.</p>
                </div>
                <!-- giá -->
                <div class="part-5-price display-flex">
                    <p class="display-flex"><span class="d">đ</span>7.000</p>
                    <p>Đã bán 3,5k</p>
                </div>
            </div>
            <div class="part-6-like part-5-shirt col-md-3">
                <!-- ảnh sản phẩm -->
                <div class="relative part-5-shirt-img">
                    <div class="present col-md-2">-72%</div>
                    <div class="you-like"><img
                            src="https://down-vn.img.susercontent.com/file/vn-11134207-7qukw-ljhyygy6dzg496.webp"
                            alt="">
                    </div>
                    <div class="sale_5"><img src="./image/qc-9-9.png" alt=""></div>
                </div>
                <!-- thông tin -->
                <div class="part-5-information col-md-12 display-flex product_son_5">
                    <p><span>Yêu thích</span>Tất Thể Thao Nam Nữ Phù Hợp Với Nhiều Màu Sắc Họa Tiết Tiếng Anh Vớ
                        Trắng
                        Giữa Ống
                        Tất.</p>
                </div>
                <!-- giá -->
                <div class="part-5-price display-flex">
                    <p class="display-flex"><span class="d">đ</span>7.000</p>
                    <p>Đã bán 3,5k</p>
                </div>
            </div>
            <div class="part-6-like part-5-shirt col-md-3">
                <!-- ảnh sản phẩm -->
                <div class="relative part-5-shirt-img">
                    <div class="present col-md-2">-72%</div>
                    <div class="you-like"><img
                            src="https://down-vn.img.susercontent.com/file/vn-11134207-7ras8-m20bq9ckf0d709.webp"
                            alt="">
                    </div>
                    <div class="sale_5"><img src="./image/qc-9-9.png" alt=""></div>
                </div>
                <!-- thông tin -->
                <div class="part-5-information col-md-12 display-flex product_son_5">
                    <p><span>Yêu thích</span>Tất Thể Thao Nam Nữ Phù Hợp Với Nhiều Màu Sắc Họa Tiết Tiếng Anh Vớ
                        Trắng
                        Giữa Ống
                        Tất.</p>
                </div>
                <!-- giá -->
                <div class="part-5-price display-flex">
                    <p class="display-flex"><span class="d">đ</span>7.000</p>
                    <p>Đã bán 3,5k</p>
                </div>
            </div>
        </div>
    </div>

    <!-- phần 6 danh mục-->
    <div class="display-flex container gycb">
        <!-- bên trái -->
        <div class="col-md-2 category_left">
            <h5 class="category_6"><span><i class="fa-solid fa-bars"></i></span> Danh mục</h5>
            <p>Sản Phẩm</p>
            <p>Top bán chạy</p>
        </div>
        <!-- bên phải -->
        <div class="part-6 col-md-10">
            <nav class="navbar navbar-expand-lg navbar-light ">
                <div class="container-fluid">

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <li class="nav-item">
                                <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Sắp xếp
                                    theo</a>
                            </li>
                            <li class="nav-item nav_category">
                                <a class="nav-link active" aria-current="page" href="#">Phổ biến</a>
                            </li>
                            <li class="nav-item nav_category">
                                <a class="nav-link active" aria-current="page" href="#">Mới nhất</a>
                            </li>
                            <li class="nav-item nav_category">
                                <a class="nav-link active" aria-current="page" href="#">Bán chạy</a>
                            </li>
                            <li class="nav-item dropdown nav_price">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    Giá
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <li><a class="dropdown-item" href="#">Giá: Thấp đến Cao</a></li>
                                    <li><a class="dropdown-item" href="#">Giá: Cao đến thấp</a></li>
                                </ul>
                            </li>
                        </ul>
                        <form class="d-flex">
                            <p class="nb">1/6</p>
                            <p class="nav_lh"><i class="fa-solid fa-angle-left"></i></p>
                            <p class="nav_bh"><i class="fa-solid fa-angle-right"></i></p>
                        </form>
                    </div>
                </div>
            </nav>
            <div class="part-6-content display-flex">
                <div class="part-6-like part-5-shirt">
                    <!-- ảnh sản phẩm -->
                    <div class="relative part-5-shirt-img">
                        <div class="present col-md-2">-72%</div>
                        <div class="you-like"><img
                                src="https://down-vn.img.susercontent.com/file/sg-11134301-7rd4w-lv8ltqfr3kcge1@resize_w450_nl.webp"
                                alt="">
                        </div>
                        <div class="sale"><img src="./image/qc-9-9.png" alt=""></div>
                    </div>
                    <!-- thông tin -->
                    <div class="part-5-information col-md-12 display-flex product_son">
                        <p><span>Yêu thích</span>Tất Thể Thao Nam Nữ Phù Hợp Với Nhiều Màu Sắc Họa Tiết Tiếng Anh Vớ
                            Trắng
                            Giữa Ống
                            Tất.</p>
                    </div>
                    <!-- giá -->
                    <div class="part-5-price display-flex">
                        <p class="display-flex"><span class="d">đ</span>7.000</p>
                        <p>Đã bán 3,5k</p>
                    </div>
                </div>
                <div class="part-6-like part-5-shirt">
                    <!-- ảnh sản phẩm -->
                    <div class="relative part-5-shirt-img">
                        <div class="present col-md-2">-72%</div>
                        <div class="you-like"><img
                                src="https://down-vn.img.susercontent.com/file/sg-11134301-7rd6c-lv8ltqdj6t797d.webp"
                                alt="">
                        </div>
                        <div class="sale"><img src="./image/qc-9-9.png" alt=""></div>
                    </div>
                    <!-- thông tin -->
                    <div class="part-5-information col-md-12 display-flex product_son">
                        <p><span>Yêu thích</span>Tất Thể Thao Nam Nữ Phù Hợp Với Nhiều Màu Sắc Họa Tiết Tiếng Anh Vớ
                            Trắng
                            Giữa Ống
                            Tất</p>
                    </div>
                    <!-- giá -->
                    <div class="part-5-price display-flex">
                        <p class="display-flex"><span class="d">đ</span>7.000</p>
                        <p>Đã bán 3,6k</p>
                    </div>
                </div>
                <div class="part-6-like part-5-shirt">
                    <!-- ảnh sản phẩm -->
                    <div class="relative part-5-shirt-img">
                        <div class="present col-md-2">-83%</div>
                        <div class="you-like"><img
                                src="https://down-vn.img.susercontent.com/file/vn-11134207-7r98o-ly87kxq0bna93e.webp"
                                alt="">
                        </div>
                        <div class="sale"><img src="./image/qc-9-9.png" alt=""></div>
                    </div>
                    <!-- thông tin -->
                    <div class="part-5-information col-md-12 display-flex product_son">
                        <p><span>Yêu thích</span>Áo thun tay lỡ unisex nam nữ LABUBU LUXA, Áo phông unisex form rộng</p>
                    </div>
                    <!-- giá -->
                    <div class="part-5-price display-flex">
                        <p class="display-flex"><span class="d">đ</span>30.900
                        <p>Đã bán 3,6k</p>
                    </div>
                </div>
                <div class="part-6-like part-5-shirt">
                    <!-- ảnh sản phẩm -->
                    <div class="relative part-5-shirt-img">
                        <div class="present col-md-2">-52%</div>
                        <div class="you-like"><img
                                src="https://down-vn.img.susercontent.com/file/vn-11134207-7r98o-lvvvsqp7ntujc8.webp"
                                alt="">
                        </div>
                        <div class="sale"><img src="./image/qc-9-9.png" alt=""></div>
                    </div>
                    <!-- thông tin -->
                    <div class="part-5-information col-md-12 display-flex product_son">
                        <p><span>Yêu thích</span>Sét Bộ Hottrend Gồm Áo Thun Babytee 2 Nơ + Quần Suông Kaki 4 Sọc</p>
                    </div>
                    <!-- giá -->
                    <div class="part-5-price display-flex">
                        <p class="display-flex"><span>đ</span>95.000</p>
                        <p>Đã bán 2,8k</p>
                    </div>
                </div>
                <div class="part-6-like part-5-shirt">
                    <!-- ảnh sản phẩm -->
                    <div class="relative part-5-shirt-img">
                        <div class="present col-md-2">-83%</div>
                        <div class="you-like"><img
                                src="https://down-vn.img.susercontent.com/file/vn-11134207-7r98o-ltf1kwpmpi4t30" alt="">
                        </div>
                        <div class="sale"><img src="./image/qc-9-9.png" alt=""></div>
                    </div>
                    <!-- thông tin -->
                    <div class="part-5-information col-md-12 display-flex product_son">
                        <p><span>Yêu thích</span>Áo thun tay lỡ unisex form rộng cổ V, áo phông Winhouse phối viền chất
                            liệu
                            cotton
                            thoáng mát.</p>
                    </div>
                    <!-- giá -->
                    <div class="part-5-price display-flex">
                        <p class="display-flex"><span class="d">đ</span>10.000</p>
                        <p>Đã bán 3,6k</p>
                    </div>
                </div>
                <div class="part-6-like part-5-shirt">
                    <!-- ảnh sản phẩm -->
                    <div class="relative part-5-shirt-img">
                        <div class="present col-md-2">-83%</div>
                        <div class="you-like"><img
                                src="https://down-vn.img.susercontent.com/file/vn-11134207-7qukw-ljmk8q3cb4c4aa.webp"
                                alt="">
                        </div>
                        <div class="sale"><img src="./image/qc-9-9.png" alt=""></div>
                    </div>
                    <!-- thông tin -->
                    <div class="part-5-information col-md-12 display-flex product_son">
                        <p><span>Yêu thích</span>Áo thun tay lỡ unisex form rộng cổ V, áo phông Winhouse phối viền chất
                            liệu
                            cotton
                            thoáng mát.</p>
                    </div>
                    <!-- giá -->
                    <div class="part-5-price display-flex">
                        <p class="display-flex"><span class="d">đ</span>10.000</p>
                        <p>Đã bán 3,6k</p>
                    </div>
                </div>
            </div>
            <div class="part-6-content display-flex">
                <div class="part-6-like part-5-shirt">
                    <!-- ảnh sản phẩm -->
                    <div class="relative part-5-shirt-img">
                        <div class="present col-md-2">-72%</div>
                        <div class="you-like"><img
                                src="https://down-vn.img.susercontent.com/file/vn-11134207-7r98o-lzp0izma8cdd7b.webp"
                                alt="">
                        </div>
                        <div class="sale"><img src="./image/qc-9-9.png" alt=""></div>
                    </div>
                    <!-- thông tin -->
                    <div class="part-5-information col-md-12 display-flex product_son">
                        <p><span>Yêu thích</span>Quần short jeans mềm nữ to gấu lưng cao basic QU17</p>
                    </div>
                    <!-- giá -->
                    <div class="part-5-price display-flex">
                        <p class="display-flex"><span class="d">đ</span>1.000</p>
                        <p>Đã bán 33,2k</p>
                    </div>
                </div>
                <div class="part-6-like part-5-shirt">
                    <!-- ảnh sản phẩm -->
                    <div class="relative part-5-shirt-img">
                        <div class="present col-md-2">-56%</div>
                        <div class="you-like"><img
                                src="https://down-vn.img.susercontent.com/file/vn-11134207-7r98o-lv4sysi8ijnd63.webp"
                                alt="">
                        </div>
                        <div class="sale"><img src="./image/qc-9-9.png" alt=""></div>
                    </div>
                    <!-- thông tin -->
                    <div class="part-5-information col-md-12 display-flex product_son">
                        <p><span>Yêu thích</span>Quần ống rộng túi hộp đính nơ dập ly, quần ống suông nữ đũi</p>
                    </div>
                    <!-- giá -->
                    <div class="part-5-price display-flex">
                        <p class="display-flex"><span class="d">đ</span>79.000</p>
                        <p>Đã bán 3,6k</p>
                    </div>
                </div>
                <div class="part-6-like part-5-shirt">
                    <!-- ảnh sản phẩm -->
                    <div class="relative part-5-shirt-img">
                        <div class="present col-md-2">-46%</div>
                        <div class="you-like"><img
                                src="https://down-vn.img.susercontent.com/file/9404417ef0a534f09e82701c9d48f8e7.webp"
                                alt="">
                        </div>
                        <div class="sale"><img src="./image/qc-9-9.png" alt=""></div>
                    </div>
                    <!-- thông tin -->
                    <div class="part-5-information col-md-12 display-flex product_son">
                        <p><span>Yêu thích</span>Áo Sơ Mi Chất Nhung Tăm Nam Nữ Form Rộng Nâu Be Siêu Hot</p>
                    </div>
                    <!-- giá -->
                    <div class="part-5-price display-flex">
                        <p class="display-flex"><span class="d">đ</span>79.000</p>
                        <p>Đã bán 16,6k</p>
                    </div>
                </div>
                <div class="part-6-like part-5-shirt">
                    <!-- ảnh sản phẩm -->
                    <div class="relative part-5-shirt-img">
                        <div class="present col-md-2">-58%</div>
                        <div class="you-like"><img
                                src="https://down-vn.img.susercontent.com/file/vn-11134207-7r98o-lwe62l9o4ouxe1.webp"
                                alt="">
                        </div>
                        <div class="sale"><img src="./image/qc-9-9.png" alt=""></div>
                    </div>
                    <!-- thông tin -->
                    <div class="part-5-information col-md-12 display-flex product_son">
                        <p><span>Yêu thích</span>Áo thun nữ tay lỡ chất cotton su SIÊU NHÂN NHỆN phong cách HÀN
                            QUỐC
                            CAMASTORE
                            M1584</p>
                    </div>
                    <!-- giá -->
                    <div class="part-5-price display-flex">
                        <p class="display-flex"><span>đ</span>95.000</p>
                        <p>Đã bán 131</p>
                    </div>
                </div>
                <div class="part-6-like part-5-shirt">
                    <!-- ảnh sản phẩm -->
                    <div class="relative part-5-shirt-img">
                        <div class="present col-md-2">-80%</div>
                        <div class="you-like"><img
                                src="https://down-vn.img.susercontent.com/file/sg-11134201-22120-10utjduzc5kv6d.webp"
                                alt="">
                        </div>
                        <div class="sale"><img src="./image/qc-9-9.png" alt=""></div>
                    </div>
                    <!-- thông tin -->
                    <div class="part-5-information col-md-12 display-flex product_son">
                        <p><span>Yêu thích</span>Áo thun tay lỡ unisex form rộng cổ V, áo phông Winhouse phối viền chất
                            liệu
                            cotton
                            thoáng mát.</p>
                    </div>
                    <!-- giá -->
                    <div class="part-5-price display-flex">
                        <p class="display-flex"><span class="d">đ</span>1.000</p>
                        <p>Đã bán 226</p>
                    </div>
                </div>
                <div class="part-6-like part-5-shirt">
                    <!-- ảnh sản phẩm -->
                    <div class="relative part-5-shirt-img">
                        <div class="present col-md-2">-50%</div>
                        <div class="you-like"><img
                                src="https://down-vn.img.susercontent.com/file/vn-11134207-7r98o-lmircix2dbrz11.webp"
                                alt="">
                        </div>
                        <div class="sale"><img src="./image/qc-9-9.png" alt=""></div>
                    </div>
                    <!-- thông tin -->
                    <div class="part-5-information col-md-12 display-flex product_son">
                        <p><span>Yêu thích</span>Đai Chườm Nóng Ngải Cứu - Túi Chườm Lưng Bụng Ngải Cứu - Cắm điện</p>
                    </div>
                    <!-- giá -->
                    <div class="part-5-price display-flex">
                        <p class="display-flex"><span class="d">đ</span>318.660</p>
                        <p>Đã bán 123</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- phần 7 yêu cầu đăng nhập-->
    <center class="part-7 container">Xem Thêm</center>
    <!-- phần hr trên sản phẩm liên quan-->
    <div class="hr-product"></div>



    <!-- phần 10 chăm sóc khác hàng -->
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

    <!-- phần 12 footer -->
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
<script src="./javascript/javescript.js"></script>

</html>