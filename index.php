<?php include_once "config/config.php"; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Registration Form</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <h2>User Registration</h2>
    <form action="register.php" method="POST" enctype="multipart/form-data">
        <input type="text" name="name" placeholder="Name" required value="<?= htmlspecialchars($name ?? '') ?>"/>
        <input type="email" name="email" placeholder="Email" required value="<?= htmlspecialchars($email ?? '') ?>"/>
        <input type="text" name="phone" placeholder="Phone" required value="<?= htmlspecialchars($phone ?? '') ?>"/>
        <input type="text" name="address" placeholder="Address" required value="<?= htmlspecialchars($address ?? '') ?>"/>
        <input type="file" name="photo" accept="image/*" required />
        <button type="submit" name="register">Register</button>
    </form>
</div>
</body>
</html>
