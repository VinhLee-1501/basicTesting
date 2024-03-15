<?
$categories = new categories();
$categoryId = $_GET['idCate'];
$item = $categories->getById($categoryId);
if (isset($_POST['editCategory'])) {
    $name = $_POST['name'];

    if ($name == "") {
        $_SESSION['error'] = '*Vui lòng điền đầy đủ thông tin';
        header("location: index.php?page=addCategory");
        exit;
    }
    $status = isset($_POST['status']) && $_POST['status'] === 'on' ? 'Active' : 'Inactive';
    $categories = new categories();
    $result = $categories->update($categoryId, $name, $status);
    if ($result) {
        $_SESSION['success'] = 'Sửa mục thành công!';
        header("location: ?page=tableCategory");
        exit;
    } else {
        $_SESSION['error'] = 'Thêm danh mục thất bại!';
        header("location: ?page=updateCategory");
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
                        <h4 class="card-title">Chỉnh sửa loại sản phẩm</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form class="form" method="post">

                                <div class="col-md-12 col-12">
                                    <div class="form-group">
                                        <label for="first-name-column">Tên loại</label>
                                        <input type="text" class="form-control" placeholder="" name="name" value="<?= $item['name'] ?>">
                                    </div>
                                </div>
                                <div class="col-md-12 col-12">
                                    <div class="form-check form-switch">
                                        <input name="status" class="form-check-input" type="checkbox"
                                               id="flexSwitchCheckChecked" checked>
                                        <label class="form-check-label" for="flexSwitchCheckChecked">Active</label>
                                    </div>
                                </div>

                                <div class="col-12 d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary me-1 mb-1" name="editCategory">Submit</button>
                                    <button type="reset" class="btn btn-light-secondary me-1 mb-1">Reset</button>
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