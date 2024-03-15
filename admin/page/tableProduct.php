<title>Quản lí sản phẩm</title>
<div id="app">
    <?php
    include './assets/include/nav.php';
    ?>
    <div id="main">
        <div class="page-heading">
            <section class="section">
                <div class="card">
                    <div class="card-header">

                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table" id="">
                                <h2 class="card-title">
                                    Sản phẩm cho phép
                                </h2>
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Tên</th>
                                    <th>Hình</th>
                                    <th>Giá</th>
                                    <th>Trạng thái</th>
                                    <th style="width: 250px">Thao tác</th>
                                </tr>
                                </thead>

                                <!--List product Active start-->
                                <?php
                                $products = new products();
                                $list = $products->getStatusActive();
                                foreach ($list as $item) { ?>
                                    <tbody>
                                    <tr>
                                        <td><?= $item['productId'] ?></td>
                                        <td><?= $item['name'] ?></td>
                                        <td class="w-25">
                                            <img src="../../image/<?= $item['image'] ?>"
                                                 class="img-thumbnail w-75" alt="...">
                                        </td>
                                        <td><?= number_format($item['price']) ?></td>
                                        <td
                                            <?php
                                            if ($item['status'] === 'Active') {
                                                echo 'class="text-success"';
                                            } ?>>
                                            <?= $item['status']; ?>
                                        </td>
                                        <td>
                                            <a href="?page=updateProduct&id=<?= $item['productId'] ?>"
                                               class="btn btn-primary">Sửa</a>
                                            <button class="btn btn-warning" onclick="myFuntion()" name="hiddenPd"><a
                                                        href="?page=hiddenProduct&id=<?= $item['productId'] ?>"
                                                        style="color: black;">Ẩn</a></button>
                                        </td>
                                    </tr>
                                    </tbody>
                                    <?php
                                }
                                ?>

                            </table>
                            <a href="?page=addProduct" class="btn btn-danger">Thêm</a>
                            <!--List product Active end-->
                        </div>
                    </div>


                </div>

            </section>

            <section class="section">
                <div class="card">
                    <div class="card-header">
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table" id="">
                                <h3 class="card-title">
                                    Sản phẩm không được phép
                                </h3>
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Tên</th>
                                    <th>Hình</th>
                                    <th>Giá</th>
                                    <th>Trạng thái</th>
                                    <th style="width: 250px">Thao tác</th>
                                </tr>
                                </thead>
                                <!--List product Inactive start-->
                                <?php
                                $products = new products();
                                $list = $products->getStatusInactive();
                                foreach ($list as $item) { ?>
                                    <tbody>
                                    <tr>
                                        <td><?= $item['productId'] ?></td>
                                        <td><?= $item['name'] ?></td>
                                        <td class="w-25">
                                            <img src="../../image/<?= $item['image'] ?>"
                                                 class="img-thumbnail w-75" alt="...">
                                        </td>
                                        <td><?= number_format($item['price']) ?></td>
                                        <td class="text-secondary">
                                            <?= $item['status']; ?>
                                        </td>
                                        <td>
                                            <a href="?page=updateProduct&id=<?= $item['productId'] ?>"
                                               class="btn btn-primary">Sửa</a>
                                            <button class="btn btn-warning" onclick="myFuntion()" name="hiddenPd"><a
                                                        href="?page=hiddenPdInactive&idPdI=<?= $item['productId'] ?>"
                                                        style="color: black;">Hiện</a></button>
                                        </td>
                                    </tr>
                                    </tbody>
                                    <?php
                                }
                                ?>
                            </table>
                            <!--List product Inactive end-->
                            <a href="?page=addProduct" class="btn btn-danger">Thêm</a>
                        </div>
                    </div>

                </div>

            </section>
            <!-- Tables product end -->

        </div>

        <?php
        include './assets/include/footer.php';
        ?>
    </div>
</div>