<?php
require_once 'config/config.php';
require_once 'classes/User.php';



$user = new User();
$users = $user->getAllUsers(); // We'll add this method in User class

?>

<!DOCTYPE html>
<html>
<head>
    <title>All Users</title>
    <link rel="stylesheet" href="style.css">
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 30px;
        }
        table, th, td {
            border: 1px solid #ccc;
        }
        th, td {
            padding: 12px;
            text-align: left;
        }
        img {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: 5px;
        }
    </style>
</head>
<body>
<?php if (isset($_GET['status']) && $_GET['status'] == 'deleted'): ?>
    <p style="color: red;">User deleted successfully.</p>
<?php endif; ?>

<div class="container">
    <h2>Registered Users</h2>
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Photo</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Address</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        <?php if ($users): ?>
            <?php foreach ($users as $index => $u): ?>
                <tr>
                    <td><?= $index + 1 ?></td>
                    <td><img src="<?= $u['photo'] ?>" alt="User Photo" /></td>
                    <td><?= htmlspecialchars($u['name']) ?></td>
                    <td><?= htmlspecialchars($u['email']) ?></td>
                    <td><?= htmlspecialchars($u['phone']) ?></td>
                    <td><?= htmlspecialchars($u['address']) ?></td>
                    <td>
                        <!-- Placeholder buttons for future Update/Delete -->
                        <a href="edit.php?id=<?= $u['id'] ?>">Edit</a>
                        <a href="delete.php?id=<?= $u['id'] ?>" onclick="return confirm('Are you sure?')">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr><td colspan="7">No users found.</td></tr>
        <?php endif; ?>
        </tbody>
    </table>
</div>
</body>
</html>