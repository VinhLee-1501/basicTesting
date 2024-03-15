<?php
ob_start();
$user = new User();

if (isset($_POST['login'])) {

    $username = $_POST['username'];
    $password = $_POST['password'];

    if (
        empty($username) ||
        empty($password)
    ) {
        $_SESSION['error'] = 'Vui lòng điền đầy đủ thông tin';
        echo 'tào lao rồi';
        // header('location: index.php');
        die;
    } else {
        if ($user->checkUser($username, $password)) {
            $userId = $user->userid($username, $password);
            $_SESSION['admin'] = $userId;
            print_r($_SESSION['userId']);
            header('Location: ../admin/');
            exit;
        } else {
            $_SESSION['error'] = 'Sai tài khoản hoặc mật khẩu';
            // header('location: login.php');

        }
    }
}

?>


<div class="col-lg-5 col-12">
    <div id="auth-left" style="height: 670px">
        <!-- <div class="auth-logo">
            <a href="./index.php?page=home"><img src="./assets/compiled/svg/logo.svg" alt="Logo" /></a>
        </div> -->
        <h1 class="pb-2">Đăng nhập</h1>
        <!-- <p class="auth-subtitle mb-5">
            Log in with your data that you entered during registration.
        </p> -->

        <form method="POST">
            <div class="form-group position-relative has-icon-left mb-4">
                <input type="text" name="username" class="form-control form-control-xl" placeholder="Tên đăng nhập"/>
                <div class="form-control-icon">
                    <i class="bi bi-person"></i>
                </div>
            </div>
            <div class="form-group position-relative has-icon-left mb-4">
                <input type="password" name="password" class="form-control form-control-xl" placeholder="Mật khẩu"/>
                <div class="form-control-icon">
                    <i class="bi bi-shield-lock"></i>
                </div>
            </div>
            <!--            <div class="form-check form-check-lg d-flex align-items-end">-->
            <!--                <input class="form-check-input me-2" type="checkbox" value="" id="flexCheckDefault"/>-->
            <!--                <label class="form-check-label text-gray-600" for="flexCheckDefault">-->
            <!--                    Keep me logged in-->
            <!--                </label>-->
            <!--            </div>-->
            <button name="login" class="btn btn-primary btn-block btn-lg shadow-lg mt-5">
                Đăng nhập
            </button>
        </form>
        <div class="text-center mt-5 text-lg fs-4">
            <!--            <p class="text-gray-600">-->
            <!--                Don't have an account?-->
            <!--                <a href="auth-register.html" class="font-bold">Sign up</a>.-->
            <!--            </p>-->
            <p>
                <!--                <a class="font-bold" href="auth-forgot-password.html">Quên mật khẩu?</a>.-->
            </p>
        </div>
    </div>

</div>
<div class="col-lg-7 d-none d-lg-block">
    <div id="auth-right">
        <img src="../../image/bg-admin.jpg" alt="" class="w-100" style="height: 680px">
    </div>
</div>