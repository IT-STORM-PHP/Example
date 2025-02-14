<?php

namespace App\Models;

use PDO;
use App\Models\Model;

class Etudiants extends Model
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = \App\Models\Database::getInstance()->getConnection();
    }
    public $id;
    public $name;
    public $prenoms;
    public $email;
    public $password;
    public $telephone;
    public $adresse;
    public $ville;
    public $pays;
    public $code_postal;
    public $sexe;
    public $date_naissance;
    public $created_at;
    public $updated_at;

    public function create($data)
    {
        $sql = "INSERT INTO etudiants (id, name, prenoms, email, password, telephone, adresse, ville, pays, code_postal, sexe, date_naissance, created_at, updated_at) VALUES (:id, :name, :prenoms, :email, :password, :telephone, :adresse, :ville, :pays, :code_postal, :sexe, :date_naissance, :created_at, :updated_at)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $data['id']);
        $stmt->bindParam(':name', $data['name']);
        $stmt->bindParam(':prenoms', $data['prenoms']);
        $stmt->bindParam(':email', $data['email']);
        $stmt->bindParam(':password', $data['password']);
        $stmt->bindParam(':telephone', $data['telephone']);
        $stmt->bindParam(':adresse', $data['adresse']);
        $stmt->bindParam(':ville', $data['ville']);
        $stmt->bindParam(':pays', $data['pays']);
        $stmt->bindParam(':code_postal', $data['code_postal']);
        $stmt->bindParam(':sexe', $data['sexe']);
        $stmt->bindParam(':date_naissance', $data['date_naissance']);
        $stmt->bindParam(':created_at', $data['created_at']);
        $stmt->bindParam(':updated_at', $data['updated_at']);
        return $stmt->execute();
    }

    public function getAll()
    {
        $sql = "SELECT * FROM etudiants";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll();
    }

    public function read($id)
    {
        $sql = "SELECT * FROM etudiants WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update($id, $data)
    {
        $sql = "UPDATE etudiants SET id = :id, name = :name, prenoms = :prenoms, email = :email, password = :password, telephone = :telephone, adresse = :adresse, ville = :ville, pays = :pays, code_postal = :code_postal, sexe = :sexe, date_naissance = :date_naissance, created_at = :created_at, updated_at = :updated_at WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $data['id']);
        $stmt->bindParam(':name', $data['name']);
        $stmt->bindParam(':prenoms', $data['prenoms']);
        $stmt->bindParam(':email', $data['email']);
        $stmt->bindParam(':password', $data['password']);
        $stmt->bindParam(':telephone', $data['telephone']);
        $stmt->bindParam(':adresse', $data['adresse']);
        $stmt->bindParam(':ville', $data['ville']);
        $stmt->bindParam(':pays', $data['pays']);
        $stmt->bindParam(':code_postal', $data['code_postal']);
        $stmt->bindParam(':sexe', $data['sexe']);
        $stmt->bindParam(':date_naissance', $data['date_naissance']);
        $stmt->bindParam(':created_at', $data['created_at']);
        $stmt->bindParam(':updated_at', $data['updated_at']);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    public function delete($id)
    {
        $sql = "DELETE FROM etudiants WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}
