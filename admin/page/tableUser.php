<title>Quản lí tài khoản</title>
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
                            Quản lí tài khoản được phép
                        </h2>
                        <!--<a href="?page=a" class="btn btn-danger">Thêm</a>-->
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table" id="table1">
                                <thead>
                                <tr>
                                    <th>Hình ảnh</th>
                                    <th>Tên</th>
                                    <th>Email</th>
                                    <th>Quyền</th>
                                    <th>Trạng thái</th>
                                    <th>Thao tác</th>
                                </tr>
                                </thead>
                                <?php
                                $user = new User();
                                $list = $user->getUser();
                                foreach ($list as $item) { ?>
                                    <tbody>
                                    <tr>
                                        <td>
                                            <?php
                                            if (empty($item['avatar'])) {
                                                echo '<img src="https://mdbcdn.b-cdn.net/img/new/avatars/1.webp" class="rounded-circle" style="width: 50px;" alt="Default Avatar" />';
                                            } else {
                                                echo '<img src="../../image/' . $item['avatar'] . '" class="rounded-circle" style="width: 50px;" alt="Avatar" />';
                                            }
                                            ?>
                                        </td>


                                        <td><?= $item['fullName'] ?></td>
                                        <td><?= $item['email'] ?></td>
                                        <td
                                            <?php
                                            if ($item['role'] === 'admin') {
                                                echo 'class="text-danger"';
                                            } ?>>
                                            <?= $item['role']; ?>
                                        </td>


                                        <td
                                            <?php
                                            if ($item['status'] === 'Active') {
                                                echo 'class="text-success"';
                                            } ?>>
                                            <?= $item['status']; ?>
                                        </td>
                                        <td>
                                            <?
                                            if ($item['role'] == 'admin') {
                                                $disabled = 'disabled';
                                            } else {
                                                $disabled = '';
                                            }

                                            ?>
                                            <a href=" ?page=updateUser&idU=<?= $item['userId']; ?>"
                                               class="btn btn-primary">Sửa</a>
                                            <a href=" ?page=hiddenActiveUser&id=<?= $item['userId']; ?>"
                                               class="btn btn-warning <?= $disabled ?>">Ẩn</a>
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
                            Quản lí tài khoản không được phép
                        </h2>

                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table" id="table1">
                                <thead>
                                <tr>
                                    <th>Hình ảnh</th>
                                    <th>Tên</th>
                                    <th>Email</th>
                                    <th>Quyền</th>
                                    <th>Trạng thái</th>
                                    <th>Thao tác</th>
                                </tr>
                                </thead>
                                <?php
                                $user = new User();
                                $list = $user->getUserInactive();
                                foreach ($list as $item) { ?>
                                    <tbody>
                                    <tr>
                                        <td><img src="../../image/<?= $item['avatar'] ?>" class="rounded-circle"
                                                 style="width: 50px;"
                                                 alt="Avatar">
                                        </td>
                                        <td><?= $item['fullName'] ?></td>
                                        <td><?= $item['email'] ?></td>
                                        <td
                                            <?php
                                            if ($item['role'] === 'admin') {
                                                echo 'class="text-danger"';
                                            } ?>>
                                            <?= $item['role']; ?>
                                        </td>


                                        <td
                                            <?php
                                            if ($item['status'] === 'Active') {
                                                echo 'class="text-success"';
                                            } else {
                                                echo 'class="text-secondary"';
                                            }

                                            ?>>
                                            <?= $item['status']; ?>
                                        </td>
                                        <td>
                                            <a href=" ?page=updateUser&idU=<?= $item['userId']; ?>"
                                               class="btn btn-primary">Sửa</a>
                                            <a href=" ?page=hiddenInactiveUser&id=<?= $item['userId']; ?>"
                                               class="btn btn-warning">Hiện</a>
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
