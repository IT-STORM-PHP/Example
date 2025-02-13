<?php

namespace App\Models;
use App\Models\Model;
use Pdo;
class Will extends Model
{
    public $id;
    public $name;
    public $created_at;
    public $updated_at;

    public function create($data)
    {
        $pdo = \App\Models\Database::getInstance()->getConnection();
        $sql = "INSERT INTO will (id, name, created_at, updated_at) VALUES (:id, :name, :created_at, :updated_at)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $data['id']);
        $stmt->bindParam(':name', $data['name']);
        $stmt->bindParam(':created_at', $data['created_at']);
        $stmt->bindParam(':updated_at', $data['updated_at']);
        return $stmt->execute();
    }

    public static function read($id)
    {
        $pdo = \App\Models\Database::getInstance()->getConnection();
        $sql = "SELECT * FROM will WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update($id, $data)
    {
        $pdo = \App\Models\Database::getInstance()->getConnection();
        $sql = "UPDATE will SET id = :id, name = :name, created_at = :created_at, updated_at = :updated_at WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $data['id']);
        $stmt->bindParam(':name', $data['name']);
        $stmt->bindParam(':created_at', $data['created_at']);
        $stmt->bindParam(':updated_at', $data['updated_at']);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    public function delete($id)
    {
        $pdo = \App\Models\Database::getInstance()->getConnection();
        $sql = "DELETE FROM will WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}
