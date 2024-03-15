<?
$productId = $_GET['id'];
$Product = new products();
$getID = $Product->getById($productId);

if (isset($_POST['editPD'])) {

    $file = $_FILES['image']['tmp_name'];
    $image = $_FILES['image']['name'];
    $path = realpath("../image") . "/" . $image;
//    $path = "../admin/assets/content/img/" . $image;

    $name = $_POST['namepd'];
    $price = $_POST['price'];
    $priceSale = $_POST['priceSale'];
    $description = $_POST['mota'];
    $status = isset($_POST['status']) && $_POST['status'] === 'on' ? 'Active' : 'Inactive';
    $categoryId = $_POST['category'];
    $gender = $_POST['gender'];
//    header("location: ?page=tableProduct");

//    bắt lỗi form
    if (
        $name == "" ||
        $price == "" ||
        $description == "" ||
        $categoryId == ""
    ) {
        $_SESSION['error'] = '*Vui lòng điền đầy đủ thông tin';
        header("location: ?page=updateProduct&id=$productId");
        exit;
    }
    if ($price >= $priceSale) {
        $_SESSION['error'] = '*Giá tiền phải nhỏ hơn giá giảm!';
        header("location: ?page=updateProduct&id=$productId");
        exit;
    }
    // Kiểm tra xem tên sản phẩm đã tồn tại hay chưa
//    $existingProduct = $Product->getProductByName($name);
//    if ($existingProduct) {
//        $_SESSION['error'] = '*Sản phẩm đã tồn tại!';
//        header("location: ?page=updateProduct&id=$productId");
//        exit;
//    }
    if (move_uploaded_file($file, $path)) {
        $result = $Product->update($productId, $name, $priceSale, $price, $description, $categoryId, $image, $status, $gender);

        if ($result) {
            $_SESSION['success'] = 'Thêm danh mục thành công!';
            header("location: ?page=tableProduct");
            exit();
        } else {
            $_SESSION['error'] = 'Thêm danh mục thất bại!';
            header("location: ?page=updateProduct&id='.$productId.'");
            exit();
        }
    } else {
        $_SESSION['error'] = 'Lỗi di chuyển file!';
        // header("location: products.php?act=add");
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
                        <h2 class="card-title">Cập nhật sản phẩm</h2>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <?php
                            if (isset($_SESSION['error'])) {
                                echo '<p style="color:red">' . $_SESSION['error'] . '</p>';
                                unset($_SESSION['error']);
                            }
                            ?>
                            <form class="form" method="post" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="first-name-column">Tên sản phẩm</label>
                                            <input type="text" class="form-control" placeholder="" name="namepd" value="<?php echo $Product->getInfoProduct($productId, 'name'); ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="city-column">Hình ảnh</label>
                                            <input type="file" class="form-control" placeholder="" name="image"
                                                   value="<?php echo $Product->getInfoProduct($productId, 'image'); ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="last-name-column">Giá</label>
                                            <input type="number" class="form-control" placeholder="" name="price" value="<?php echo $Product->getInfoProduct($productId, 'price'); ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="last-name-column">Giá giảm</label>
                                            <input type="number" class="form-control" placeholder="" name="priceSale" value="<?php echo $Product->getInfoProduct($productId, 'priceSale'); ?>">
                                        </div>
                                    </div>


                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="city-column">Danh mục</label>
                                            <!-- <label for="email-productId-column">Loại</label>
                                            <input class="form-control" name="category" placeholder=""> -->
                                            <?php
                                            $selectDropdown = $Product->renderCategorySelect();
                                            echo $selectDropdown;
                                            ?>
                                        </div>

                                    </div>

                                    <div class="col-md-6 col-12">
                                        <label for="validationCustom04" class="">Giới tính</label>
                                        <select name="gender" class="form-select" id="validationCustom04" required>
                                            <?= $select = $Product->getInfoProduct($productId, 'gender'); ?>
                                            <option value="<?= $Product->getInfoProduct($productId, 'gender'); ?>"><?= $Product->getInfoProduct($productId, 'gender'); ?></option>
                                            <option <?= ($select === 'Nam'); ?>>Nam</option>
                                            <option <?= ($select === 'Nữ'); ?>>Nữ</option>
                                        </select>
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="email-id-column">Mô tả</label>
                                            <input class="form-control" name="mota" placeholder="" value="<?php echo $Product->getInfoProduct($productId, 'description'); ?>"></input>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <div class="form-check form-switch">
                                                <input name="status" class="form-check-input" type="checkbox"
                                                       id="flexSwitchCheckChecked" checked>
                                                <label class="form-check-label"
                                                       for="flexSwitchCheckChecked">Active</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12 d-flex justify-content-end">
                                        <button class="btn btn-primary me-1 mb-1" name="editPD">Sửa</button>
                                        <button type="reset" class="btn btn-light-secondary me-1 mb-1">Reset</button>
                                    </div>
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