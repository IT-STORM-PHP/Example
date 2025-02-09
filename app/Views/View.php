<?php
    namespace App\Views;

    class View {
        public static function render($template, $data = []) {
            extract($data);
            include __DIR__ . "/$template.php"; 
        }

        public static function redirect($url) {
            header("Location: $url");
            exit();
        }
        public static function jsonResponse($data, int $status = 200){
            header("Content-Type: application/json");
            http_response_code($status);
            echo json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
            exit();
        }
    }

    
    
?>