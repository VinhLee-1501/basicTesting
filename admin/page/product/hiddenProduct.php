<?
$productId = $_GET['id'];
$product = new products();
$changeStatus = $product->hiddenActive($productId);
header("location: ?page=tableProduct");
