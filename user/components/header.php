<header>
    <!-- header -->
    <div id="header">
        <div class="container">
            <div class="pull-left">
                <!-- Logo -->
                <div class="header-logo">
                    <a class="logo" href="index.php">
                        <img src="contents/img/logo.png" alt="">
                    </a>
                </div>
                <!-- /Logo -->

                <!-- Search -->
                <div class="header-search">
                    <form method="post" enctype="multipart/form-data">
                        <input sty name="timkiem" class="input" style="padding-right: 150px" type="text"
                               placeholder="Tìm kiếm sản phẩm">
                        <button name="search" class="search-btn"><i class="fa fa-search"></i></button>
                    </form>
                </div>
                <?php
                $product = new products();

                if (isset($_POST['search'])) {
                    $searchTerm = $_POST['timkiem']; // Lấy giá trị từ ô tìm kiếm
                    $result = $product->searchProducts($searchTerm);

                    if (!empty($result)) {
                        // Redirect to products.php with the search term
                        header("Location: ?page=products&search=$searchTerm");
                        exit();
                    }
                }
                ?>

                <!-- /Search -->
            </div>
            <div class="pull-right">
                <ul class="header-btns">
                    <!-- Account -->
                    <li class="header-account dropdown default-dropdown" style="width: 180px;">
                        <div class="dropdown-toggle" role="button" data-toggle="dropdown" aria-expanded="true">
                            <div class="header-btns-icon">
                                <i class="fa fa-user-o"></i>
                            </div>
                            <strong class="text-uppercase">Tài khoản </strong>
                            <!-- <i class="fa fa-caret-down"></i> -->
                        </div>
                        <a href="#" class="text-uppercase">
                            <?
                            if (isset($_SESSION['member'])) {
                                $user = new User();
                                $userId = $_SESSION['member'];
                                $userInfo = $user->getuserId($userId);
                                echo $userInfo['fullName'];
                            } else {
                                echo 'Khách hàng';
                            }

                            ?>
                        </a>
                        <!-- / <a href="#" class="text-uppercase">Join</a> -->
                        <ul class="custom-menu">
                            <?
                            if (isset($_SESSION['member'])) { ?>
                                <li><a href="?page=profile"><i class="fa fa-user-o"></i>Tài khoản của tôi</a></li>
                                <li><a href="?page=logout"><i class="fa fa-check"></i> Đăng xuất</a></li>

                            <? } else {
                                ?>
                                <li><a href="?page=login"><i class="fa fa-unlock-alt"></i> Đăng nhập</a></li>
                                <li><a href="?page=register"><i class="fa fa-user-plus"></i>Đăng ký</a></li>
                            <? } ?>
                        </ul>
                    </li>
                    <!-- /Account -->

                    <li class="header-cart">
                        <a href="?page=cart">
                            <div class="header-btns-icon">
                                <i class="fa fa-shopping-cart"></i>
                            </div>
                            <strong class="text-uppercase">Giỏ hàng</strong>

                        </a>
                    </li>

                    <!-- Mobile nav toggle-->
                    <li class="nav-toggle">
                        <button class="nav-toggle-btn main-btn icon-btn"><i class="fa fa-bars"></i></button>
                    </li>
                    <!-- / Mobile nav toggle -->
                </ul>
            </div>
        </div>
        <!-- header -->
    </div>
    <!-- container -->
</header>