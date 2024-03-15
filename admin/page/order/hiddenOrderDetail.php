<?php
$orderDetailId = $_GET['idHidden'];
$orderdeatil = new orders();
$restart = $orderdeatil->delete($orderDetailId);
header("Location: ?page=tableDetailOrder");