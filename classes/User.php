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

}
