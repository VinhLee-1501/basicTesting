<div class="container bootstrap snippets bootdey">
    <div class="row">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="text-center">

                    <?
                    if (isset($_POST['submit'])) {
                        $error = array();
                        if ($_POST['text'] != $_SESSION['code']) {
                            $error['fail'] = 'Mã xác nhận không hợp lệ !';
                        } else {
                            header("Location: ?page=resetPass");
                        }
                    }
                    ?>
                    <div>
                        <h3 class="text-center">Mã xác nhận</h3>
                    </div>
                    <div class="panel-body">
                        <? if (isset($error['fail'])): ?>
                            <div class="alert alert-danger" role="alert">
                                <?= $error['fail'] ?>
                            </div>
                        <? else: ?>
                            <div class="alert alert-primary" role="alert">
                                Hãy nhập mã xác nhận !
                            </div>
                        <? endif; ?>
                        <form method="POST">
                            <div class="form-group">
                                <input class="form-control input-lg" placeholder="Mã xác nhận" name="text"
                                       type="text">
                            </div>
                            <button name="submit" class="btn btn-lg btn-primary btn-block" type="submit">Xác nhận
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div