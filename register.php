<?php

require_once 'config/config.php';
require_once 'classes/User.php';

$errors = [];
$name = $email = $phone = $address = '';

if (isset($_POST['register'])) {
    // 1. Collect data
    $name    = trim($_POST['name']);
    $email   = trim($_POST['email']);
    $phone   = trim($_POST['phone']);
    $address = trim($_POST['address']);
    $photo   = $_FILES['photo'];

    // 2. Validate fields
    if (empty($name) || strlen($name) < 2) {
        $errors[] = "Name is required and must be at least 2 characters.";
    }

    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Valid email is required.";
    }

    if (empty($phone) || !preg_match('/^[0-9]{10,15}$/', $phone)) {
        $errors[] = "Phone is required and must be 10 to 15 digits.";
    }

    if (empty($address)) {
        $errors[] = "Address is required.";
    }

    // 3. Validate photo
    if ($photo['error'] !== UPLOAD_ERR_OK) {
        $errors[] = "Photo is required.";
    } else {
        $allowedTypes = ['image/jpeg', 'image/jpg', 'image/png'];
        if (!in_array($photo['type'], $allowedTypes)) {
            $errors[] = "Photo must be JPG, JPEG, or PNG.";
        }

        if ($photo['size'] > 2 * 1024 * 1024) {
            $errors[] = "Photo must be less than 2MB.";
        }
    }

    // 4. If no errors, proceed to register
    if (empty($errors)) {
        $photoName = $photo['name'];
        $tmpName = $photo['tmp_name'];
        $uploadDir = 'upload/';
        $photoPath = $uploadDir . uniqid() . '_' . basename($photoName);

        if (move_uploaded_file($tmpName, $photoPath)) {
            $user = new User();
            $user->register($name, $email, $phone, $address, $photoPath);
            echo "<p style='color: green;'>✅ Registered successfully!</p>";
        } else {
            echo "<p style='color: red;'>❌ Failed to upload photo.</p>";
        }
    } else {
        // Show validation errors
        foreach ($errors as $error) {
            echo "<p style='color: red;'>❌ $error</p>";
        }
    }
}
