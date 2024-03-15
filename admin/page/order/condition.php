<?
$orderId = $_GET['idComOrder'];
$order = new orders();
$conditionOrder = $order->conditionOrder($orderId);
header("Location: ?page=tableOrder");
