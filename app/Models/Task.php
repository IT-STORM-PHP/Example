<?php
    namespace App\Models;
    class Task {
        private $db;
        public function __construct(){
            $this->db = Database::getInstance()->getConnection();
        }
        public function getAll(){
            $stmt = $this->db->query("SELECT * FROM tasks ORDER BY created_at DESC");
            return $stmt->fetchAll();
        }
        public function find($id){
            $stmt = $this->db->prepare("SELECT * from tasks WHERE id = ?");
            $stmt->execute([$id]);
            return $stmt->fetch();
        }
        public function create($title, $description){
            $stmt = $this->db->prepare("INSERT INTO tasks (title, description) VALUES (?, ?)");
            return $stmt->execute([$title, $description]);
        }
        public function update($id, $title, $description, $status){
            $stmt = $this->db->prepare("UPDATE tasks SET title = ?, description = ?, status = ? WHERE id = ?");
            return $stmt->execute([$title, $description, $status, $id]);
        }
        public function delete($id){
            $stmt = $this->db->prepare("DELETE FROM tasks WHERE id = ?");
            return $stmt->execute([$id]);
        }
    }
?>