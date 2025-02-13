<?php

namespace App\Models;

use PDO;
use App\Models\Model;

class Tasks extends Model
{
    public $id;
    public $title;
    public $description;
    public $status;
    public $created_at;

    public function create($data)
    {
        $pdo = \App\Models\Database::getInstance()->getConnection();
        $sql = "INSERT INTO tasks (id, title, description, status, created_at) VALUES (:id, :title, :description, :status, :created_at)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $data['id']);
        $stmt->bindParam(':title', $data['title']);
        $stmt->bindParam(':description', $data['description']);
        $stmt->bindParam(':status', $data['status']);
        $stmt->bindParam(':created_at', $data['created_at']);
        return $stmt->execute();
    }

    public static function read($id)
    {
        $pdo = \App\Models\Database::getInstance()->getConnection();
        $sql = "SELECT * FROM tasks WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update($id, $data)
    {
        $pdo = \App\Models\Database::getInstance()->getConnection();
        $sql = "UPDATE tasks SET id = :id, title = :title, description = :description, status = :status, created_at = :created_at WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $data['id']);
        $stmt->bindParam(':title', $data['title']);
        $stmt->bindParam(':description', $data['description']);
        $stmt->bindParam(':status', $data['status']);
        $stmt->bindParam(':created_at', $data['created_at']);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    public function delete($id)
    {
        $pdo = \App\Models\Database::getInstance()->getConnection();
        $sql = "DELETE FROM tasks WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}
