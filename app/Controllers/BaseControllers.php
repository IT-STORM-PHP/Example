<?php
    namespace App\Controllers;

    use App\Models\Task;
    use App\Views\View;
    class BaseControllers{

        public function __construct(){

        }

        public function index(){
            #return View::render('index', ['nom'=>"Godwill OUSSOU", "age"=>"45"]);
            $data = [
                'success' => true,
                'message' => 'Opération réussie',
                'tasks' => [
                    ['id' => 1, 'title' => 'Faire les courses'],
                    ['id' => 2, 'title' => 'Réviser le code PHP']
                ]
            ];
            return View::jsonResponse($data, '200');
        }
    }
?>