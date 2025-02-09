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
    }

    
    
?>