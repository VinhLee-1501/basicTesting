<?php
$promotionId = $_GET['id'];
$promotion = new promotions();
$hidden = $promotion->hidden($promotionId);
header("Location: ?page=tablePromotion");