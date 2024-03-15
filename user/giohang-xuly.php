<?php
session_start();
include '../admin/assets/include/pdo.php';
include '../admin/page/product/product.php';
$products = new products();
if (!isset($_SESSION['member'])) {
    $_SESSION['error'] = 'Bạn chưa đăng nhập tài khoản';
    header("Location: index.php?page=login");
    exit;
}

// thêm vào giỏ hàng
if (isset($_POST['them'])) {

    $productId = isset($_POST['productId']) ? $_POST['productId'] : '';
    $quantity = isset($_POST['soluong']) ? intval($_POST['soluong']) : 1;

    $sp = $products->getById($productId);
    $ten = $sp['name'];
    $hinhanh = $sp['image'];
    $gia = $sp['price'];

    if (isset($_COOKIE['cart'])) {
        $cookie_data = $_COOKIE['cart'];
        $cart_data = json_decode($cookie_data, true);
    } else {
        $cart_data = array();
    }

    $id_sp_ds = array_column($cart_data, 'productId');

    // kiểm tra id_sp có tồn tại trong cookie cart chưa
    if (in_array($productId, $id_sp_ds)) {
        foreach ($cart_data as $key => $value) {
            // nếu có thì tăng có lượng sản phẩm
            if ($cart_data[$key]['productId'] == $productId) {
                $cart_data[$key]['soluong'] += $quantity;
            }
        }
    } else {
        // nếu chưa có thì thêm vào cookie cart
        $product_array = array(
            'productId' => $productId,
            'name' => $ten,
            'price' => $gia,
            'soluong' => $quantity,
            'image' => $hinhanh
        );
        $cart_data[] = $product_array;
    }

    // chuyển array thành string để lưu vào cookie cart
    $product_data = json_encode($cart_data);

    // lưu cookie
    setcookie('cart', $product_data, time() + 3600 * 24 * 30 * 12);

    header('location: index.php?page=cart');
}


// sửa số lượng sản phẩm trong giỏ hàng
if (isset($_POST['sua'])) {

    $productId = $_POST['productId'];
    $soluong = $_POST['soluong'];
    $ten = $_POST['name'];
    $hinhanh = $_POST['image'];
    $gia = $_POST['price'];
    if (isset($_COOKIE['cart'])) {
        $cookie_data = $_COOKIE['cart'];
        $cart_data = json_decode($cookie_data, true);
    } else {
        $cart_data = array();
    }

    $id_sp_ds = array_column($cart_data, 'productId');

    if (in_array($productId, $id_sp_ds)) {
        foreach ($cart_data as $key => $value) {
            if ($cart_data[$key]['productId'] == $productId) {
                $cart_data[$key]['soluong'] = $soluong;
            }
        }
    } else {
        $product_array = array(
            'productId' => $productId,
            'name' => $ten,
            'price' => $gia,
            'soluong' => 1,
            'image' => $hinhanh
        );
        $cart_data[] = $product_array;
    }

    $product_data = json_encode($cart_data);
    setcookie('cart', $product_data, time() + 3600 * 24 * 30 * 12);

    header('location: index.php?page=cart');
}

// xóa sản phẩm trong giỏ hàng
if (isset($_POST['xoa'])) {
    if (isset($_COOKIE['cart'])) {
        $cookie_data = $_COOKIE['cart'];
        $cart_data = json_decode($cookie_data, true);
        foreach ($cart_data as $key => $value) {
            if ($cart_data[$key]['productId'] == $_POST['productId']) {
                unset($cart_data[$key]);
                $product_data = json_encode($cart_data);

                setcookie("cart", $product_data, time() + 3600 * 24 * 30 * 12);
            }
        }
    }
    header('location: index.php?page=cart');
}


// xóa cookie giỏ hàng
if (isset($_POST['xoatatca'])) {
    if (isset($_COOKIE['cart'])) {
        setcookie("cart", "", time() - 3600 * 24 * 30 * 12);
    }
    header('location: index.php');
}