<?php
    use App\Controllers\BaseControllers;
    use App\Controllers\CategoryController;
    use App\Controllers\TaskController;
    use App\Views\View;
    
    $controller = new TaskController();
    $baseContoller = new BaseControllers();
    $categoryController = new CategoryController();
    $config = require __DIR__ .'/../config/config.php';
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        // Accéder à la liste des tâches
        if ($_SERVER['REQUEST_URI'] === '/POO/task-manager/public/tasks') {
            $controller->index();
        }
        // Afficher une tâche spécifique
        elseif (preg_match('#^/POO/task-manager/public/tasks/(\d+)$#', $_SERVER['REQUEST_URI'], $matches)) {
            $controller->show($matches[1]);
        }
        // Créer une nouvelle tâche
        elseif ($_SERVER['REQUEST_URI'] === '/POO/task-manager/public/tasks/create') {
            $controller->create();
        }
        // Modifier une tâche
        elseif (preg_match('#^/POO/task-manager/public/tasks/(\d+)/edit$#', $_SERVER['REQUEST_URI'], $matches)) {
            $controller->edit($matches[1]);
        }
        elseif($_SERVER['REQUEST_URI'] === '/POO/task-manager/public/base'){
            $baseContoller->index();
        }
        elseif($_SERVER['REQUEST_URI'] === '/POO/task-manager/public/category'){
            $categoryController->index();
        } 
        // Si l'URL ne correspond à aucune route
        else {
            echo 'Page non trouvé';

            return View::render("errors/index", [
                "message" => $config['errors_route_message'],
                "url" => $_SERVER['REQUEST_URI'],
                "folder" => __FILE__,
            ]);
        }
    } elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Ajouter une nouvelle tâche
        if ($_SERVER['REQUEST_URI'] === '/POO/task-manager/public/tasks/store') {
            $controller->store();
            
        }
        // Mettre à jour une tâche
        elseif (preg_match('#^/POO/task-manager/public/tasks/(\d+)$#', $_SERVER['REQUEST_URI'], $matches)) {
            $controller->update($matches[1]);
        }
        // Supprimer une tâche
        elseif (preg_match('#^/POO/task-manager/public/tasks/(\d+)/delete$#', $_SERVER['REQUEST_URI'], $matches)) {
            $controller->destroy($matches[1]);
        }
        // Si l'URL ne correspond à aucune route
        else {
            echo 'Page POST not found!';
        }
    }
?>