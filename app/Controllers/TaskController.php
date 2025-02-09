<?php
    namespace App\Controllers;

    use App\Models\Task;
    use App\Views\View;
    class TaskController {
        private $taskModel;
        
        public function __construct() {
            $this->taskModel = new Task();
        }
        public function index() {
            $task = $this->taskModel->getAll();
            //var_dump($task);
            return View::render('tasks/index', ['tasks' => $task]);
        }
        public function show($id){
            $task = $this->taskModel->find($id);
            return View::render('tasks/show', ['task' => $task]);
        }
        public function create(){
            return View::render('tasks/create');
        }
        public function store(){
            $this->taskModel->create($_POST['title'], $_POST['description']);
            return View::redirect('/POO/task-manager/public/tasks');
        }
        public function edit($id){
            $task = $this->taskModel->find($id);
            return View::render('tasks/edit', ['task' => $task]);
        }
        public function update($id){
            $this->taskModel->update($id, $_POST['title'], $_POST['description']);
            return View::redirect('/POO/task-manager/public/tasks');
        }
        public function destroy($id){
            $this->taskModel->delete($id);
            echo 'Task deleted!';
            return View::redirect('/POO/task-manager/public/tasks');
        }
    }
    //var_dump(class_exists('App\Controllers\TaskController'));
    //die();

?>