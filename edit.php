<?php
require_once 'config/config.php';
require_once 'classes/Database.php';
require_once 'classes/User.php';

$userObj = new User();
$id = $_GET['id'] ?? null;

if (!$id) {
    die("Invalid user ID.");
}

$userData = $userObj->getUserById($id);
if (!$userData) {
    die("User not found.");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit User</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h2>Edit User</h2>
        <form action="update.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?= $userData['id'] ?>">

            <label>Name:</label>
            <input type="text" name="name" value="<?= $userData['name'] ?>" required>

            <label>Email:</label>
            <input type="email" name="email" value="<?= $userData['email'] ?>" required>

            <label>Phone:</label>
            <input type="text" name="phone" value="<?= $userData['phone'] ?>" required>

            <label>Address:</label>
            <textarea name="address" required><?= $userData['address'] ?></textarea>

            <label>Current Photo:</label><br>
            <img src="<?= $userData['photo'] ?>" width="100"><br><br>

            <label>Change Photo:</label>
            <input type="file" name="photo" accept="image/*" />
            
            <button type="submit" name="update">Update</button>
        </form>
    </div>
</body>
</html>
