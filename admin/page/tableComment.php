<title>Quản lí bình luận</title>
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
                            Quản lí bình luận
                        </h2>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table" id="table1">
                                <thead>
                                    <tr>
                                        <th>Tên sản phẩm</th>
                                        <th>Số lượng</th>
                                        <th>Thao tác</th>
                                    </tr>
                                </thead>
                                <?php
                                $commets = new comment();
                                $list = $commets->getCount();
                                foreach ($list as $item) { ?>
                                    <tbody>
                                        <tr>
                                            <td><?= $item['name'] ?></td>
                                            <td><?= $item['count'] ?></td>
                                            <td>
                                                <a href=" ?page=tableDetailComment&id=<?= $item['productId']; ?>"
                                                   class="btn btn-primary">Chi tiết</a>
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
<!-- <script src="./assets/static/js/components/dark.js"></script>
    <script src="./assets/extensions/perfect-scrollbar/perfect-scrollbar.min.js"></script>


    <script src="./assets/compiled/js/app.js"></script>

    <script src="./assets/extensions/jquery/jquery.min.js"></script>
    <script src="./assets/extensions/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="./assets/extensions/datatables.net-bs5/js/dataTables.bootstrap5.min.js"></script>
    <script src="./assets/static/js/pages/datatables.js"></script> -->

</body>

</html>