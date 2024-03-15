<title>Quản lí chi tiết hóa đơn</title>
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
                            Quản lí chi tiết hóa đơn
                        </h2>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>Tên sản phẩm</th>
                                    <th>Giá</th>
                                    <th>Số lượng</th>
                                    <th style="text-align: right; padding: 0;">Tổng giá</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $orderId = $_GET['idOrder'];
                                $order = new orders();
                                $product = new products();
                                $list = $order->getOrderDetail($orderId);
                                $grandTotal = 0; // Initialize grand total

                                foreach ($list as $item) {
                                    $subtotal = $item['amount'] * $item['price'];
                                    $grandTotal += $subtotal;
                                    ?>
                                    <tr>
                                        <td><?= $item['name'] ?></td>
                                        <td><?= $item['price'] ?></td>
                                        <td><?= $item['amount'] ?></td>
                                        <td style="text-align: right; padding: 0;"><?= number_format($subtotal) ?>VND
                                        </td>
                                    </tr>
                                <?php } ?>
                                </tbody>
                            </table>
                            <div>
                                <strong>Tổng cộng:</strong> <?= number_format($grandTotal) ?> VND
                            </div>
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
