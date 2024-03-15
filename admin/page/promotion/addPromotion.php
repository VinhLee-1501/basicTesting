<?php
$error = [];
$promotion = new promotions();
if (isset($_POST['add'])) {
    $name = $_POST['name'];
    $promotionType = $_POST['promotionType'];
    $discount = $_POST['discount'];
    $conditionPro = $_POST['$conditionPro'];
    $startTime = $_POST['startTime'];
    $endTime = $_POST['endTime'];
    $detail = $_POST['mota'];
    $status = isset($_POST['status']) && $_POST['status'] === 'on' ? 'Active' : 'Inactive';
//    $current_time = new DateTime();
//    print_r($current_time);
//    var_dump($_POST);

    if (strtotime($endTime) < strtotime($startTime)) {
        $error[] = "Thời gian kết thúc phải lớn hơn thời gian bắt đầu.";
    } else {
        $result = $promotion->add($name, $startTime, $endTime, $detail, $promotionType, $discount, $status, $conditionPro);
        if ($result) {
//        var_dump($result);
            $_SESSION['success'] = 'Thêm danh mục thành công!';
            header("location: ?page=tablePromotion");
            exit;
        } else {
            $_SESSION['error'] = 'Thêm danh mục thất bại!';
            header("location: ?page=addPromotion");
            exit;
        }
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
                                <h4 class="card-title">Thêm</h4>
                            </div>
                            <div class="card-content">
                                <div class="card-body">

                                    <form class="row g-3 needs-validation" novalidate method="post">
                                        <div class="col-md-6">
                                            <label for="validationCustom01" class="form-label">Mã khuyến mãi</label>
                                            <input name="name" type="text" class="form-control" id="validationCustom01">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="validationCustom02" class="form-label">Loại khuyến mãi</label>
                                            <input name="promotionType" type="text" class="form-control"
                                                   id="validationCustom02">
                                        </div>

                                        <div class="col-md-6">
                                            <label for="validationCustom03" class="form-label">Giá giảm</label>
                                            <input name="discount" type="number" class="form-control"
                                                   id="validationCustom03"
                                                   required>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="validationCustom03" class="form-label">điều kiện</label>
                                            <input name="$conditionPro" type="text" class="form-control"
                                                   id="validationCustom03"
                                                   required>
                                        </div>

                                        <div class="col-md-6">
                                            <?
                                            if (!empty($error)) {
                                                echo '<div style="color: red;">' . $error . '</div>';
                                            }
                                            ?>
                                            <label for="validationCustom03" class="form-label">Ngày bắt đầu</label>
                                            <input name="startTime" type="date" class="form-control"
                                                   id="validationCustom03"
                                                   required>
                                        </div>
                                        <div class="col-md-6">
                                            <?
                                            if (!empty($error)) {
                                                echo '<div style="color: red;">' . $error . '</div>';
                                            }
                                            ?>
                                            <label for="validationCustom03" class="form-label">Ngày kết thúc</label>
                                            <input name="endTime" type="date" class="form-control"
                                                   id="validationCustom03"
                                                   required>
                                        </div>
                                        <div class="col-md-12 col-12">
                                            <div class="form-group">
                                                <label for="email-id-column">Mô tả</label>
                                                <textarea class="form-control" name="mota" placeholder=""></textarea>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-check form-switch">
                                                <input name="status" class="form-check-input" type="checkbox"
                                                       id="flexSwitchCheckChecked" checked>
                                                <label class="form-check-label"
                                                       for="flexSwitchCheckChecked">Active</label>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <button name="add" class="btn btn-primary" type="submit">Thêm</button>
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