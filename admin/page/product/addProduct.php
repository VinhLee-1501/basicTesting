<?php
$products = new products();

if (isset($_POST['addPD'])) {

    $file = $_FILES['image']['tmp_name'];
    $image = $_FILES['image']['name'];
//    print_r($image);

    $path = "../image/" . $image;

    $name = $_POST['namepd'];
    $price = $_POST['price'];
    $priceSale = $_POST['priceSale'];
    $description = $_POST['mota'];
    $status = isset($_POST['status']) && $_POST['status'] === 'on' ? 'Active' : 'Inactive';
    $categoryId = $_POST['category'];
    $gender = $_POST['gender'];

    if (
        $name == "" ||
        $price == "" ||
        $description == "" ||
        $categoryId == ""
    ) {
        $_SESSION['error'] = '*Vui lòng điền đầy đủ thông tin';
        header("location: index.php?page=addProduct");
        exit;
    }
    if ($price >= $priceSale) {
        $_SESSION['error'] = '*Giá tiền phải nhỏ hơn giá giảm!';
        header("location: index.php?page=addProduct");
        exit;
    }
    // Kiểm tra xem tên sản phẩm đã tồn tại hay chưa
    $existingProduct = $products->getProductByName($name);
    if ($existingProduct) {
        $_SESSION['error'] = '*Sản phẩm đã tồn tại!';
        header("location: index.php?page=addProduct");
        exit;
    } else {
        require_once "Product.php";
        print_r($gender);
        if (move_uploaded_file($file, $path)) {
            $result = $products->add($name, $priceSale, $price, $description, $categoryId, $image, $status, $gender);
//             var_dump($result);
//             exit();
            if ($result) {
                $_SESSION['success'] = 'Thêm danh mục thành công!';
                header("location: ?page=tableProduct");
                exit;
            } else {
                $_SESSION['error'] = 'Thêm danh mục thất bại!';
                header("location: ?page=addProduct");
                exit;
            }
        } else {
            $_SESSION['error'] = 'Lỗi di chuyển file!';
            header("location: ?page=addProduct");
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
                                <h2 class="card-title">Thêm sản phẩm</h2>
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
                                                    <input type="text" class="form-control" placeholder=""
                                                           name="namepd">
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="city-column">Hình ảnh</label>
                                                    <input type="file" class="form-control" placeholder="" name="image">
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="last-name-column">Giá</label>
                                                    <input type="number" class="form-control" placeholder=""
                                                           name="price">
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="last-name-column">Giá giảm</label>
                                                    <input type="number" class="form-control" placeholder=""
                                                           name="priceSale">
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="city-column">Danh mục</label>
                                                    <?php
                                                    $selectDropdown = $products->renderCategorySelect();
                                                    echo $selectDropdown;
                                                    ?>
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-12">
                                                <label for="validationCustom04" class="">Giới tính</label>
                                                <select name="gender" class="form-select" id="validationCustom04"
                                                        required>
                                                    <option value=""></option>
                                                    <option>Nam</option>
                                                    <option>Nữ</option>
                                                </select>
                                            </div>


                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="email-id-column">Mô tả</label>
                                                    <input class="form-control" name="mota"
                                                           placeholder=""></input>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <div class="form-check form-switch">
                                                        <input name="status" class="form-check-input" type="checkbox"
                                                               id="flexSwitchCheckChecked" checked>
                                                        <label class="form-check-label" for="flexSwitchCheckChecked">Active</label>
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="col-12 d-flex justify-content-end">
                                                <button type="submit" class="btn btn-primary me-1 mb-1" name="addPD">
                                                    Thêm
                                                </button>
                                                <button type="reset" class="btn btn-light-secondary me-1 mb-1">Reset
                                                </button>
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