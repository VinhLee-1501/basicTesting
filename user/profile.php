<?php
if (!isset($_SESSION['member'])) {
    header("location: ?page=login");
    exit();
}
$user = new User();
$userId = $_SESSION['member'];
$userInfo = $user->getuserId($userId);
// Kiểm tra xem người dùng đã đăng nhập hay chưa
if (isset($_SESSION['member'])) {

    if ($userInfo) {
        $fullName = $userInfo['fullName'];
        $email = $userInfo['email'];
        $phone = $userInfo['phone'];
        $address = $userInfo['address'];
        $avatar = $userInfo['avatar'];
    } else {
        // Xử lý nếu không có dữ liệu trả về
        $fullName = "Không có thông tin";
        $email = "Không có thông tin";
        $phone = "Không có thông tin";
        $address = "Không có thông tin";
    }
} else {
    // Xử lý nếu người dùng chưa đăng nhập
    $fullName = "Không có thông tin";
    $email = "Không có thông tin";
    $phone = "Không có thông tin";
    $address = "Không có thông tin";
}

if (isset($_POST['saveInfo'])) {

    $fullName = $_POST['name'];
    $phone = $_POST['phone'];
    print_r($phone);
    $address = $_POST['address'];
    $email = $_POST['email'];

    if (
        $fullName == "" ||
        $phone == "" ||
        $address == "" ||
        $email == ""
    ) {
        $_SESSION['error'] = '*Vui lòng điền đầy đủ thông tin';
        header("location: index.php?page=profile");
        exit;
    }

    $result = $user->updateProfile($userId, $fullName, $phone, $email, $address);
    if ($result) {
        $_SESSION['error'] = 'Sửa mục thất bại!';
        header("location: ?page=profile");
        exit;
    } else {
        $_SESSION['error'] = 'Sửa thành công';
        header("location: ?page=profile");
        exit;
    }

}

if (isset($_POST['chanpass'])) {
    $oldpassword = $_POST['password'];
    $newpassword = $_POST['newpassword'];

    if (empty($oldpassword) || empty($newpassword)) {
        $_SESSION['loi'] = '*Vui lòng điền đầy đủ thông tin';
        header("location: index.php?page=profile");
        exit;
    }

    // Kiểm tra mật khẩu hiện tại có đúng không, nếu không đúng, thông báo lỗi
    $userId = $_SESSION['member'];
    $isPasswordCorrect = $user->checkPassword($userId, $oldpassword);

    if (!$isPasswordCorrect) {
        $_SESSION['loi'] = '*Mật khẩu hiện tại không đúng';
        header("location: index.php?page=profile");
        exit;
    }

    // Tiếp tục với việc cập nhật mật khẩu mới
    $result = $user->updatePassword($userId, $newpassword);

    if ($result) {
        $_SESSION['success'] = 'Thay đổi mật khẩu thành công!';
        header("location: index.php?page=profile");
        exit;
    } else {
        $_SESSION['error'] = 'Thay đổi mật khẩu thất bại!';
        header("location: index.php?page=profile");
        exit;
    }
}
?>

<div class="container rounded bg-white mt-5 mb-5">
    <div class="row">
        <div class="col-md-3 border-right">
            <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                <img class="rounded-circle mt-5" width="150px"
                     src="../image/<?= $avatar ?>" id="avatarPreview">
                <span class="font-weight-bold"><?= $fullName ?></span>
                <span class="text-black-50"><?= $email ?></span>
            </div>
        </div>
        <div class="col-md-5 border-right">
            <form method="post">
                <div class="p-3 py-5">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="text-right">Thông tin</h4>
                    </div>
                    <?php
                    if (isset($_SESSION['error'])) {
                        echo '<p style="color:red">' . $_SESSION['error'] . '</p>';
                        unset($_SESSION['error']);
                    }
                    ?>

                    <div class="row mt-3">
                        <div class="col-md-12">
                            <label class="labels">Tên</label>
                            <input name="name" type="text" class="form-control" placeholder="Họ và tên"
                                   value="<?= $fullName ?>">
                        </div>
                        <div class="col-md-12">
                            <label class="labels">Số điện thoại</label>
                            <input name="phone" type="text" class="form-control" placeholder="Số điện thoại"
                                   value="<?= $phone ?>">
                        </div>
                        <div class="col-md-12">
                            <label class="labels">Địa chỉ</label>
                            <input name="address" type="text" class="form-control" placeholder="Địa chỉ"
                                   value="<?= $address ?>">
                        </div>
                        <div class="col-md-12">
                            <label class="labels">Email</label>
                            <input name="email" type="text" class="form-control" placeholder="Email"
                                   value="<?= $email ?>">
                        </div>
                    </div>

                    <div class="mt-5 text-center">
                        <button class="btn btn-primary profile-button" name="saveInfo" type="submit">Lưu thông tin
                        </button>
                    </div>
                </div>
            </form>

        </div>
        <div class="col-md-4">
            <div class="p-3 py-5">
                <form method="post">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="text-right">Thay đổi mật khẩu</h4>
                    </div>
                    <?php
                    if (isset($_SESSION['loi'])) {
                        echo '<p style="color:red">' . $_SESSION['loi'] . '</p>';
                        unset($_SESSION['loi']);
                    }
                    ?>

                    <div class="row mt-3">
                        <div class="col-md-12">
                            <label class="labels">Mật khẩu</label>
                            <input name="password" type="text" class="form-control" placeholder="Mật khẩu">
                        </div>
                        <div class="col-md-12">
                            <label class="labels">Mật khẩu mới</label>
                            <input name="newpassword" type="text" class="form-control" placeholder="Mật khẩu mới">
                        </div>

                    </div>

                    <div class="mt-5 text-center">
                        <button class="btn btn-primary profile-button" name="chanpass" type="submit">Cập nhật mật khẩu
                        </button>
                    </div>
            </div>
            </form>
        </div>
    </div>


    <div class="col-md-12">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4 class="text-right">Đơn hàng chờ xác nhận</h4>
        </div>
        <div class="table-responsive">

            <table class="table">
                <thead class="thead-light">
                <tr>
                    <th>
                        ID
                    </th>
                    <th scope="col">Tên</th>
                    <th scope="col">Hình</th>
                    <th scope="col">Giá</th>
                    <th scope="col">Số lượng</th>
                    <th scope="col">Tổng tiền</th>
                    <th scope="col">Trạng thái</th>
                    <th scope="col">Thao tác</th>
                </tr>
                </thead>
                <?php
                $user = new User();
                $userId = $_SESSION['member'];
                $orderProfile = $user->getOrder($userId);
                //                var_dump($orderProfile);

                foreach ($orderProfile as $item) {
                    ?>
                    <tbody class="customtable">
                <tr>
                    <th>
                        1
                    </th>
                    <td><?= $item['Người mua'] ?></td>
                    <td class="w-25"><img src="../image/<?= $item['Hình'] ?>" alt="" class="img-thumbnail w-50">
                    </td>
                    <td><?= number_format($item['Giá']) ?></td>
                    <td class="w-25"><?= $item['Số lượng'] ?></td>
                    <td><?= number_format($item['Tổng tiền']) ?></td>
                    <td <?php if ($item['Trạng thái'] == 'Chờ xác nhận') {
                        echo 'class="text-danger"';
                    } elseif ($item['Trạng thái'] == 'Đang vận chuyển') {
                        echo 'class="text-success"';
                    } else {
                        echo 'class="text-warning"';
                    } ?>>
                        <?= $item['Trạng thái'] ?>
                    </td>
                    <td>
                        <?
                        if ($item['Trạng thái'] == 'Đang vận chuyển' || $item['Trạng thái'] == 'Đơn đã hủy') {
                            $disabled = 'disabled';
                        } else {
                            $disabled = '';
                        }
                        ?>
                        <a href="?page=cancellation&id=<?= $item['orderId'] ?>"
                           class="btn btn-info <?= $disabled ?>">Hủy
                            đơn</a>
                    </td>
                </tr>
                    </tbody><?

                }

                ?>

            </table>
        </div>
    </div>
</div>
