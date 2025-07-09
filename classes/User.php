<?php
require_once 'Database.php';

class User extends Database {

    public function register($name, $email, $phone, $address, $photoPath) {
        $sql = "INSERT INTO users (name, email, phone, address, photo) 
                VALUES (:name, :email, :phone, :address, :photo)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            'name' => $name,
            'email' => $email,
            'phone' => $phone,
            'address' => $address,
            'photo' => $photoPath
        ]);
        return true;
    }

    public function getAllUsers() {
        $sql = "SELECT * FROM users ORDER BY id DESC";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll();
    }

    public function getUserById($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function updateUser($id, $name, $email, $phone, $address, $photo = null) {
        if ($photo) {
            $stmt = $this->pdo->prepare("UPDATE users SET name=?, email=?, phone=?, address=?, photo=? WHERE id=?");
            return $stmt->execute([$name, $email, $phone, $address, $photo, $id]);
        } else {
            $stmt = $this->pdo->prepare("UPDATE users SET name=?, email=?, phone=?, address=? WHERE id=?");
            return $stmt->execute([$name, $email, $phone, $address, $id]);
        }
    }

    public function deleteUser($id) {
        // Get user photo path before deleting
        $stmt = $this->pdo->prepare("SELECT photo FROM users WHERE id = ?");
        $stmt->execute([$id]);
        $user = $stmt->fetch();

        // Delete user record
        $stmt = $this->pdo->prepare("DELETE FROM users WHERE id = ?");
        $deleted = $stmt->execute([$id]);

        // Delete uploaded photo if it exists
        if ($deleted && $user && file_exists($user['photo'])) {
            unlink($user['photo']);
        }

        return $deleted;
}


}
