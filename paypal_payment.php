<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Kết nối đến cơ sở dữ liệu (giả sử đã có file cấu hình kết nối DB, ví dụ `sample.php`)
require 'sample.php';
// Bạn có thể truyền thông tin sản phẩm qua POST từ trang sản phẩm, ví dụ như giá, tên sản phẩm
// $name = $_POST['name'];
// $price = $_POST['price']; // Giá sản phẩm (đơn vị tiền tệ của bạn, ví dụ USD)
$name = isset($_POST['name']) ? $_POST['name'] : 'Sản phẩm không xác định';
$price = isset($_POST['price']) ? $_POST['price'] : 0;
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thanh toán PayPal</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <h1>Thanh toán với PayPal</h1>
    <p>Bạn đang mua: <?php echo htmlspecialchars($name); ?></p>
    <p>Giá: <?php echo number_format($price, 3); ?> VND</p>

    <!-- PayPal Button -->
    <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
        <!-- Lệnh POST để gửi đến PayPal -->
        <input type="hidden" name="cmd" value="_xclick">
        <input type="hidden" name="business" value="YOUR_PAYPAL_EMAIL"> <!-- Thay thế với email PayPal của bạn -->
        <input type="hidden" name="item_name" value="<?php echo htmlspecialchars($name); ?>">
        <input type="hidden" name="amount" value="<?php echo number_format($price, 3, '.', ''); ?>">
        <!-- Đảm bảo sử dụng dấu chấm làm dấu phân cách thập phân -->
        <input type="hidden" name="currency_code" value="USD"> <!-- Đổi sang tiền tệ của bạn nếu cần -->
        <input type="hidden" name="return" value="http://yourwebsite.com/success.php">
        <!-- Trang thành công sau thanh toán -->
        <input type="hidden" name="cancel_return" value="http://yourwebsite.com/cancel.php">
        <!-- Trang hủy thanh toán -->

        <!-- Button PayPal -->
        <input type="submit" value="Thanh toán với PayPal" class="paypal-button">
    </form>
</body>

</html>