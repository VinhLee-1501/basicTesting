<?php
if (isset($_SESSION['member'])) {
    header('location: index.php');
}
$user = new User();

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = md5($_POST['password']);

    if (empty($username) || empty($password)) {
        $_SESSION['error'] = 'Vui lòng điền đầy đủ thông tin';
    } else {
        if ($user->CheckClient($username, $password)) {
            if ($user->checkStatusClient($username)) {
                $userId = $user->userid($username, $password);
                $_SESSION['member'] = $userId;

                header('Location: index.php?userId=' . $userId);
                exit;
            } else {
                $_SESSION['fail'] = "Tài khoản đã bị khóa";
            }
        } else {
            $_SESSION['error'] = 'Sai tài khoản hoặc mật khẩu';
        }
    }
}
?>

<section class="">
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col col-xl-10">
                <div class="card" style="border-radius: 1rem;">
                    <div class="row g-0">
                        <div class="col-md-6 col-lg-5 d-none d-md-block">
                            <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/img1.webp"
                                 alt="login form" class="img-fluid" style="border-radius: 1rem 0 0 1rem;"/>
                        </div>
                        <div class="col-md-6 col-lg-7 d-flex align-items-center">
                            <div class="card-body p-4 p-lg-5 text-black">
                                <form method="POST">
                                    <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Đăng nhập vào tài
                                        khoản</h5>
                                    <?php
                                    if (isset($_SESSION['error'])) {
                                        echo '<p style="color:red">' . $_SESSION['error'] . '</p>';
                                        unset($_SESSION['error']);
                                    }
                                    if (isset($_SESSION['fail'])) {
                                        echo '<p style="color:red">' . $_SESSION['fail'] . '</p>';
                                        unset($_SESSION['fail']);
                                    }
                                    ?>
                                    <div class="form-outline mb-4">
                                        <label class="form-label" for="form2Example17">Tài khoản</label>
                                        <input name="username" type="text" id="form2Example17"
                                               class="form-control form-control-lg"
                                               placeholder="Tên đăng nhập"/>
                                    </div>
                                    <div class="form-outline mb-4">
                                        <label class="form-label" for="form2Example27">Mật khẩu</label>
                                        <input name="password" type="password" id="form2Example27"
                                               placeholder="Mật khẩu"
                                               class="form-control form-control-lg"/>
                                    </div>
                                    <div class="pt-1 mb-4">
                                        <button name="login" class="btn btn-primary btn-block btn-lg shadow-lg mt-5">Log
                                            in
                                        </button>
                                    </div>
                                    <a class="small text-muted" href="?page=forgotPass">Quên mật khẩu</a>
                                    <p class="mb-5 pb-lg-2" style="color: #393f81;">Bạn chưa có tài khoản? <a
                                                href="?page=register"
                                                style="color: #393f81;">Đăng ký tại đây</a></p>

                                    <!--Login with google-->
                                    <a href="" class="btn btn-primary btn-lg btn-block"
                                       style="background-color: #3b5998">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                             fill="currentColor" class="bi bi-google" viewBox="0 0 16 16">
                                            <path d="M15.545 6.558a9.42 9.42 0 0 1 .139 1.626c0 2.434-.87 4.492-2.384 5.885h.002C11.978 15.292 10.158 16 8 16A8 8 0 1 1 8 0a7.689 7.689 0 0 1 5.352 2.082l-2.284 2.284A4.347 4.347 0 0 0 8 3.166c-2.087 0-3.86 1.408-4.492 3.304a4.792 4.792 0 0 0 0 3.063h.003c.635 1.893 2.405 3.301 4.492 3.301 1.078 0 2.004-.276 2.722-.764h-.003a3.702 3.702 0 0 0 1.599-2.431H8v-3.08h7.545z"/>
                                        </svg>
                                    </a>
                                </form>

                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>
