<?php
$userId = $_GET['id'];
$user = new User();
$hidden = $user->updatehiddenInactive($userId);
header("Location: ?page=tableUser");