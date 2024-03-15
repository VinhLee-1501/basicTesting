<?
$categoryId = $_GET['idCate'];
$categories = new categories();
$restart = $categories->hiddenCate($categoryId);
header("location: ?page=tableCategory");
