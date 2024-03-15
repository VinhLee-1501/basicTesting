<?php
$userId = $_GET['id'];
$users = new User();
$role = $users->getInfoProfile($userId, 'role');

if ($role === 'admin') {

    header("Location: ?page=tableUser");
    echo '<script>showWaring();</script>';
    exit;
}
$hidden = $users->updatehiddenActive($userId);
header("Location: ?page=tableUser");