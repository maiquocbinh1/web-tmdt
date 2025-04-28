<?php 
    include './connect.php';
?>
<!doctype html>
<html lang="zxx">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Smobile</title>
    <link rel="icon" href="img/logos.png">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- animate CSS -->
    <link rel="stylesheet" href="css/animate.css">
    <!-- owl carousel CSS -->
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <!-- font awesome CSS -->
    <link rel="stylesheet" href="css/all.css">
    <!-- flaticon CSS -->
    <link rel="stylesheet" href="css/flaticon.css">
    <link rel="stylesheet" href="css/themify-icons.css">
    <!-- font awesome CSS -->
    <link rel="stylesheet" href="css/magnific-popup.css">
    <!-- swiper CSS -->
    <link rel="stylesheet" href="css/slick.css">
    <!-- style CSS -->
    <link rel="stylesheet" href="css/style.css">
</head>

<style>
.header_bg {
    background-color: #ecfdff;
    height: 230px;
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;
}
.padding_top1{
    padding-top:20px;
}
.a1{
    padding-top:130px;
}

.a2{
    height: 230px;

}
</style>


<body>
    <?php include 'header.php';?>

    <!--================Home Banner Area =================-->
    <!-- breadcrumb start-->
    <section class="breadcrumb header_bg">
        <div class="container">
            <div class="row justify-content-center a2">
                <div class="col-lg-8 a2">
                    <div class="a1">
                        <h2 class="form-title">Đăng Nhập</h2>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- breadcrumb end-->

    <!--================login_part Area =================-->
<section class="login_part">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 col-md-6">
                <div class="login_part_text text-center">
                    <div class="login_part_text_iner">
                        <h2>Mới đến cửa hàng của chúng tôi?</h2>
                        <p>Vui lòng đăng ký tài khoản để có trải nghiệm tốt nhất</p>
                        <a href="register.php" class="btn_3">Đăng ký</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6">
                <div class="login_part_form">
                    <div class="login_part_form_iner">
                        <h3>Chào Mừng Trở Lại! <br> Đăng Nhập Ngay</h3>
                        <?php
                            if (isset($_POST["dangnhap"])) {
                                $email = trim($_POST["email"]);
                                $matkhau = trim($_POST["matkhau"]);
                                if (rowCount("SELECT * FROM taikhoan WHERE taikhoan='$email' && matkhau='$matkhau' && status = 0") == 1) {
                                    setcookie('user', $email, time() + (86400 * 30), "/");
                                    header('location:index.php');
                                    exit();
                                } 
                                else if (rowCount("SELECT * FROM taikhoan WHERE taikhoan='$email' && status = 1") == 1) {
                                    $error = 'Tài khoản của bạn đã bị khóa. Vui lòng liên hệ admin.';
                                } else {
                                    $error = 'Tài khoản hoặc mật khẩu không chính xác. Vui lòng kiểm tra lại.';
                                }
                            }
                        ?>
                        <form class="row contact_form" action="" method="post" novalidate="novalidate">
                            <?php if (isset($error)): ?>
                                <p class="text-danger ml-3 mb-3"><?= $error ?></p>
                            <?php endif; ?>
                            <div class="col-md-12 form-group p_star">
                                <input type="text" class="form-control" name="email" required placeholder="Tài khoản (Email)">
                            </div>
                            <div class="col-md-12 form-group p_star">
                                <input type="password" class="form-control" name="matkhau" required placeholder="Mật khẩu">
                            </div>
                            <div class="col-md-12 form-group">
                                <button type="submit" name="dangnhap" class="btn_3">
                                    Đăng Nhập
                                </button>
                                <a class="lost_pass" href="forgot-password.php">Quên mật khẩu?</a> <!-- Cập nhật liên kết -->
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--================login_part end =================-->
</body>