<?php

namespace App\Controllers;

use App\Models\Users;
use App\Views\View;
use App\Http\Request;
class UsersController extends Controller
{
    private $model, $request;
    public function __construct()
    {
        $this->model = new Users();
        $this->request = new Request();
    }

    public function index()
    {
        // Logique pour afficher la liste
        $items = $this->model->getAll();
        return View::render('users/index', ['items' => $items]);
    }
    public function create()
    {
        // Logique pour afficher le formulaire de création
        return View::render('users/create');
    }
    public function store()
    {
        // Logique pour enregistrer l'élément
        $data = [
            'id' => $this->request->get('id'),
            'name' => $this->request->get('name'),
            'email' => $this->request->get('email'),
            'password' => $this->request->get('password'),
            'created_at' => $this->request->get('created_at'),
            'updated_at' => $this->request->get('updated_at'),
        ];
        $this->model->create($data);
        return View::redirect('/users');
    }
    public function edit($id)
    {
        // Logique pour afficher le formulaire de modification
       $item = $this->model->read($id);
       return View::render('users/edit', ['item' => $item]);
    }
    public function update($id)
    {
        // Logique pour mettre à jour l'élément
        $data = [
            'id' => $this->request->get('id'),
            'name' => $this->request->get('name'),
            'email' => $this->request->get('email'),
            'password' => $this->request->get('password'),
            'created_at' => $this->request->get('created_at'),
            'updated_at' => $this->request->get('updated_at'),
        ];
        $this->model->update($id, $data);
        return View::redirect('/users');
    }
    public function destroy($id)
    {
        // Logique pour supprimer l'élément
        $this->model->delete($id);
        return View::redirect('/users');
    }
}
