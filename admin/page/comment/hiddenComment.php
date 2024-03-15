<?php
ob_start();
$commentId = $_GET['idCmt'];
$comment = new comment();
$hidden = $comment->hiddenActive($commentId);
$productId = $_GET['id'];
header("Location: ?page=tableDetailComment&id=$productId&idCmt=$commentId");
ob_end_flush();