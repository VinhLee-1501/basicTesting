<div class="container bootstrap snippets bootdey">
    <div class="row">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="text-center">

                    <?
                    ob_start();
                    $user = new User();
                    $mail = new Mailer();
                    if (isset($_POST['submit'])) {
                        $error = array();
                        $email = $_POST['email'];
                        if ($email === '') {
                            $error['email'] = 'Không được để trống';
//                            var_dump($error);
                        }
                        if (empty($error)) {
                            $result = $user->getUserEmail($email);
                            if ($result) {
                                $code = substr(rand(0, 999999), 0, 6);
                                $title = "Quên mật khẩu";
                                $content = "Mã xác nhận của bạn là: <span class='text-success'>" . $code . "</span>";

                                $mail->sendEmail($title, $content, $email);
                                $_SESSION['email'] = $email;
                                $_SESSION['code'] = $code;
                                header("Location: ?page=codePass");
                            }
                        }
                    }
                    ?>
                    <div>
                        <h3 class="text-center">Quên mật khẩu</h3>
                    </div>
                    <div class="panel-body">

                        <form method="POST">
                            <div class="form-group">
                                <input class="form-control input-lg" placeholder="Email" name="email"
                                       type="text">
                            </div>
                            <button name="submit" class="btn btn-lg btn-primary btn-block" type="submit">Gửi</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div