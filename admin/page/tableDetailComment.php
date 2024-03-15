<title>Quản lí chi tiết bình luận</title>
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

            <!-- Basic Tables start -->
            <section class="section">
                <div class="card">
                    <div class="card-header">
                        <h2 class="card-title">
                            Quản lí chi tiết bình luận
                        </h2>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table" id="table1">
                                <thead>
                                <tr>
                                    <th>Tên người dùng</th>
                                    <th>Nội dung</th>
                                    <th>Thời gian</th>
                                    <th>Trạng thái</th>
                                    <th>Thao tác</th>
                                </tr>
                                </thead>
                                <?php
                                $productId = $_GET['id'];
                                $comment = new comment();
                                $list = $comment->getList($productId);
                                foreach ($list as $item) { ?>
                                    <tbody>
                                    <tr>
                                        <td><?= $item['username'] ?></td>
                                        <td><?= $item['content'] ?></td>
                                        <td><?= $item['date'] ?></td>
                                        <td
                                            <?php
                                            if ($item['status'] === 'Active') {
                                                echo 'class="text-success"';
                                            } else {
                                                echo 'class="text-secondary"';

                                            } ?>>
                                            <?= $item['status']; ?>
                                        </td>
                                        <td>
                                            <a href="?page=hiddenComment&idCmt=<?= $item['commentId'] ?>&id=<?= $item['productId'] ?>"
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
            <!-- Basic Tables end -->

        </div>

       <?php
                   include './assets/include/footer.php';
                   ?>
    </div>
</div>