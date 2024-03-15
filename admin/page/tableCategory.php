<script src="./assets/static/js/initTheme.js"></script>
<div id="app">
    <?php
    include './assets/include/nav.php';
    ?>
    <div id="main">
        <header class="mb-3">
            <a href="#" class="burger-btn d-block d-xl-none">
                <i class="bi bi-justify fs-3"></i>
            </a>
        </header>

        <div class="page-heading">

            <div class="page-title">
                <div class="row">
                    <div class="col-12 col-md-6 order-md-1 order-last">
                        <h3>Quản lí</h3>
                    </div>
                    <div class="col-12 col-md-6 order-md-2 order-first">
                        <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item active"><a href="index.html">Quản lí</a></li>
                                <li class="breadcrumb-item " aria-current="page">Loại sản phẩm</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>

            <!-- Minimal jQuery Datatable start -->

            <!-- Minimal jQuery Datatable end -->
            <!-- Basic Tables start -->
            <section class="section">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">
                            Quản lí loại sản phẩm đang hiện
                        </h5>
                        <a href="?page=addCategory" class="btn btn-danger">Thêm</a>

                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table" id="">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Trạng thái</th>
                                        <th style="width: 250px">Thao tác</th>
                                    </tr>
                                </thead>
                                <?
                                $category = new categories();
                                $list = $category->getList();
                                foreach ($list as $item) { ?>
                                    <tbody>
                                        <tr>
                                            <td><?= $item['categoryId'] ?></td>
                                            <td><?= $item['name'] ?></td>
                                            <td style="
                                            <?php
                                            if ($item['status'] === 'Active') {
                                                echo 'font-weight: bold; color: green;';
                                            } ?>">
                                                <?= $item['status']; ?>
                                            </td>
                                            <td>
                                                <a href="?page=updateCategory&idCate=<?= $item['categoryId'] ?>" class="btn btn-info">Sửa</a>
                                                <a href="?page=hiddenCategories&idCate=<?= $item['categoryId'] ?>" class="btn btn-warning">Ẩn</a>
                                            </td>
                                        </tr>
                                    </tbody>
                                <? }
                                ?>
                            </table>


                        </div>
                    </div>
                </div>

            </section>
            <section class="section">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">
                            Quản lí loại sản phẩm đã ẩn
                        </h5>


                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table" id="">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Tên loại</th>
                                    <th>Trạng thái</th>
                                    <th style="width: 250px">Thao tác</th>
                                </tr>
                                </thead>
                                <?
                                $category = new categories();
                                $list = $category->getListInactive();
                                foreach ($list as $item) { ?>
                                    <tbody>
                                    <tr>
                                        <td><?= $item['categoryId'] ?></td>
                                        <td><?= $item['name'] ?></td>
                                        <td style="
                                            <?php
                                        if ($item['status'] === 'Active') {
                                            echo 'font-weight: bold; color: green;';
                                        } ?>">
                                            <?= $item['status']; ?>
                                        </td>
                                        <td>
                                            <a href="?page=updateCategory&idCate=<?= $item['categoryId'] ?>"
                                               class="btn btn-info">Sửa</a>
                                            <a href="?page=hiddenInactive&idCate=<?= $item['categoryId'] ?>"
                                               class="btn btn-warning">Hiện</a>
                                        </td>
                                    </tr>
                                    </tbody>
                                <? }
                                ?>
                            </table>
                            <a href="?page=addCategory" class="btn btn-danger">Thêm</a>

                        </div>
                    </div>
                </div>

            </section>
            <!-- Basic Tables end -->

        </div>

        <?php
                    include './assets/include/footer.php';
                    ?>
    </div>
</div>