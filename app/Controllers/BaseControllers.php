<?php
    namespace App\Controllers;

    use App\Models\Task;
    use App\Views\View;
    class BaseControllers{

        public function __construct(){

        }

        public function index(){
            return View::render('index', ['nom'=>"Godwill OUSSOU", "age"=>"45"]);
        }
    }
?>