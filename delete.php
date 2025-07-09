<?php
require_once 'config/config.php';
require_once 'classes/Database.php';
require_once 'classes/User.php';

$userObj = new User();

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    if ($userObj->deleteUser($id)) {
        header("Location: view.php?status=deleted");
        exit;
    } else {
        echo "Failed to delete user.";
    }
} else {
    echo "Invalid request.";
}
