<div class="section">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">
            <!-- section title -->
            <div class="col-md-12">
                <div class="section-title">
                    <h2 class="title">Danh sách sản phẩm</h2>
                </div>
            </div>
            <!-- section title -->
            <?php
            $product = new products();
            $list = $product->displayProducts();
            echo $list;
            ?>
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</div>