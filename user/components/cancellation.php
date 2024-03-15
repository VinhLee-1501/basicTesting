<?php
$orderId = $_GET['id'];
$order = new orders();
$cance = $order->cancellation($orderId);
header("Location: ?page=profile");