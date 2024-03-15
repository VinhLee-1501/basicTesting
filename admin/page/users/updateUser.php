<?
$userId = $_GET['idU'];
$users = new User();
$getIdU = $users->getuserId($userId);
if (isset($_POST['edit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $fullName = $_POST['fullName'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $avatar = $_POST['avatar'];
    $role = $_POST['role'];
    $status = isset($_POST['status']) && $_POST['status'] === 'on' ? 'Active' : 'Inactive';


    if ($username == "" ||
        $password == "" ||
        $fullName == "" ||
        $phone == "" ||
        $email == "" ||
        $address == ""
//        $role == ""
    ) {
        $_SESSION['error'] = '*Vui lòng điền đầy đủ thông tin';
        header("location: ?page=updateUser&idU=$userId");
        exit;
    }
    // Kiểm tra xem $email có chứa ký tự '@' hay không
    if (strpos($email, '@') === false) {
        $_SESSION['error'] = '*Địa chỉ email không hợp lệ';
        header("location: ?page=updateUser&idU=$userId");
        exit;
    }
    if (strlen($phone) !== 10 || substr($phone, 0, 1) !== '0') {
        $_SESSION['error'] = '*Số điện thoại phải có đúng 10 ký tự hoặc bắt đầu bằng số 0';
        header("location: ?page=updateUser&idU=$userId");
        exit;
    }

    $resuly = $users->update($userId, $username, $password, $fullName, $phone, $email, $address, $avatar, $role, $status);
    if (isset($resuly)) {
        $_SESSION['success'] = 'Sửa thành công!';
        header("location:?page=tableUser");
        exit;
    } else {
        $_SESSION['error'] = 'Sua thất bại!';
        header("location:?page=updateUser");
        exit;
    }
}
?>
<div id="app">
    <div id="main">
        <?php
        include './assets/include/nav.php';
        ?>
        <div class="container">
            <section id="multiple-column-form">
                <div class="row match-height">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h2 class="card-title"> Cập nhật tài khoản </h2>
                            </div>
                            <div class="card-content">
                                <div class="card-body">
                                    <?php
                                    if (isset($_SESSION['error'])) {
                                        echo '<p style="color:red">' . $_SESSION['error'] . '</p>';
                                        unset($_SESSION['error']);
                                    }
                                    ?>
                                    <form class="row g-2 needs-validation" novalidate method="post">
                                        <div class="col-md-6 col-12">
                                            <label for="validationCustom01" class="form-label">Tài khoản</label>
                                            <input name="username" type="text" class="form-control"
                                                   id="validationCustom01"
                                                   value="<?= $users->getInfoProfile($userId, 'username'); ?>">
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <label for="validationCustom01" class="form-label">Mật khẩu</label>
                                            <input name="password" type="text" class="form-control"
                                                   id="validationCustom01"
                                                   value="<?= $users->getInfoProfile($userId, 'password'); ?>">
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <label for="validationCustom01" class="form-label">Họ và tên</label>
                                            <input name="fullName" type="text" class="form-control"
                                                   id="validationCustom01"
                                                   value="<?= $users->getInfoProfile($userId, 'fullName'); ?>">
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <label for="validationCustom02" class="form-label">Số điện thoại</label>
                                            <input name="phone" type="number" class="form-control"
                                                   id="validationCustom02"
                                                   value="<?= $users->getInfoProfile($userId, 'phone'); ?>">
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <label for="validationCustomUsername" class="form-label">Email</label>
                                            <div class="input-group has-validation">
                                                <span class="input-group-text" id="inputGroupPrepend">@</span>
                                                <input name="email" type="text" class="form-control"
                                                       id="validationCustomUsername"
                                                       aria-describedby="inputGroupPrepend"
                                                       value="<?= $users->getInfoProfile($userId, 'email'); ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <label for="validationCustom03" class="form-label">Địa chỉ</label>
                                            <input name="address" type="text" class="form-control"
                                                   id="validationCustom03"
                                                   value="<?= $users->getInfoProfile($userId, 'address'); ?>">
                                        </div>

                                        <div class="col-md-6 col-12">
                                            <label for="validationCustom04" class="form-label">Quyền</label>
                                            <select name="role" class="form-select" id="validationCustom04" required>
                                                <?= $select = $users->getInfoProfile($userId, 'role'); ?>
                                                <option value="<?= $users->getInfoProfile($userId, 'role'); ?>"><?= $users->getInfoProfile($userId, 'role'); ?></option>
                                                <option <?= ($select === 'admin'); ?>>admin</option>
                                                <option <?= ($select === 'member'); ?>>member</option>
                                            </select>
                                        </div>

                                        <div class="form-check form-switch">
                                            <input name="status" class="form-check-input" type="checkbox"
                                                   id="flexSwitchCheckChecked" checked>
                                            <label class="form-check-label" for="flexSwitchCheckChecked">Active</label>
                                        </div>

                                        <div class="ol-12 d-flex justify-content-end">
                                            <button name="edit" class="btn btn-primary" type="submit">Sửa</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>
