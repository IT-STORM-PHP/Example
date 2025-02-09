<?php
    namespace App\Models;

    class Category{
        private $db;

        public function __construct(){
            $this->db = Database::getInstance()->getConnection();
        }

        public function getAll(){
            $stmt = $this->db->query("SELECT * FROM categorie ORDER BY created_at ASC");
            return $stmt->fetchAll();
        }
        public function find($id){
            $stmt = $this->db->prepare("SELECT * from categorie WHERE id = ?");
            $stmt->execute([$id]);
            return $stmt->fetch();
        }
    }
?>