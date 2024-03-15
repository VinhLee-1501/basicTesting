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
            <h3>Bảng thống kê</h3>
        </div>
        <div class="page-content">
            <section class="row">
                <div class="card">
                    <div class="card-header">
                        <h4>Thống kê loại sản phẩm theo từng sản phẩm</h4>
                    </div>
                    <div class="card-body">
                        <!-- <div id="chart-visitors-profile"></div> -->
                        <canvas id="myChart" style="width:100%;max-width:800px"></canvas>
                        <?
                        $db = new products();
                        $select = $db->thongKe();
                        $xValues = [];
                        $yValues = [];

                        foreach ($select as $row) {
                            $xValues[] = $row['name'];
                            $yValues[] = $row['total'];
                        }
                        ?>
                    </div>
                </div>
            </section>

            <section class="section">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Thống kê đơn hàng theo tháng</h4>
                            </div>
                            <div class="card-body">
                                <canvas id="barChart" style="width:100%; max-width:800px"
                                "></canvas>
                                <?
                                $db = new orders();
                                $select = $db->thongKe();
                                $dataValues = [];
                                $nameValues = [];

                                foreach ($select as $item) {
                                    array_push($dataValues, $item['Số đơn hàng']);
//                      $dataValues[] = $item['Số đơn hàng'];
//                      $nameValues[] = $item['Tháng'];
                                    array_push($nameValues, $item['Tháng']);
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!--Biểu đồ sản phẩm-->
            <script>
                const Colors = [
                    "#293462",
                    "#1CD6CE",
                    "#FEDB39",
                    "#D61C4E",
                    "#1e7145"
                ];

                new Chart("myChart", {
                    type: "pie",
                    data: {
                        labels: <?= json_encode($xValues) ?>,
                        datasets: [{
                            backgroundColor: Colors,
                            data: <?= json_encode($yValues) ?>
                        }]
                    },
                });
            </script>

            <!--Biểu đồ đơn hàng-->
            <script>
                const barColors = [
                    "#0C356A",
                    "#0174BE",
                    "#FFC436",
                    "orange",
                    "brown"
                ];

                new Chart("barChart", {
                    type: "bar",
                    data: {
                        labels: <?= json_encode($nameValues)?>,
                        datasets: [{
                            backgroundColor: barColors,
                            data: <?= json_encode($dataValues)?>
                        }]
                    },
                    options: {
                        legend: {display: false},
                        title: {
                            display: true,
                            text: "Thống kê số đơn hàng kì 4"
                        }
                    }
                });
            </script>
            <?php
            include './assets/include/footer.php';
            ?>
        </div>
    </div>