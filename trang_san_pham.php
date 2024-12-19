<?php
// error_reporting(E_ALL);
// ini_set('display_errors', 1);
$target_dir = "img/";

session_start();
require 'sample.php';
if (isset($_POST['add_to_cart_1']) && isset($_POST['id'])) {
    $id = $_POST['id'];

    // Lấy thông tin sản phẩm từ cơ sở dữ liệu
    $sql = "SELECT * FROM products WHERE id ='$id'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Tạo sản phẩm và thêm vào giỏ hàng
        $product = [
            'id' => $row['id'],
            'name' => $row['name'],
            'price' => $row['price'],
            'img' => explode(',', $row['img']),
            'quantity' => 1
        ];

        // Lấy giỏ hàng từ cookie và cập nhật
        $cart = isset($_COOKIE['cart']) ? json_decode($_COOKIE['cart'], true) : [];

        // Kiểm tra nếu sản phẩm đã có trong giỏ hàng, tăng số lượng
        if (isset($cart[$id])) {
            $cart[$id]['quantity'] += 1;
        } else {
            $cart[$id] = $product;
        }

        // Cập nhật cookie giỏ hàng
        setcookie('cart', json_encode($cart), time() + (86400 * 7), "/");

        // Điều hướng lại trang để hiển thị số lượng cập nhật
        header("Location: " . $_SERVER['PHP_SELF'] . "?id=$id");
        exit();
    } else {
        echo "Sản phẩm không tồn tại.";
    }
}

?>
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
                    <div id="cart">
                        <?php

                        // Lấy giỏ hàng từ cookie và tính tổng số lượng
                        $cart = isset($_COOKIE['cart']) ? json_decode($_COOKIE['cart'], true) : [];
                        $totalQuantity = 0;

                        if (empty($cart)) {
                            echo "<p>Giỏ hàng trống</p>";
                        } else {
                            foreach ($cart as $item) {
                                $totalQuantity += $item['quantity'];
                            }
                            echo "<span class='cart-count'>$totalQuantity</span>"; // Hiển thị số lượng
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- phần thanh giữa chỉ dẫn vào-->
    <div class="shopee-link display-flex container">
        <p class="color-blue">Shopee</p>
        <p><i class="fa-solid fa-angle-right"></i></p>
        <p class="color-blue">Thời Trang Nữ</p>
        <p><i class="fa-solid fa-angle-right"></i></p>
        <p class="color-blue">Áo</p>
        <p><i class="fa-solid fa-angle-right"></i></p>
        <p>Áo Thun AM Nam Nữ Tay Lỡ PHỐI MÀU Form Rộng UIzzang</p>
    </div>

    <!-- phần 1 thông tin sản phẩm-->
    <div class="part-1 container display-flex">
        <?php
        // var_dump($_GET);
        // die;
        $id = $_GET['id'];
        $sql = "SELECT * FROM products WHERE id ='$id'";
        $result = $conn->query($sql);
        $products = [];

        // var_dump($result);
        if ($result->num_rows > 0) {
            // output data of each row
            $row = $result->fetch_assoc();

            // while ($row = $result->fetch_assoc()) {
            $id = $row['id'];
            $name = $row['name'];

            $price = $row['price'];
            $created_at = $row['created_at'];
            $user_id = $row['user_id'];
            $category_id = $row['category_id'];
            $da_ban = $row['da_ban'];
            // $img = $row['img'];

            $img_main = explode(',', $row['img']);
            // $img_gallery = ["image/ao-5.jpg", "image/ao-3.jpg", "image/ao-4.jpg"];

            // die;

        ?>
            <!-- phần 1 bên trái -->
            <div class="part-1-left col-md-4">

                <div class="album-container">
                    <!-- Hình lớn -->
                    <img id="mainImage" src="./image/image/<?php echo $img_main[0]; ?>" class="main-image" alt="Main Image">

                    <!-- Hình nhỏ -->
                    <div class="thumbnail-container">
                        <?php foreach ($img_main as $img): ?>
                            <img src="./image/image/<?php echo $img; ?>" class="thumbnail" onclick="swapImage(this)"
                                alt="Thumbnail">
                        <?php endforeach; ?>
                    </div>
                </div>

                <!-- phần chia sẽ dưới ảnh -->
                <div class="part-1-share display-flex">
                    <div class="display-flex ">
                        <p>Chia sẻ:</p>
                        <p class="color-blue"><i class="fa-brands fa-facebook-messenger"></i></p>
                        <p class="color-bluebold"><i class="fa-brands fa-facebook"></i></p>
                        <p class="color-red"><i class="fa-brands fa-pinterest"></i></p>
                        <p class="color-bluelight"><i class="fa-brands fa-twitter"></i></p>
                    </div>
                    <div class="hr-straight"></div>
                    <div class="display-flex ">
                        <p class="color-red"><i class="fa-regular fa-heart"></i></p>
                        <p>Đã thích (24,5k)</p>
                    </div>
                </div>
            </div>
            <!-- phần 1 bên phải -->
            <div class="part-1-right col-md-8">
                <!-- phần 1 bên phải tiêu đề-->
                <div>
                    <div class="part-1-right-title">
                        <p>
                            <? echo $name; ?>
                        </p>
                    </div>
                    <div class="Evaluate display-flex">
                        <div class="Evaluate-star display-flex">
                            <div class="star display-flex">
                                <p class="gach-chan">4.3</p>
                                <p>
                                    <span><i class="fa-solid fa-star"></i></span>
                                    <span><i class="fa-solid fa-star"></i></span>
                                    <span><i class="fa-solid fa-star"></i></span>
                                    <span><i class="fa-solid fa-star"></i></span>
                                    <span><i class="fa-regular fa-star"></i></span>
                                </p>
                            </div>
                            <div class="hr-straight"></div>
                            <div class="display-flex">
                                <p class="gach-chan">58,4k</p>
                                <p>Đánh Giá</p>
                            </div>
                            <div class="hr-straight"></div>
                            <div class="display-flex">
                                <p class="gach-chan">220,8k</p>
                                <p>Đã bán</p>
                            </div>
                        </div>
                        <div>Tố cáo</div>
                    </div>
                </div>
                <!-- phần 1 bên phải giá-->
                <div class="part-1-right-price display-flex">
                    <p style="text-decoration: line-through;" class="color-graylight">
                        <span class="gach-chan">đ</span>60.000 -
                        <span class="gach-chan">đ</span>70.000
                    </p>
                    <p class="price-red">
                        <? echo $price; ?>
                    </p>
                    <p>62% GIẢM</p>
                </div>
                <!-- phần thông tin -->
                <!-- mã giảm giá của shop -->
                <div class="Discount-Code display-flex">
                    <div class="col-md-2">Mã Giảm Giá Của Shop</div>
                    <div class="col-md-10 display-flex">
                        <p>Giảm <span class="gach-chan đ">đ</span>5k</p>
                    </div>
                </div>
                <!-- Chính Sách Trả Hàng -->
                <div class="display-flex">
                    <div class="col-md-2">Chính Sách Trả Hàng</div>
                    <div class="Return-Policy col-md-10 display-flex ">
                        <div><img src="./image/tra-hang.png" alt="" /></div>
                        <div>Trả hàng 15 ngày</div>
                        <div class="color-graylight display-flex">
                            <p>Đổi ý miễn phí</p>
                            <p><i class="fa-regular fa-circle-question"></i></p>
                        </div>
                    </div>
                </div>
                <!-- Bảo hiểm -->
                <div class="Insurance-total display-flex">
                    <div class="col-md-2">Bảo hiểm</div>
                    <div class="Insurance col-md-10 display-flex">
                        <p>Bảo hiểm thời trang
                        <p class="Insurance-new">Mới</p>
                        </p>
                        <p class="color-blue">Tìm hiểu thêm</p>
                    </div>
                </div>
                <!-- Vận chuyển -->
                <div class="Transport display-flex">
                    <div class="col-md-2">Vận chuyển</div>
                    <div class="Transport-content col-md-10">
                        <div class="display-flex">
                            <div class="col-md-1"><img src="./image/free-ship.png" alt="" /></div>
                            <div class="col-md-11">Miễn phí vận chuyển</div>
                        </div>
                        <div class="display-flex">
                            <div class="col-md-1"><img src="./image/xe-van-chuyen.svg" alt="" /></div>
                            <div class="col-md-2">Vận chuyển tới</div>
                            <div class="display-flex col-md-9">
                                <p>Phường Hòa Minh, Quận Liên Chiểu</p>
                                <p><i class="fa-solid fa-angle-down"></i></p>
                            </div>
                        </div>
                        <div class="display-flex">
                            <div class="col-md-1"></div>
                            <div class="col-md-2">Phí Vận Chuyển</div>
                            <div class="display-flex col-md-9">
                                <p><span class="gach-chan">đ</span>0</p>
                                <p><i class="fa-solid fa-angle-down"></i></p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Màu sắc -->
                <div class="color-part-1 display-flex">
                    <div class="col-md-2">Màu</div>
                    <div class="color-part-1-content col-md-10 overflow-auto ">
                        <div class="hoodi display-flex">
                            <div class="shirt-color display-flex col-md-4">
                                <div class="col-md-2"><img src="./image/ao-1.png" alt="" /></div>
                                <div class="col-md-10">LBB ĐÔI NÂU</div>
                            </div>
                            <div class="shirt-color display-flex col-md-5">
                                <div><img src="./image/ao-2.jpg" alt="" /></div>
                                <div>LBB HỒNG NHẠT</div>
                            </div>
                        </div>
                        <div class="hoodi display-flex">
                            <div class="shirt-color display-flex col-md-5">
                                <div><img src="./image/ao-3.jpg" alt="" /></div>
                                <div>LBB CẶP ĐÔI HỒNG</div>
                            </div>
                            <div class="shirt-color display-flex col-md-5">
                                <div><img src="./image/ao-8.jpg" alt="" /></div>
                                <div>LBB HỒNG ĐẬM (0 GẤU)</div>
                            </div>
                        </div>
                        <div class="hoodi display-flex">
                            <div class="shirt-color display-flex col-md-4">
                                <div><img src="./image/ao-4.jpg" alt="" /></div>
                                <div>LBB CẶP ĐÔI HỒNG</div>
                            </div>
                            <div class="shirt-color display-flex col-md-4">
                                <div><img src="./image/ao-5.jpg" alt="" /></div>
                                <div>LBB HỒNG ĐẬM (0 GẤU)</div>
                            </div>
                        </div>
                        <div class="hoodi display-flex">
                            <div class="shirt-color display-flex col-md-4">
                                <div><img src="./image/ao-6.jpg" alt="" /></div>
                                <div>LBB CẶP ĐÔI HỒNG</div>
                            </div>
                            <div class="shirt-color display-flex col-md-4">
                                <div><img src="./image/ao-7.jpg" alt="" /></div>
                                <div>LBB HỒNG ĐẬM (0 GẤU)</div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- size -->
                <div class="display-flex">
                    <div class="col-md-2">SIZE</div>
                    <div class="size-content col-md-10 display-flex">
                        <p>M(30-45KG)</p>
                        <p>L(46-70KG)</p>
                    </div>
                </div>
                <!-- SỐ LƯỢNG -->
                <div class="display-flex">
                    <div class="col-md-2">Số Lượng</div>
                    <div class="quantity col-md-10 display-flex">
                        <p>-</p>
                        <p>1</p>
                        <p>+</p>
                    </div>
                </div>
                <!-- Thêm vào giỏ hàng -->
                <div class="add-to-cart display-flex">
                    <form action="trang_san_pham.php" method="POST">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="hidden" name="add_to_cart_1" value="1">
                        <button type="submit">Thêm vào giỏ hàng</button>
                    </form>
                    <form action="paypal_payment.php" method="POST">
                        <!-- Truyền thông tin sản phẩm -->
                        <input type="hidden" name="name" value="<?php echo $name; ?>">
                        <input type="hidden" name="price" value="<?php echo $price; ?>"> <!-- Giá sản phẩm -->
                        <button type="submit" class="btn btn-primary">Mua ngay</button>
                    </form>
                </div>
                <!-- <div class="display-flex">
        <div class="display-flex">
          <div><img src="./image/s.png" alt=""></div>
          <div>Shopee Đảm Bảo</div>
        </div>
        <div>Trả hàng miễn phí 15 ngày</div>
      </div> -->
            <?
        }
        // } 
            ?>
            <div>
                <hr>
            </div>
            </div>
    </div>

    <!-- phần 2 thông tin shop -->
    <div class="part-2 container display-flex">
        <!-- phần 2 bên trái -->

        <div class="part-2-left col-md-4 display-flex">
            <?php
            // var_dump($_GET);
            // die;
            $id = $_GET['id'];
            $sql = "SELECT * FROM store WHERE id ='$id'";
            $result = $conn->query($sql);
            $products = [];

            // var_dump($result);
            if ($result->num_rows > 0) {
                // output data of each row
                $row = $result->fetch_assoc();
                $id = $row['id'];
                $user_id = $row['user_id'];
                $id_products = $row['id_products'];
                $ten_cua_hang = $row['ten_cua_hang'];
                $gio_online = $row['gio_online'];
                $link = $row['link'];

                $hinh_anh_cua_hang = $row['hinh_anh_cua_hang'];
                $hinh_anh_cua_hang = str_replace("uploads/", "", $hinh_anh_cua_hang);
                // var_dump($hinh_anh_cua_hang);
                // die;
            ?>
                <div class="part-2-left-imgshop col-md-4">
                    <img style='width:100px' src="./image/uploads/<?php echo $hinh_anh_cua_hang; ?>" alt="Main Image">
                </div>
                <div class="part-2-left-nameshop col-md-8">
                    <div>
                        <h4>
                            <? echo $ten_cua_hang; ?>
                        </h4>
                        <p>
                            <? echo $gio_online; ?>
                        </p>
                    </div>
                    <div class="display-flex">
                        <button class="Chat-Now display-flex">
                            <p><i class="fa-solid fa-message"></i></p>
                            <p>Chat Ngay</p>
                        </button>
                        <button class="see-shop display-flex">
                            <p><i class="fa-solid fa-shop"></i></p>
                            <a href="<? echo $link; ?>">
                                <p>Xem Shop</p>
                            </a>
                        </button>
                    </div>
                </div>
            <?
            }
            ?>
        </div>

        <div class="hr-straight"></div>
        <!-- phần 2 bên phải -->
        <div class="part-2-right col-md-8 display-flex">
            <div class="col-md-4">
                <div class="part-2-right-content display-flex">
                    <p>Đánh giá</p>
                    <p class="color-red">25,5k</p>
                </div>
                <div class="part-2-right-content display-flex">
                    <p>Sản phẩm</p>
                    <p class="color-red">143</p>
                </div>
            </div>
            <div class=" col-md-4">
                <div class="part-2-right-content display-flex">
                    <p>Tỉ lệ phản hồi</p>
                    <p class="color-red">93%</p>
                </div>
                <div class="part-2-right-content display-flex">
                    <p>Thời gian phản hồi</p>
                    <p class="color-red">trong vài giờ</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="part-2-right-content display-flex">
                    <p>Tham gia</p>
                    <p class="color-red">3 năm trước</p>
                </div>
                <div class="part-2-right-content display-flex">
                    <p>Người Theo Dõi</p>
                    <p class="color-red">76,1k</p>
                </div>
            </div>
        </div>
    </div>

    <!-- phần 3 chi tiết sản phẩm -->
    <div class="part-3 container">
        <div class="title-shop">CHI TIẾT SẢN PHẨM</div>
        <div>
            <table class="PRODUCT-DETAILS">
                <tr>
                    <td class="color-graylight">Danh mục</td>
                    <td class="color-blue">Shopee > Thời Trang Nữ > Áo > Áo thun</td>
                </tr>
                <tr>
                    <td class="color-graylight">Kho</td>
                    <td>9888</td>
                </tr>
                <tr>
                    <td class="color-graylight">Xuất xứ</td>
                    <td>Việt Nam</td>
                </tr>
                <tr>
                    <td class="color-graylight">Cổ áo</td>
                    <td>Cổ tròn</td>
                </tr>
                <tr>
                    <td class="color-graylight">Chất liệu</td>
                    <td>Cotton</td>
                </tr>
                <tr>
                    <td class="color-graylight">Mùa</td>
                    <td>Mùa hè</td>
                </tr>
                <tr>
                    <td class="color-graylight">Mẫu</td>
                    <td>In</td>
                </tr>
                <tr>
                    <td class="color-graylight">Dịp</td>
                    <td>Hằng Ngày</td>
                </tr>
                <tr>
                    <td class="color-graylight">Cropped Top</td>
                    <td>Không</td>
                </tr>
                <tr>
                    <td class="color-graylight">Gửi từ</td>
                    <td>Hà Nội</td>
                </tr>
            </table>
        </div>
        <div class="title-shop">MÔ TẢ SẢN PHẨM</div>
        <div class="PRODUCT-DESCRIPTION">
            <div class="col-md-12"><img src="./image/ao-2.png" alt=""></div>
            <div class="col-md-12"><img src="./image/ao-2.jpg" alt=""></div>
            <div class="col-md-12"><img src="./image/ao-3.jpg" alt=""></div>
            <div class="col-md-12"><img src="./image/ao-4.jpg" alt=""></div>
        </div>
        <div>
            <p>Áo thun nữ tay lỡ chất cotton thoáng mát in hình VƯƠNG NIỆM phong cách Hàn Quốc</p>
            <p>Áo thun nữ năng động, xinh xắn luôn là sản phẩm yêu thích của các cô gái trẻ và chưa bao giờ bị xem
                là
                lỗi mốt theo thời gian. áo thun nữ tay ngắn,tay dài form rộng khiến việc vận động dễ dàng thoải mái
                giúp
                phái
                đẹp
                tham gia vào các hoạt động một cách tự tin hơn. Áo thun nữ có cổ dạng cổ tim,cổ vuông dáng ôm sẽ
                mang
                lại ấn
                tượng
                trẻ trung, khỏe khoắn cho người mặc. Những chiếc áo thun nữ cao cấp phù hợp cho mọi hoàn cảnh, bạn
                có
                thể mặc nó
                đến
                những bữa tiệc, dã ngoại ngoài trời hay ngay cả khi làm việc.</p>
            <p>Áo thun nữ form rộng không những không khiến người mặc trở nên luộm thuộm mà ngược lại, trông rất
                phong
                cách
                với kiểu dáng tay lỡ,tay dài. Và dĩ nhiên là áo thun nữ form rộng unisex giá rẻ in hình nữ tính mặc
                cũng
                rất
                thoải mái rồi. Đôi khi nhìn các cô nàng còn rất đáng yêu, khả ái nữa cơ.</p>
            <p>Áo thun nữ tay ngắn là một item không thể thiếu trong tủ đồ của những cô nàng sành điệu. Nhất là khi
                hè
                về,
                những mẫu áo phông nữ ngắn tay được thiết kế với dáng ôm hoặc form rộng cổ tròn in hình cá tính, đẹp
                mắt
                được
                sản xuất hàng loạt và nhanh chóng cháy hàng.</p>
            <p>Áo thun nữ tay dài form rộng được làm bằng chất liệu thun luôn được các bạn trẻ yêu mến.Áo thun
                cotton nữ
                dài
                tay có cổ nhẹ nhàng, mềm mại ôm lấy toàn bộ cơ thể sưởi ấm mà không cần phải mặc quá nhiều đồ.Áo
                thun nữ
                tay dài
                cũng là sự lựa chọn hoàn hảo khi kết hợp với chân váy ngắn, quần váy duyên dáng, nữ tính khoe vóc
                dáng
                yêu kiều
                và vòng eo nhỏ xinh.</p>
            <p>Thông tin sản phẩm Áo thun Unisex</p>
            <ul>
                <li>✔ Chất liệu: thun cotton 100%, co giãn 4 chiều, vải mềm, vải mịn, thoáng mát, không xù lông.
                </li>
                <li>✔ Đường may chuẩn chỉnh, tỉ mỉ, chắc chắn.</li>
                <li>✔ Mặc ở nhà, mặc đi chơi hoặc khi vận động thể thao. Phù hợp khi mix đồ với nhiều loại.</li>
                <li>✔ Thiết kế hiện đại, trẻ trung, năng động. Dễ phối đồ.</li>
                <li>✔ size . frre size dưới 65kg</li>
            </ul>
            <p>CHÚNG TÔI XIN CAM KẾT:</p>
            <p>Áo thun Unisex phông trơn nam nữ tay lỡ form rộng</p>
            <p>Đảm bảo vải chuẩn cotton 4 chiều 100% chất lượng .</p>
            <p>Hàng có sẵn, giao hàng ngay khi nhận được đơn đặt hàng .</p>
            <p>Hoàn tiền 100% nếu sản phẩm lỗi, nhầm hoặc không giống với mô tả.</p>
            <p>Giao hàng toàn quốc, thanh toán khi nhận hàng.</p>
            <p>--------------------------------------JUME STORE CHUYẾN SỈ LẺ QUẦN ÁO -----------------------------
            </p>
            <p>JUME STORE cảm ơn khách hàng đã tin tưởng mua hàng tại shop, mong rằng quý bạn sẽ có thời gian thư
                giãn
                thoải
                mái tại shop!</p>
            <p>#aothuntayloformrong #aothuntaylo #aothuntaylofreesize #aothuntaylounisex #aothununisex #aoformrong
                #aonhom
                #aolop #aocouple #aocap #aopolo #aothuntaylococo</p>
        </div>
    </div>

    <!-- phần 4 đánh giá sản phẩm -->
    <div class="part-4 container">
        <!-- đánh giá sao -->
        <div class="title-shop">ĐÁNH GIÁ SẢN PHẨM</div>
        <div class="part-4-Evaluate display-flex">
            <div class="part-4-Evaluate-left col-md-2 color-red">
                <div><span>4.3</span> trên 5</div>
                <div class=" display-flex">
                    <p><i class="fa-solid fa-star"></i></p>
                    <p><i class="fa-solid fa-star"></i></p>
                    <p><i class="fa-solid fa-star"></i></p>
                    <p><i class="fa-solid fa-star"></i></p>
                    <p><i class="fa-regular fa-star"></i></p>
                </div>
            </div>
            <div class="part-4-Evaluate-right col-md-10">
                <div class="display-flex">
                    <p class="col-md-1">Tất cả</p>
                    <p class="col-md-2">5 Sao (62)</p>
                    <p class="col-md-2">4 Sao (3)</p>
                    <p class="col-md-2">3 Sao (2)</p>
                    <p class="col-md-2">2 Sao (2)</p>
                    <p class="col-md-2">1 Sao (3)</p>
                </div>
                <div class="display-flex">
                    <p class="col-md-3">Có Bình Luận (41)</p>
                    <p class="col-md-4">Có Hình Ảnh / Video (13)</p>
                </div>
            </div>
        </div>
        <!-- phần bình luận của người mua -->
        <div class="tab-content" id="nav-tabContent">
            <!-- trang bình luận 1 -->
            <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                <!-- bình luận 1 -->
                <div class="Buyer-comments display-flex comment-tmbin216">
                    <div class="comments-img col-md-1"><img
                            src="https://down-vn.img.susercontent.com/file/vn-11134233-7r98o-llqk30l44man8b_tn" alt="">
                    </div>
                    <div class="col-md-11">
                        <div>dehuynh212</div>
                        <div class="comment-star color-red display-flex">
                            <p><i class="fa-solid fa-star"></i></p>
                            <p><i class="fa-solid fa-star"></i></p>
                            <p><i class="fa-solid fa-star"></i></p>
                            <p><i class="fa-solid fa-star"></i></p>
                            <p><i class="fa-solid fa-star"></i></p>
                        </div>
                        <div class="display-flex">
                            <p>2024-05-29 06:54 </p>
                            <p class="hr-straight"></p>
                            <p> Phân loại hàng: BYC ĐEN HỒNG,M(30-45KG)</p>
                        </div>
                        <div class="describe-comment">
                            <p><span class="color-graylight">Màu sắc:</span> đen</p>
                            <p><span class="color-graylight">Đúng với mô tả:</span> đúng</p>
                            <p><span class="color-graylight">Chất liệu:</span> vải</p>
                            <p>Sản phẩm rất tuyệt vời lại còn rẻ nữa giao hàng nhanh mình mua ở đây mấy lần rồi uy
                                tín
                                lắm mọi người
                                nên
                                mua thử nha</p>
                        </div>
                        <div class="dehuynh212-img display-flex">
                            <div class="video-comment col-md-1"><iframe
                                    src="https://down-tx-sg.vod.susercontent.com/api/v4/11110103/mms/vn-11110103-6ke17-lvqvxru3p8c994.default.mp4"
                                    frameborder="0"></iframe></div>
                            <div class="col-md-1"><img
                                    src="https://down-vn.img.susercontent.com/file/vn-11134103-7r98o-lvqvy4eda02i4b@resize_w72_nl.webp"
                                    alt=""></div>
                            <div class="col-md-1"><img
                                    src="https://down-vn.img.susercontent.com/file/vn-11134103-7r98o-lvqvy4en9kzd92@resize_w72_nl.webp"
                                    alt=""></div>
                            <div class="col-md-1"><img
                                    src="https://down-vn.img.susercontent.com/file/vn-11134103-7r98o-lvqvy4g17kd674@resize_w72_nl.webp"
                                    alt=""></div>
                            <div class="col-md-1"><img
                                    src="https://down-vn.img.susercontent.com/file/vn-11134103-7r98o-lvqvy4fr7yzece@resize_w72_nl.webp"
                                    alt=""></div>
                            <div class="col-md-1"><img
                                    src="https://down-vn.img.susercontent.com/file/vn-11134103-7r98o-lvqvy4g17jw914@resize_w72_nl.webp"
                                    alt=""></div>
                        </div>
                        <div class="useful color-graylight display-flex">
                            <div class=" display-flex">
                                <p><i class="fa-solid fa-thumbs-up"></i></p>
                                <p>hữu ích?</p>
                            </div>
                            <div class="color-graylight"><i class="fa-solid fa-ellipsis-vertical"></i></div>
                        </div>
                    </div>
                </div>
                <div class="hr-comments">
                    <hr>
                </div>

                <!-- bình luận 2 -->
                <div class="Buyer-comments display-flex comment-tmbin216">
                    <div class="comments-img col-md-1"><img
                            src="https://down-vn.img.susercontent.com/file/vn-11134233-7r98o-ls5in8uqmqbof0_tn" alt="">
                    </div>
                    <div class="col-md-11">
                        <div>gamque123</div>
                        <div class="comment-star color-red display-flex">
                            <p><i class="fa-solid fa-star"></i></p>
                            <p><i class="fa-solid fa-star"></i></p>
                            <p><i class="fa-solid fa-star"></i></p>
                            <p><i class="fa-solid fa-star"></i></p>
                            <p><i class="fa-solid fa-star"></i></p>
                        </div>
                        <div class="display-flex">
                            <p>2024-03-11 07:39</p>
                            <p class="hr-straight"></p>
                            <p>Phân loại hàng: 91 TRẮNG,L(46-70KG)</p>
                        </div>
                        <div class="describe-comment">
                            <p><span class="color-graylight">Chất liệu:</span> tốt</p>
                            <p><span class="color-graylight">Màu sắc:</span> trắng xanh</p>
                            <p><span class="color-graylight">Đúng với mô tả:</span> đúng</p>
                            <p>
                            <p>Chất lượng áo oki </p>
                            <p>Áo ko quá dày cx ko quá mỏng, mặc mát</p>
                            <p>Độ dài của áo cx vừa phải ko quá dài có thể mặc giấu quần</p>
                            <p>Mik kêu cần gấp nên shop giao áo rất nhanh cho mik </p>
                            <p>Nch với giá đó là quá oki ko có gì để chê cả</p>
                            </p>
                        </div>
                        <div class="dehuynh212-img display-flex">
                            <div class="video-comment col-md-1"><iframe
                                    src="https://down-tx-sg.vod.susercontent.com/api/v4/11110103/mms/vn-11110103-6ke17-lsqbeac6u2zd28.default.mp4"
                                    frameborder="0"></iframe></div>
                            <div class="col-md-1"><img
                                    src="https://down-vn.img.susercontent.com/file/vn-11134103-7r98o-lsqbd86god5l62@resize_w72_nl.webp"
                                    alt="">
                            </div>
                            <div class="col-md-1"><img
                                    src="https://down-vn.img.susercontent.com/file/vn-11134103-7r98o-lsqbd85cpzno72@resize_w72_nl.webp"
                                    alt="">
                            </div>
                            <div class="col-md-1"><img
                                    src="https://down-vn.img.susercontent.com/file/vn-11134103-7r98o-lsqbd85cre8497@resize_w72_nl.webp"
                                    alt="">
                            </div>
                        </div>
                        <div class="useful color-graylight display-flex">
                            <div class=" display-flex">
                                <p><i class="fa-solid fa-thumbs-up"></i></p>
                                <p>898</p>
                            </div>
                            <div class="color-graylight"><i class="fa-solid fa-ellipsis-vertical"></i></div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- trang bình luận 2 -->
            <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                <!-- bình luận 1 -->
                <div class="Buyer-comments display-flex comment-tmbin216">
                    <div class="comments-img col-md-1"><img
                            src="https://down-vn.img.susercontent.com/file/vn-11134233-7r98o-ln826wa5s0ygf9_tn" alt="">
                    </div>
                    <div class="col-md-11">
                        <div>hngtho946</div>
                        <div class="comment-star color-red display-flex">
                            <p><i class="fa-solid fa-star"></i></p>
                            <p><i class="fa-solid fa-star"></i></p>
                            <p><i class="fa-solid fa-star"></i></p>
                            <p><i class="fa-solid fa-star"></i></p>
                            <p><i class="fa-solid fa-star"></i></p>
                        </div>
                        <div class="display-flex">
                            <p>2023-11-13 14:18</p>
                            <p class="hr-straight"></p>
                            <p>Phân loại hàng: TULIP XANH,M(30-45KG)</p>
                        </div>
                        <div class="describe-comment">
                            <p><span class="color-graylight">Màu sắc:</span> màu trắng</p>
                            <p><span class="color-graylight">Đúng với mô tả:</span>chính xác nhất</p>
                            <p><span class="color-graylight">Chất liệu:</span> Thun giãn</p>
                            <p>
                            <p>Cảm ơn shop nhiều nhé yêu shop</p>
                            <p>Thời gian giao hàng như dự kiến</p>
                            <p>Shop xứng đáng được 10 điểm</p>
                            </p>
                        </div>
                        <div class="dehuynh212-img display-flex">
                            <div class="video-comment col-md-1"><iframe
                                    src="https://down-aka-sg.vod.susercontent.com/api/v4/11110103/mms/vn-11110103-6ke18-lo0v3f2xoa999a.default.mp4"
                                    frameborder="0"></iframe></div>
                            <div class="col-md-1"><img
                                    src="https://down-vn.img.susercontent.com/file/vn-11134103-7r98o-lo0v7tffya2i81@resize_w72_nl.webp"
                                    alt=""></div>
                            <div class="col-md-1"><img
                                    src="https://down-vn.img.susercontent.com/file/vn-11134103-7r98o-lo0v7tffya5p1b@resize_w72_nl.webp"
                                    alt=""></div>
                            <div class="col-md-1"><img
                                    src="https://down-vn.img.susercontent.com/file/vn-11134103-7r98o-lo0v7tfpxvjhdb@resize_w72_nl.webp"
                                    alt=""></div>
                            <div class="col-md-1"><img
                                    src="https://down-vn.img.susercontent.com/file/vn-11134103-7r98o-lo0v7tfqdbsda0@resize_w72_nl.webp"
                                    alt=""></div>
                            <div class="col-md-1"><img
                                    src="https://down-vn.img.susercontent.com/file/vn-11134103-7r98o-lo0v7tg9x2b195@resize_w72_nl.webp"
                                    alt=""></div>
                        </div>
                        <div class="useful color-graylight display-flex">
                            <div class=" display-flex">
                                <p><i class="fa-solid fa-thumbs-up"></i></p>
                                <p>333</p>
                            </div>
                            <div class="color-graylight"><i class="fa-solid fa-ellipsis-vertical"></i></div>
                        </div>
                    </div>
                </div>
                <div class="hr-comments">
                    <hr>
                </div>

                <!-- bình luận 2 -->
                <div class="Buyer-comments display-flex comment-tmbin216">
                    <div class="comments-img col-md-1"><img
                            src="https://down-vn.img.susercontent.com/file/vn-11134233-7r98o-ln295zj81wz715_tn" alt="">
                    </div>
                    <div class="col-md-11">
                        <div>tdi3peghc2</div>
                        <div class="comment-star color-red display-flex">
                            <p><i class="fa-solid fa-star"></i></p>
                            <p><i class="fa-solid fa-star"></i></p>
                            <p><i class="fa-solid fa-star"></i></p>
                            <p><i class="fa-solid fa-star"></i></p>
                            <p><i class="fa-solid fa-star"></i></p>
                        </div>
                        <div class="display-flex">
                            <p>2023-10-22 16:36</p>
                            <p class="hr-straight"></p>
                            <p>Phân loại hàng: MÈO MAKE,L(46-70KG)</p>
                        </div>
                        <div class="describe-comment">
                            <p><span class="color-graylight">Chất liệu:</span> tốt</p>
                            <p><span class="color-graylight">Màu sắc:</span>Trắng</p>
                            <p><span class="color-graylight">Đúng với mô tả:</span> đúng</p>
                            <p>
                            <p>Áo vải cotton, đẹp, in hình dễ thương, sắc nét, lên màu chuẩn.</p>
                            <p>Mặc mát, thoải mái, co giãn tốt.</p>
                            <p>Giá hạt dẻ mà chất lượng tốt. </p>
                            <p>Shop rất có tâm, mọi người nên mua nha👍</p>
                            </p>
                        </div>
                        <div class="dehuynh212-img display-flex">
                            <div class="video-comment col-md-1"><iframe
                                    src="https://down-aka-sg.vod.susercontent.com/api/v4/11110103/mms/vn-11110103-6ke14-ln5lk6c1vc9k52.default.mp4"
                                    frameborder="0"></iframe></div>
                            <div class="col-md-1"><img
                                    src="https://down-vn.img.susercontent.com/file/vn-11134103-7r98o-ln5lit7rr07s31@resize_w72_nl.webp"
                                    alt="">
                            </div>
                            <div class="col-md-1"><img
                                    src="https://down-vn.img.susercontent.com/file/vn-11134103-7r98o-ln5lit5ju95kff@resize_w72_nl.webp"
                                    alt="">
                            </div>
                            <div class="col-md-1"><img
                                    src="https://down-vn.img.susercontent.com/file/vn-11134103-7r98o-ln5lit7rseurd0@resize_w72_nl.webp"
                                    alt="">
                            </div>
                        </div>
                        <div class="useful color-graylight display-flex">
                            <div class=" display-flex">
                                <p><i class="fa-solid fa-thumbs-up"></i></p>
                                <p>247</p>
                            </div>
                            <div class="color-graylight"><i class="fa-solid fa-ellipsis-vertical"></i></div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- trang bình luận 3 -->
            <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
                <!-- bình luận 1 -->
                <div class="Buyer-comments display-flex comment-tmbin216">
                    <div class="comments-img col-md-1"><img
                            src="https://down-vn.img.susercontent.com/file/vn-11134233-7r98o-lpyl94es5irb18_tn" alt="">
                    </div>
                    <div class="col-md-11">
                        <div>quhngnguynth616</div>
                        <div class="comment-star color-red display-flex">
                            <p><i class="fa-solid fa-star"></i></p>
                            <p><i class="fa-solid fa-star"></i></p>
                            <p><i class="fa-solid fa-star"></i></p>
                            <p><i class="fa-solid fa-star"></i></p>
                            <p><i class="fa-solid fa-star"></i></p>
                        </div>
                        <div class="display-flex">
                            <p>2024-01-02 11:07</p>
                            <p class="hr-straight"></p>
                            <p>Phân loại hàng: NERSHIER TUKIP,L(46-70KG)</p>
                        </div>
                        <div class="describe-comment">
                            <p><span class="color-graylight">Chất liệu:</span>vải mềm mại mịn</p>
                            <p><span class="color-graylight">Màu sắc:</span> chuẩn</p>
                            <p><span class="color-graylight">Đúng với mô tả:</span>đúng với mô tả</p>
                            <p>Mọi người nên mua ủng hộ shop ạ , hình ảnh chỉ mang tính chất nhận xu...</p>
                        </div>
                        <div class="dehuynh212-img display-flex">
                            <div class="video-comment col-md-1"><iframe
                                    src="https://down-aka-sg.vod.susercontent.com/api/v4/11110103/mms/vn-11110103-6ke16-lq01hkxwh6tuaa.default.mp4"
                                    frameborder="0"></iframe></div>
                            <div class="col-md-1"><img
                                    src="https://down-vn.img.susercontent.com/file/vn-11134103-7r98o-lq013xyv6wqf18@resize_w72_nl.webp"
                                    alt="">
                            </div>
                            <div class="col-md-1"><img
                                    src="https://down-vn.img.susercontent.com/file/vn-11134103-7r98o-lq013xyv6wqf18@resize_w72_nl.webp"
                                    alt="">
                            </div>
                        </div>
                        <div class="useful color-graylight display-flex">
                            <div class=" display-flex">
                                <p><i class="fa-solid fa-thumbs-up"></i></p>
                                <p>51</p>
                            </div>
                            <div class="color-graylight"><i class="fa-solid fa-ellipsis-vertical"></i></div>
                        </div>
                    </div>
                </div>
                <div class="hr-comments">
                    <hr>
                </div>

                <!-- bình luận 2 -->
                <div class="Buyer-comments display-flex comment-tmbin216">
                    <div class="comments-img col-md-1"><img
                            src="https://down-vn.img.susercontent.com/file/7d475db424abbec0e25b512c275ef90d_tn" alt="">
                    </div>
                    <div class="col-md-11">
                        <div>thuynguyen181287</div>
                        <div class="comment-star color-red display-flex">
                            <p><i class="fa-solid fa-star"></i></p>
                            <p><i class="fa-solid fa-star"></i></p>
                            <p><i class="fa-solid fa-star"></i></p>
                            <p><i class="fa-solid fa-star"></i></p>
                            <p><i class="fa-solid fa-star"></i></p>
                        </div>
                        <div class="display-flex">
                            <p>2023-11-09 14:22</p>
                            <p class="hr-straight"></p>
                            <p>Phân loại hàng: GALATIC,L(46-70KG)</p>
                        </div>
                        <div class="describe-comment">
                            <p><span class="color-graylight">Màu sắc:</span>chuẩn</p>
                            <p><span class="color-graylight">Chất liệu:</span> đẹp</p>
                            <p><span class="color-graylight">Đúng với mô tả:</span> đúng</p>
                            <p>Áo đẹp, đường kim mũi chỉ may cẩn thận. Chất mặc mùa thu hợp hơn. Với giá tiền rẻ như
                                vậy
                                mà mua được
                                áo này là quá OK r. Ủng hộ shop nhé. Giao hàng nhanh, đóng hàng cẩn thận nữa
                            </p>
                        </div>
                        <div class="dehuynh212-img display-flex">
                            <div class="video-comment col-md-1"><iframe
                                    src="https://down-aka-sg.vod.susercontent.com/api/v4/11110103/mms/vn-11110103-6ke16-lnv5q6zovrvx45.default.mp4"
                                    frameborder="0"></iframe></div>
                            <div class="col-md-1"><img
                                    src="https://down-vn.img.susercontent.com/file/vn-11134103-7r98o-lnv5oh2thgfu60@resize_w72_nl.webp"
                                    alt="">
                            </div>
                        </div>
                        <div class="useful color-graylight display-flex">
                            <div class=" display-flex">
                                <p><i class="fa-solid fa-thumbs-up"></i></p>
                                <p>27</p>
                            </div>
                            <div class="color-graylight"><i class="fa-solid fa-ellipsis-vertical"></i></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- cách tạo chuyển trang -->
        <nav aria-label="Page navigation example">
            <div class="nav nav-tabs display-flex nav-number pagination" id="nav-tab" role="tablist">
                <button class="page-item"><i class="fa-solid fa-angle-left"></i></button>
                <button class="nav-link active page-item" id="nav-home-tab" data-bs-toggle="tab"
                    data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">1
                </button>
                <button class="nav-link page-item" id="nav-profile-tab " data-bs-toggle="tab"
                    data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile"
                    aria-selected="false">2
                </button>
                <button class="nav-link page-item" id="nav-contact-tab" data-bs-toggle="tab"
                    data-bs-target="#nav-contact" type="button" role="tab" aria-controls="nav-contact"
                    aria-selected="false">3
                </button>
                <button class="page-item"><i class="fa-solid fa-angle-right"></i></button>
            </div>
        </nav>
    </div>

    <!-- phần 5 sản phẩm khác-->
    <div class="part-5 container">
        <div class="title-shop">CÁC SẢN PHẨM KHÁC CỦA SHOP</div>
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

    <!-- phần 6 sản phẩm bạn cũng thích-->
    <div class="part-6 container">
        <div class="title-shop">CÓ THỂ BẠN CŨNG THÍCH</div>
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
                <div class="part-5-information col-md-12 display-flex">
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
                <div class="part-5-information col-md-12 display-flex">
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
                <div class="part-5-information col-md-12 display-flex">
                    <p><span>Yêu thích</span>Áo thun tay lỡ unisex nam nữ LABUBU LUXA, Áo phông unisex form rộng</p>
                </div>
                <!-- giá -->
                <div class="part-5-price display-flex">
                    <p class="display-flex"><span class="d">đ</span>30.900 - <span>đ</span>30.900</p>
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
                <div class="part-5-information col-md-12 display-flex">
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
                <div class="part-5-information col-md-12 display-flex">
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
                <div class="part-5-information col-md-12 display-flex">
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
                <div class="part-5-information col-md-12 display-flex">
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
                <div class="part-5-information col-md-12 display-flex">
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
                <div class="part-5-information col-md-12 display-flex">
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
                <div class="part-5-information col-md-12 display-flex">
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
                <div class="part-5-information col-md-12 display-flex">
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
                <div class="part-5-information col-md-12 display-flex">
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

    <!-- phần 7 yêu cầu đăng nhập-->
    <center class="part-7 container">Xem Thêm</center>
    <!-- phần hr trên sản phẩm liên quan-->
    <div class="hr-product"></div>

    <!-- phần 8 sản phẩm liên quan-->
    <div class="part-8 ">
        <div class="related-products container">
            <div class="title-shop">Sản Phẩm Liên Quan</div>
            <table>
                <tr>
                    <td>1.TheBlueTshirt - Áo thun nữ cổ chữ V cotton phom thuỷ thủ P Sailor T - BCI White</td>
                    <td class="display-flex"><span class="đ">đ</span>588.050</td>
                </tr>
                <tr>
                    <td>2.Áo thun nữ croptop thêu tag pra_Da siêu hot, Áo thun cao cấp chất zip xịn mát mịn- HÀNG
                        LOẠI 1
                    </td>
                    <td class="display-flex"><span class="đ">đ</span>198.000</td>
                </tr>
                <tr>
                    <td>3.COMBO 3 áo phông nữ phong cách Hàn quốc.thiết kế cổ tron ct thoáng mát</td>
                    <td class="display-flex"><span class="đ">đ</span>123.800</td>
                </tr>
                <tr>
                    <td>4.Áo Thun Form Rộng Nam Nữ Unisex</td>
                    <td class="display-flex"><span class="đ">đ</span>57.500</td>
                </tr>
                <tr>
                    <td>5.Áo Thun Oversize Local Brand NEVASOME Jealous Đen Xanh Cotton Tay Lỡ Form Rộng Nam Nữ
                        Unisex
                    </td>
                    <td class="display-flex"><span class="đ">đ</span>209.000</td>
                </tr>
                <tr>
                    <td>6.Áo phông cotton khô 3158-thỏ eco in pét 5D (40-70kg)</td>
                    <td class="display-flex"><span class="đ">đ</span>76.000</td>
                </tr>
                <tr>
                    <td>7.Combo ÁO + TẤT + NÓN + KÍNH nhiều màu,áo phông team bulding tay lỡ</td>
                    <td class="display-flex"><span class="đ">đ</span>120.200</td>
                </tr>
                <tr>
                    <td>8.Áo Thun Kiểu Nữ Phối Cổ Nơ Kẻ Thuỷ Thủ Hàng Loại 1 Có Bigsize 45-75kg Phong Cách Ullzzang
                        (50
                        Cents
                        Clothing) #243</td>
                    <td class="display-flex"><span class="đ">đ</span>145.000</td>
                </tr>
                <tr>
                    <td>9.Áo thun nữ tôn dáng chất bozip_PR</td>
                    <td class="display-flex"><span class="đ">đ</span>28.000</td>
                </tr>
                <tr>
                    <td>10.Áo thun Baby Tee PINKSTORE29 in họa tiết chữ đơn giản A5658</td>
                    <td class="display-flex"><span class="đ">đ</span>59.000</td>
                </tr>
                <tr>
                    <td>11.Áo thun zip dài tay thêu chuột mickey dày dặn co dãn 4 chiều phom</td>
                    <td class="display-flex"><span class="đ">đ</span>69.000</td>
                </tr>
                <tr>
                    <td>12.ÁO THUN CỔ TIM FOM RỘNG 45-75kg</td>
                    <td class="display-flex"><span class="đ">đ</span>45.000</td>
                </tr>
                <tr>
                    <td>13.Normallife | TOP 06 Áo thun gân tay dài đơn giản</td>
                    <td class="display-flex"><span class="đ">đ</span>530.000</td>
                </tr>
                <tr>
                    <td>14.Áo Thun Baby Tee 18CESAR Nữ. Áo Phông Tay Ngắn Chất Cotton</td>
                    <td class="display-flex"><span class="đ">đ</span>59.000</td>
                </tr>
                <tr>
                    <td>15.Áo thun nữ ngắn tay vải mát mẻ cho mùa hè màu trắng, be dễ mặc với nhiều trang phục kiểu
                        dáng
                        Hàn Quốc
                        thanh lịch AT14</td>
                    <td class="display-flex"><span class="đ">đ</span>79.000</td>
                </tr>
            </table>
        </div>
        <!-- phần 9 Có Thể Bạn Đang Tìm Kiếm-->
        <div class="part-9">
            <div class="container">
                <div class="title-footer">Có Thể Bạn Đang Tìm Kiếm</div>
                <div class="you-search">
                    <div class="display-flex">
                        <p>áo nỉ nữ</p>
                        <p class="hr-search"></p>
                        <p>đầm dự tiệc cưới</p>
                        <p class="hr-search"></p>
                        <p>đầm váy đỏ</p>
                        <p class="hr-search"></p>
                        <p>áo len nơ</p>
                        <p class="hr-search"></p>
                        <p>áo thu đông nữ dài tay hàn quốc</p>
                        <p class="hr-search"></p>
                        <p>áo khoác jean nữ croptop</p>
                        <p class="hr-search"></p>
                        <p>áo nữ hàn quốc</p>
                        <p class="hr-search"></p>
                        <p>anie</p>
                        <p class="hr-search"></p>
                        <p>thời trang việt thắng</p>
                        <p class="hr-search"></p>
                        <p>rubies</p>
                        <p class="hr-search"></p>
                        <p>áo tắm nữ</p>
                        <p class="hr-search"></p>
                        <p>màu be</p>
                    </div>
                    <div class="display-flex">
                        <p class="hr-search"></p>
                        <p>rage of the sea</p>
                        <p class="hr-search"></p>
                        <p>áo cá sấu</p>
                        <p class="hr-search"></p>
                        <p>bomsister</p>
                    </div>
                </div>
            </div>
            <!-- phần hr -->
            <div class="hr-footer">
                <div class="container">
                    <hr>
                </div>
                <div class="container">
                    <hr>
                </div>
            </div>
        </div>
    </div>

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
<script>
    function swapImage(thumbnail) {
        // Lấy ảnh lớn
        let mainImage = document.getElementById("mainImage");

        // Thay đổi hình ảnh giữa hình lớn và hình nhỏ được nhấn vào
        let tempSrc = mainImage.src;
        mainImage.src = thumbnail.src;
        thumbnail.src = tempSrc;
    }
</script>

</html>