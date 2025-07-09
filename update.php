<?php
require_once 'config/config.php';
require_once 'classes/Database.php';
require_once 'classes/User.php';

$userObj = new User();

if (isset($_POST['update'])) {
    $id      = $_POST['id'];
    $name    = $_POST['name'];
    $email   = $_POST['email'];
    $phone   = $_POST['phone'];
    $address = $_POST['address'];
    $photo   = null;

    if (!empty($_FILES['photo']['name'])) {
        $filename = time() . '_' . $_FILES['photo']['name'];
        $target = 'upload/' . $filename;
        move_uploaded_file($_FILES['photo']['tmp_name'], $target);
        $photo = $target;
    }

    $updated = $userObj->updateUser($id, $name, $email, $phone, $address, $photo);
    
    if ($updated) {
        header("Location: view.php?status=updated");
        exit;
    } else {
        echo "Failed to update user.";
    }
}
