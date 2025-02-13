<?php

namespace App\Models;

use PDO;
use App\Models\Model;

class Autheurs extends Model
{
    public $id;
    public $nom;
    public $prenom;
    public $created_at;
    public $updated_at;

    public function create($data)
    {
        $pdo = \App\Models\Database::getInstance()->getConnection();
        $sql = "INSERT INTO autheurs (id, nom, prenom, created_at, updated_at) VALUES (:id, :nom, :prenom, :created_at, :updated_at)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $data['id']);
        $stmt->bindParam(':nom', $data['nom']);
        $stmt->bindParam(':prenom', $data['prenom']);
        $stmt->bindParam(':created_at', $data['created_at']);
        $stmt->bindParam(':updated_at', $data['updated_at']);
        return $stmt->execute();
    }

    public static function read($id)
    {
        $pdo = \App\Models\Database::getInstance()->getConnection();
        $sql = "SELECT * FROM autheurs WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update($id, $data)
    {
        $pdo = \App\Models\Database::getInstance()->getConnection();
        $sql = "UPDATE autheurs SET id = :id, nom = :nom, prenom = :prenom, created_at = :created_at, updated_at = :updated_at WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $data['id']);
        $stmt->bindParam(':nom', $data['nom']);
        $stmt->bindParam(':prenom', $data['prenom']);
        $stmt->bindParam(':created_at', $data['created_at']);
        $stmt->bindParam(':updated_at', $data['updated_at']);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    public function delete($id)
    {
        $pdo = \App\Models\Database::getInstance()->getConnection();
        $sql = "DELETE FROM autheurs WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}
