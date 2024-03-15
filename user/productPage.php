<?php
$productId = $_GET['id'];
$products = new products();
$idProduct = $products->getById($productId);
$pdCategory = $idProduct['categoryId'];
$user = new User();
$userId = isset($_SESSION['member']) ? $_SESSION['member'] : '';
$listUser = $user->getuserId($userId);


?>
<!DOCTYPE html>
<html lang="en">

<body>


<!-- BREADCRUMB -->
<div id="breadcrumb">
    <div class="container">
        <ul class="breadcrumb">
            <li><a href="index.php">Trang chủ</a></li>
            <li><a href="?page=products">Sản phẩm</a></li>
            <li class="active"><?= $idProduct['name']; ?></li>
        </ul>
    </div>
</div>
<!-- /BREADCRUMB -->

<!-- section -->
<div class="section">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">
            <!--  Product Details -->
            <div class="product product-details clearfix">
                <div class="col-md-6">
                    <div id="product-main-view">
                        <div class="product-view">
                            <img src="../image/<?= $idProduct['image']; ?>" class="h-75" style="" alt="">
                        </div>
                        <!-- <div class="product-view">
                            <img src="contents/img/main-product02.jpg" alt="">
                        </div>
                    </div>
                        <div class="product-view">
                            <img src="contents/img/thumb-product04.jpg" alt="">
                        </div>
                    </div> -->
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="product-body">
                        <div class="product-label">
                            <span>New</span>
                            <!--                            <span class="sale">-20%</span>-->
                        </div>
                        <h2 class="product-name"><?= $idProduct['name']; ?></h2>
                        <h3 class="product-price"><?= number_format($idProduct['price']); ?> VND
                            <del class="product-old-price"><?= number_format($idProduct['priceSale']); ?> VND</del>
                        </h3>
                        <div>
                            <div class="product-rating">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star-o empty"></i>
                            </div>
                            <a href="#">3 Review(s) / Add Review</a>
                        </div>
                        <p><strong>Tình trạng:</strong> Còn hàng</p>
                        <p><strong>Thương hiệu:</strong> E-SHOP</p>
                        <p><?= $idProduct['description'] ?></p>

                        <div class="product-btns">


                            <form action="giohang-xuly.php" method="post">
                                <input type="hidden" name="productId" value="<?= $idProduct['productId'] ?>">
                                <!-- Add a select input for the size -->
                                <div class="qty-input">
                                    <span class="text-uppercase">Số lượng: </span>
                                    <input class="input" type="number" name="soluong" value="1" min="1">
                                </div>
                                <button class="primary-btn add-to-cart" type="submit" name="them">
                                    <i class="fa fa-shopping-cart"></i> Thêm giỏ hàng
                                </button>
                            </form>

                            <!--                            <div class="pull-right">-->
                            <!--                                <button class="main-btn icon-btn"><i class="fa fa-heart"></i></button>-->
                            <!--                                <button class="main-btn icon-btn"><i class="fa fa-exchange"></i></button>-->
                            <!--                                <button class="main-btn icon-btn"><i class="fa fa-share-alt"></i></button>-->
                            <!--                            </div>-->
                        </div>


                    </div>
                </div>
                <div class="col-md-12">
                    <div class="product-tab">
                        <ul class="tab-nav">
                            <li class="active"><a data-toggle="tab" href="#tab1">Thông tin chi tiết</a></li>
                            <!--                                                        <li><a data-toggle="tab" href="#tab1">Details</a></li>-->
                            <li><a data-toggle="tab" href="#tab2">Đánh giá</a></li>
                        </ul>
                        <div class="tab-content">
                            <div id="tab1" class="tab-pane fade in active ">
                                <p><strong>HƯỚNG DẪN BẢO QUẢN</strong><br>
                                    – Giặt máy ở nhiệt độ tối đa 30độC, giặt bên trong túi giặt và vắt ở tốc độ thấp để
                                    sản phẩm được bảo vệ tốt hơn.<br>
                                    – Không sử dụng nước tẩy, thuốc tẩy, bột giặt có chất tẩy mạnh. Không giặt chung sản
                                    phẩm màu trắng với các sản phẩm khác màu tránh tình trạng loang màu.<br>
                                    – Phơi ngay sau khi giặt giúp sản phẩm đỡ nhăn, phơi mặt trái ở bóng râm giúp sản
                                    phẩm lưu giữ màu tốt hơn.<br>
                                    – Là sản phẩm ở nhiệt độ dưới 110độC, ưu tiên dùng bàn là hơi nước.</p>
                            </div>
                            <div id="tab2" class="tab-pane fade in ">

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="product-reviews">
                                            <h4 class="text-uppercase">Các bình luận</h4>
                                            <?php
                                            $productId = $_GET['id'];
                                            $lCmt = $products->listComment($productId);
                                            ?>
                                            <? foreach ($lCmt as $list) {
                                                ?>

                                                <div class="single-review">
                                                    <div class="review-heading">
                                                        <div><a href="#"><i
                                                                        class="fa fa-user-o"></i> <?= $list['fullName'] ?>
                                                            </a></div>
                                                        <div><a href="#"><i
                                                                        class="fa fa-clock-o"></i> <?= $list['date'] ?>
                                                            </a></div>
                                                    </div>
                                                    <div class="review-body">
                                                        <p><?= $list['content'] ?></p>
                                                    </div>
                                                </div>
                                            <? } ?>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <h4 class="text-uppercase">Đánh giá</h4>
                                        <p>Bình luận của bạn sẽ được công khai</p>
                                        <?php
                                        if (isset($_SESSION['error'])) {
                                            echo '<p style="color:red">' . $_SESSION['error'] . '</p>';
                                            unset($_SESSION['error']);
                                        }
                                        ?>
                                        <?php


                                        if (isset($_SESSION['member']) && isset($_POST['submit'])) {
                                            $listUser = $user->getuserId($userId);

                                            $content = $_POST['noidung'];
                                            $productId = $idProduct['productId'];
                                            $userId = $_SESSION['member'];


                                            if ($content == "") {
                                                $_SESSION['error'] = 'Vui Lòng Điền nội dung';
                                                // die();
                                            } else {
                                                $result = $products->addcomment($userId, $content, $productId);
                                                $_SESSION['success'] = 'Bình luận đã được thêm thành công.';
                                                header("Location: ?page=productPage&id=$productId");
                                                exit();
                                            }
                                        }
                                        if (!isset($_SESSION['member'])) {
                                            $_SESSION['error'] = 'Bạn chưa đăng nhập tài khoản';
//                                            header("Location: ?page=productPage&id=$productId");
                                            exit;
                                        }
                                        ?>

                                        <form method="post" class="review-form" enctype="multipart/form-data">
                                            <div class="form-group">
                                                <input name="name" class="input" value="<?= $listUser['fullName'] ?>"
                                                       type="text" placeholder="Họ và tện" readonly/>

                                            </div>
                                            <div class="form-group">
                                                <textarea class="input" placeholder="Nội dung"
                                                          name="noidung"></textarea>
                                            </div>
                                            <button name="submit" class="primary-btn">Ghi</button>
                                        </form>
                                    </div>
                                </div>


                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <!-- /Product Details -->
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</div>
<!-- /section -->

<!-- section -->
<div class="section">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">
            <!-- section title -->
            <div class="col-md-12">
                <div class="section-title">
                    <h2 class="title">Sản phẩm liên quan</h2>
                </div>
            </div>
            <!-- section title -->

            <?
            $list = $products->moreProduct($pdCategory);
            echo $list;
            ?>
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</div>
<!-- /section -->
</body>

</html>
