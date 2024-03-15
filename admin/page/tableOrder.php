<?php
include './assets/include/nav.php';

$orders = new orders();
$listConfirmed = $orders->getOrder();
$listPending = $orders->getOrderConfirm();
?>

<title>Quản lí hóa đơn</title>

<div id="app">
    <div id="main">
        <section class="section">
            <div class="card">
                <div class="card-header">
                    <h2 class="card-title">
                        Hóa đơn chờ xác nhận
                    </h2>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Người mua</th>
                                <th>Tổng Tiền</th>
                                <th>Mã khuyến mãi</th>
                                <th>Ngày mua</th>
                                <th>Địa chỉ</th>
                                <th>Trạng thái</th>
                                <th>Thao tác</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            foreach ($listPending as $item) {
                                $orderTotal = $orders->getOrderTotal($item['orderId']); // Get total price for the order

                                ?>
                                <tr>
                                    <td><?= $item['username'] ?></td>
                                    <td><?= number_format($orderTotal['total']) ?> VND</td>
                                    <td><?= $orderTotal['promotionName'] ?></td>
                                    <td>01/01/2023</td>
                                    <td><?= $item['destination'] ?></td>
                                    <td>
                                        <?php if ($item['status'] === 'Đang vận chuyển') { ?>
                                            <i class="text-success"> Đang vận chuyển </i>
                                        <?php } else { ?>
                                            <i class="text-warning">Chờ xác nhận </i>
                                        <?php } ?>
                                    </td>
                                    <td>
                                        <a href="?page=tableDetailOrder&idOrder=<?= $item['orderId'] ?>"
                                           class="btn btn-primary">Chi tiết</a>
                                        <?php if ($item['status'] != 'Đang vận chuyển') { ?>
                                            <a href="?page=confirmOrder&idComOrder=<?= $item['orderId'] ?>"
                                               class="btn btn-danger">Xác nhận</a>
                                        <?php } ?>
                                    </td>
                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>

        <section class="section">
            <div class="card">
                <div class="card-header">
                    <h2 class="card-title">
                        Hóa đơn đã xác nhận
                    </h2>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Người mua</th>
                                <th>Tổng tiền</th>
                                <th>Mã khuyến mãi</th>
                                <th>Ngày mua</th>
                                <th>Địa chỉ</th>
                                <th>Trạng thái</th>
                                <th>Thao tác</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($listConfirmed as $item) {
                                $orderTotal = $orders->getOrderTotal($item['orderId']); // Get total price for the order
                                ?>
                                <tr>
                                    <td><?= $item['username'] ?></td>
                                    <td><?= number_format($orderTotal['total']) ?> VND</td>
                                    <td><?= $orderTotal['promotionName'] ?></td>
                                    <td>01/01/2023</td>
                                    <td><?= $item['destination'] ?></td>
                                    <td>
                                        <?php if ($item['status'] === 'Đang vận chuyển') { ?>
                                            <i class="text-success"> Đang vận chuyển </i>
                                        <?php } else { ?>
                                            <i class="text-warning">Chờ xác nhận </i>
                                        <?php } ?>
                                    </td>
                                    <td>
                                        <a href="?page=tableDetailOrder&idOrder=<?= $item['orderId'] ?>"
                                           class="btn btn-primary">Chi tiết</a>
                                        <?php if ($item['status'] != 'Đang vận chuyển') { ?>
                                            <a href="?page=confirmOrder&idComOrder=<?= $item['orderId'] ?>"
                                               class="btn btn-danger">Xác nhận</a>
                                        <?php } ?>
                                    </td>
                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
        <?php include './assets/include/footer.php'; ?>
    </div>
</div>
