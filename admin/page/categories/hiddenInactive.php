<?php
$caterogyId = $_GET['idCate'];
$categories = new categories();
$hidden = $categories->hiddenInactive($caterogyId);
header("Location: ?page=tableCategory");