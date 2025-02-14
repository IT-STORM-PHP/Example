<?php

namespace App\Controllers;
use App\Models\Will;
use App\Views\View;
use App\Http\Request;
class WillController extends Controller
{
    private $willModel, $request;
    public function __construct()
    {
        $this->willModel = new Will();
        $this->request = new Request();
    }
    
    public function index()

    {
        $items = $this->willModel->getAll();
        return View::render('Will/index', ['items' => $items]);
    }
    public function create()
    {
        return View::render('Will/create');
        // Logique pour afficher le formulaire de création
    }
    public function store()
    {
        $name = $this->request->get('name');
        $migrations_name = $this->request->get('migrations_name');
        $data = [
            'name' => $name,
            'migrations_name' => $migrations_name
        ];
        $this->willModel->create($data);
        return View::redirect('/Will');
        // Logique pour enregistrer l'élément
    }
    public function edit($id)
    {   $item = $this->willModel->read($id);
        var_dump($item);
        return View::render('Will/edit', ['item' => $item]);
        // Logique pour afficher le formulaire de modification
    }
    public function update($id)
    {   echo $id;
        $name = $this->request->get('name');
        $migrations_name = $this->request->get('migrations_name');
        $data = [
            'name' => $name,
            'migrations_name' => $migrations_name
        ];
        $this->willModel->update($id, $data);
        return View::redirect('/Will');
        // Logique pour mettre à jour l'élément
    }
    public function destroy($id)
    {   echo $id;
        $this->willModel->delete($id);
        return View::redirect('/Will');
        // Logique pour supprimer l'élément
    }
}
