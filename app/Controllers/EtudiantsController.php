<?php

namespace App\Controllers;

use App\Models\Etudiants;
use App\Views\View;
use App\Http\Request;
class EtudiantsController extends Controller
{
    private $model, $request;
    public function __construct()
    {
        $this->model = new Etudiants();
        $this->request = new Request();
    }

    public function index()
    {
        // Logique pour afficher la liste
        $items = $this->model->getAll();
        return View::render('etudiants/index', ['items' => $items]);
    }
    public function create()
    {
        // Logique pour afficher le formulaire de création
        return View::render('etudiants/create');
    }
    public function store()
    {
        // Logique pour enregistrer l'élément
        $data = [
            'id' => $this->request->get('id'),
            'name' => $this->request->get('name'),
            'prenoms' => $this->request->get('prenoms'),
            'email' => $this->request->get('email'),
            'password' => $this->request->get('password'),
            'telephone' => $this->request->get('telephone'),
            'adresse' => $this->request->get('adresse'),
            'ville' => $this->request->get('ville'),
            'pays' => $this->request->get('pays'),
            'code_postal' => $this->request->get('code_postal'),
            'sexe' => $this->request->get('sexe'),
            'date_naissance' => $this->request->get('date_naissance'),
            'created_at' => $this->request->get('created_at'),
            'updated_at' => $this->request->get('updated_at'),
        ];
        $this->model->create($data);
        return View::redirect('/etudiants');
    }
    public function edit($id)
    {
        // Logique pour afficher le formulaire de modification
       $item = $this->model->read($id);
       return View::render('etudiants/edit', ['item' => $item]);
    }
    public function update($id)
    {
        // Logique pour mettre à jour l'élément
        $data = [
            'id' => $this->request->get('id'),
            'name' => $this->request->get('name'),
            'prenoms' => $this->request->get('prenoms'),
            'email' => $this->request->get('email'),
            'password' => $this->request->get('password'),
            'telephone' => $this->request->get('telephone'),
            'adresse' => $this->request->get('adresse'),
            'ville' => $this->request->get('ville'),
            'pays' => $this->request->get('pays'),
            'code_postal' => $this->request->get('code_postal'),
            'sexe' => $this->request->get('sexe'),
            'date_naissance' => $this->request->get('date_naissance'),
            'created_at' => $this->request->get('created_at'),
            'updated_at' => $this->request->get('updated_at'),
        ];
        $this->model->update($id, $data);
        return View::redirect('/etudiants');
    }
    public function destroy($id)
    {
        // Logique pour supprimer l'élément
        $this->model->delete($id);
        return View::redirect('/etudiants');
    }
}
