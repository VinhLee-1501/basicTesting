<div class="container bootstrap snippets bootdey">
    <div class="row">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="text-center">

                    <?
                    $user = new User();
                    if (isset($_POST['submit'])) {
                        $error = array();
                        if (strlen($_POST['pass1']) < 6) {
                            $error['check'] = "Mật khẩu phải có ít nhất 6 kí tự !";
                        } else {
                            $password = md5($_POST['pass1']);
                            $pass2 = md5($_POST['pass2']);
                            if ($pass2 != $password) {
                                $error['fail'] = "Mật khẩu không khớp, mời nhập lại.";
                            } else {
                                $error['succes'] = "Đổi mật khẩu thành công.";
                                $user->forgetPass($password, $_SESSION['email']);
                                header("Location: ?page=login");
                            }
                        }
                    }
                    ?>
                    <div>
                        <h3 class="text-center">Cập nhật lại mật khẩu</h3>
                    </div>
                    <div class="panel-body">
                        <? if (isset($error['fail'])): ?>
                            <div class="alert alert-danger" role="alert">
                                <?= $error['fail'] ?>
                            </div>
                        <? elseif (isset($error['check'])): ?>
                            <div class="alert alert-danger" role="alert">
                                <?= $error['check'] ?>
                            </div>
                        <? elseif (isset($error['succes'])): ?>
                            <div class="alert alert-success" role="alert">
                                <?= $error['succes'] ?>
                            </div>
                        <? else: ?>
                            <div class="alert alert-primary" role="alert">
                                Mời nhập mật khẩu mới
                            </div>
                        <? endif; ?>
                        <form method="POST">
                            <div class="form-group">
                                <input class="form-control input-lg" placeholder="Nhập mật khẩu" name="pass1"
                                       type="text">
                            </div>
                            <div class="form-group">
                                <input class="form-control input-lg" placeholder="Xác nhận mật khẩu" name="pass2"
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