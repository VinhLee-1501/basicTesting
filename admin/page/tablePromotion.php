<title>Quản lí voucher khuyến mãi</title>
<div id="app">
    <?php
    include './assets/include/nav.php';
    ?>
    <div id="main">
        <div class="page-heading">
            <section class="section">
                <div class="card">
                    <div class="card-header">
                        <h2 class="card-title">
                            Quản lí voucher khuyến mãi
                        </h2>
                        <a href="?page=addPromotion" class="btn btn-danger">Thêm</a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table" id="table1">
                                <thead>
                                <tr>
                                    <th>Mã khuyến mãi</th>
                                    <th>Ngày bắt đầu</th>
                                    <th>Ngày kết thúc</th>
                                    <th>Điều kiện giảm</th>
                                    <th>Giá giảm</th>
                                    <th>Trạng thái</th>
                                    <th>Thao tác</th>
                                </tr>
                                </thead>
                                <?php
                                $promotion = new promotions();
                                $list = $promotion->getStatus();
                                foreach ($list as $item) { ?>
                                    <tbody>
                                    <tr>
                                        <td><?= $item['name'] ?></td>
                                        <td><?= $item['startTime'] ?></td>
                                        <td><?= $item['endTime'] ?></td>
                                        <td><?= $item['conditionPro'] ?></td>
                                        <td><?= $item['discount'] ?></td>
                                        <td>
                                            <?php
                                            if ($item['status'] === 'Active') {
                                            ?>
                                            <i class="text-success">  <?= $item['status']; ?>
                                                <?
                                                } ?>
                                        </td>
                                        <td>
                                            <a href=" ?page=hiddenPromotion&id=<?= $item['promotionId']; ?>"
                                               class="btn btn-warning">Ẩn</a>
                                        </td>
                                    </tr>
                                    </tbody>
                                    <?
                                }
                                ?>
                            </table>
                        </div>
                    </div>
                </div>

            </section>

            <section class="section">
                <div class="card">
                    <div class="card-header">
                        <h2 class="card-title">
                            Quản lí voucher khuyến mãi
                        </h2>
                        <a href="?page=addPromotion" class="btn btn-danger">Thêm</a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table" id="table1">
                                <thead>
                                <tr>
                                    <th>Mã khuyến mãi</th>
                                    <th>Ngày bắt đầu</th>
                                    <th>Ngày kết thúc</th>
                                    <th>Điều kiện giảm</th>
                                    <th>Giá giảm</th>
                                    <th>Trạng thái</th>
                                    <th>Thao tác</th>
                                </tr>
                                </thead>
                                <?php
                                $promotion = new promotions();
                                $list = $promotion->getStatusInactive();
                                foreach ($list as $item) { ?>
                                    <tbody>
                                    <tr>
                                        <td><?= $item['name'] ?></td>
                                        <td><?= $item['startTime'] ?></td>
                                        <td><?= $item['endTime'] ?></td>
                                        <td><?= $item['conditionPro'] ?></td>
                                        <td><?= $item['discount'] ?></td>
                                        <td>
                                            <?php
                                            if ($item['status'] === 'Inactive') {
                                            ?>
                                            <i class="text-infor">  <?= $item['status']; ?>
                                                <?
                                                } ?>
                                        </td>
                                        <td>
                                            <a href=" ?page=hiddenPromotion&id=<?= $item['promotionId']; ?>"
                                               class="btn btn-warning">Ẩn</a>
                                        </td>
                                    </tr>
                                    </tbody>
                                    <?
                                }
                                ?>
                            </table>
                        </div>
                    </div>
                </div>

            </section>

        </div>
        <?php
        include './assets/include/footer.php';
        ?>
    </div>
</div>

</body>

</html>