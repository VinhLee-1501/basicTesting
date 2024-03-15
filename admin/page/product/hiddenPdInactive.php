<?
$productId = $_GET['idPdI'];
$product = new products();
$changeStatus = $product->hiddenInactive($productId);
header("location: ?page=tableProduct");
?>