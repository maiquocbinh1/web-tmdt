<?php
    include './connect.php';
?>
<!doctype html>
<html lang="zxx">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Smobile - Đăng Ký</title>
    <link rel="icon" href="img/logos.png">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/animate.css">
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/all.css">
    <link rel="stylesheet" href="css/flaticon.css">
    <link rel="stylesheet" href="css/themify-icons.css">
    <link rel="stylesheet" href="css/magnific-popup.css">
    <link rel="stylesheet" href="css/slick.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
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
        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color: #333;
        }

        /*container chứa icon và input */
        .login_part_form .input-with-icon {
            position: relative;
            border: 1px solid #ddd;
            border-radius: 4px;
            overflow: hidden;
            margin-bottom: 15px;
        }

        /*icon bên trong input */
        .login_part_form .input-with-icon i {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #aaa;
            font-size: 1.2em;
            z-index: 1;
        }

        /*input field */
        .login_part_form .input-with-icon .form-control {
            padding-left: 40px;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            box-sizing: border-box;
            width: 100%;
            height: 45px;
        }

        .login_part_form .input-with-icon .form-control:focus {
            outline: none;
            box-shadow: none;
            border-color: #ee4d2d;
        }

        /*placeholder */
        .login_part_form .input-with-icon .form-control::placeholder {
            color: #aaa;
            font-style: italic;
        }

        /*icon hiện/ẩn mật khẩu */
        .login_part_form .input-with-icon .toggle-password {
            cursor: pointer;
            color: #aaa;
            font-size: 1.2em;
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            z-index: 2;
        }

        /*nút "đăng ký" */
        .login_part_form .btn_3 {
            width: 100%;
            padding: 12px 0;
            border: none;
            border-radius: 4px;
            background-color: #ee4d2d;
            color: white;
            font-size: 18px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            margin-top: 20px;
            margin-bottom: 10px;
        }

        .login_part_form .btn_3:hover {
            background-color: #d43c1e;
        }

        /*container form */
        .login_part_form_iner {
            padding: 30px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .login_part_form_iner h1 {
            color: #333;
            margin-bottom: 20px;
            text-align: center;
        }

        .text-danger {
            color: #dc3545 !important;
        }
        .ml-3 {
            margin-left: 1rem !important;
        }
        .mb-3 {
            margin-bottom: 1rem !important;
        }
        .text-success {
            color: #28a745 !important;
        }
    </style>
</head>

<body>

    <section class="breadcrumb header_bg" style="padding: 60px 0; text-align: center; background-color: #f5fafe;">
        <div class="container">
            <h1 style="font-size: 40px; font-weight: bold; color: #333;">Đăng ký tài khoản mới</h1>
            <p style="font-size: 18px; color: #666;">Vui lòng điền đầy đủ thông tin bên dưới để đăng ký.</p>
        </div>
    </section>

    <section class="login_part ">
        <div class="container">
            <div class="col-lg-6 col-md-6" style="margin:auto;">
                <div class="login_part_form">

                    <div class="login_part_form_iner">
                        <h1>Tạo Tài Khoản</h1>

                        <?php
                            if (isset($_POST["dangky"])) {
                                $ten = $_POST["ten"];
                                $email = $_POST["email"];
                                $sdt = $_POST["sdt"];
                                $matkhau = ($_POST["matkhau"]);
                                $nlmatkhau = ($_POST["nlmatkhau"]);

                                if(empty($ten)){
                                    $error ='Họ tên không được để trống';
                                } elseif(empty($email)){
                                    $error ='Email không được để trống';
                                } elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                                    $error ='Email không đúng định dạng';
                                } elseif(rowCount("SELECT * FROM taikhoan WHERE taikhoan='$email'")>0){
                                    $error ='Tài khoản đã có người sử dụng';
                                } elseif(empty($sdt)){
                                    $error ='Số điện thoại không được để trống';
                                } elseif(!preg_match('/^[0-9]{10}$/', $sdt)){
                                    $error ='Số điện thoại không hợp lệ (10 chữ số)';
                                } elseif(empty($matkhau)){
                                    $error ='Mật khẩu không được để trống';
                                } elseif(strlen($matkhau) < 6){
                                    $error ='Mật khẩu phải có ít nhất 6 ký tự';
                                } elseif ($matkhau!==$nlmatkhau) {
                                    $error ='Nhập lại mật khẩu không chính xác';
                                } else {
                                    // *** SECURITY WARNING: YOU MUST HASH THE PASSWORD BEFORE SAVING ***
                                    $hashedPassword = password_hash($matkhau, PASSWORD_DEFAULT);
                                    selectAll("INSERT INTO taikhoan VALUES (NULL,'$email','$hashedPassword','$ten','','$sdt','','0','0')");
                                    $success='Đăng ký thành công, vui lòng đăng nhập';
                                    header('location:login.php?registration_success=1'); // Pass success message in URL
                                    exit();
                                }
                            }

                            if (isset($error)) {
                                ?><p class="text-danger ml-3 mb-3" style=" text-align: center;"><?= $error ?></p><?php
                            }
                            if (isset($_GET['registration_success'])) {
                                ?><p class="text-success ml-3 mb-3" style=" text-align: center;">Đăng ký thành công, vui lòng đăng nhập</p><?php
                            }
                        ?>

                        <form class="row contact_form" action="" method="post" novalidate="novalidate">

                            <div class="col-md-12 form-group p_star">
                                <label for="ten">Họ Tên</label>
                                <div class="input-with-icon">
                                    <i class="fa fa-user"></i>
                                    <input type="text" name="ten" class="form-control" id="ten" required value="<?= isset($_POST['ten']) ? $_POST['ten'] : '' ?>" placeholder="Nhập họ và tên">
                                </div>
                            </div>
                            <div class="col-md-12 form-group p_star">
                                <label for="email">Email</label>
                                <div class="input-with-icon">
                                    <i class="fa fa-envelope"></i>
                                    <input type="email" class="form-control" id="email" name="email" value="<?= isset($_POST['email']) ? $_POST['email'] : '' ?>" placeholder="Nhập địa chỉ email" required>
                                </div>
                            </div>
                            <div class="col-md-12 form-group p_star">
                                <label for="sdt">Số Điện Thoại</label>
                                <div class="input-with-icon">
                                    <i class="fa fa-phone"></i>
                                    <input type="text" class="form-control" id="sdt" name="sdt" value="<?= isset($_POST['sdt']) ? $_POST['sdt'] : '' ?>" placeholder="Nhập số điện thoại" required>
                                </div>
                            </div>
                            <div class="col-md-12 form-group p_star">
                                <label for="matkhau">Mật Khẩu</label>
                                <div class="input-with-icon">
                                    <i class="fa fa-lock"></i>
                                    <input type="password" class="form-control" id="matkhau" name="matkhau" placeholder="Nhập mật khẩu" required>
                                    <span class="toggle-password" style="cursor: pointer;">
                                        <i class="fa fa-eye"></i>
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-12 form-group p_star">
                                <label for="nlmatkhau">Nhập Lại Mật Khẩu</label>
                                <div class="input-with-icon">
                                    <i class="fa fa-lock"></i>
                                    <input type="password" class="form-control" id="nlmatkhau" name="nlmatkhau" placeholder="Nhập lại mật khẩu" required>
                                    <span class="toggle-password" style="cursor: pointer;">
                                        <i class="fa fa-eye"></i>
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-12 form-group">
                                <button type="submit" name="dangky" value="submit" class="btn_3">
                                    đăng ký
                                </button>
                                <div class="col-md-12 form-group p_star">
                                    <a href="login.php" class="btn_3" style="text-align: center">
                                        Quay về Đăng Nhập
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            </div>
    </section>
    <script src="js/jquery-1.12.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.magnific-popup.js"></script>
    <script src="js/swiper.min.js"></script>
    <script src="js/masonry.pkgd.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/jquery.nice-select.min.js"></script>
    <script src="js/slick.min.js"></script>
    <script src="js/jquery.counterup.min.js"></script>
    <script src="js/waypoints.min.js"></script>
    <script src="js/contact.js"></script>
    <script src="js/jquery.ajaxchimp.min.js"></script>
    <script src="js/jquery.form.js"></script>
    <script src="js/jquery.validate.min.js"></script>
    <script src="js/mail-script.js"></script>
    <script src="js/stellar.js"></script>
    <script src="js/price_rangs.js"></script>
    <script src="js/custom.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const togglePasswords = document.querySelectorAll('.toggle-password');
            const passwordInputs = document.querySelectorAll('input[type="password"]');

            togglePasswords.forEach((toggle, index) => {
                toggle.addEventListener('click', function() {
                    const passwordInput = passwordInputs[index];
                    const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                    passwordInput.setAttribute('type', type);
                    this.querySelector('i').classList.toggle('fa-eye');
                    this.querySelector('i').classList.toggle('fa-eye-slash');
                });
            });
        });
    </script>
</body>

</html>
