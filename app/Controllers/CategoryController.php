<?php
    namespace App\Controllers;
    use App\Models\Category;
    use App\Views\View;
use Stringable;

    class CategoryController{
        private $categoryModel;
        
        public function __construct(){
            $this->categoryModel = new Category();
        }
        public function index(){
            $allCategory = $this->categoryModel->getAll();
            #return View::render("category/index", ['category'=>$allCategory]);
            $data = [
                'status'=>true,
                'category'=>$allCategory,
                'message'=>"Résultats",
            ];
            return View::jsonResponse($data, 200);
        }    
    }
?>