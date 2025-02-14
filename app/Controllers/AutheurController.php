<?php

namespace App\Controllers;

use App\Controller\Controllers;
use App\Models\Autheurs;
use App\Http\Request;

class AutheurController extends Controller
{
    private $autheur ;
    public function __construct(){
        $this->autheur = new Autheurs();

    }
    public function index()
    {
        $request = new Request();
        $donnee = [
            "nom"=>"ok",
            "prenom"=>"qsfed"
        ];
        // Action par défaut
        echo 'Hello from AutheurController Controller';
        $this->autheur->create($donnee);
        echo "enregistré avec succè";  
        $autheurs = $this->autheur->read(1); 
        echo $autheurs['nom'];
        echo $autheurs['prenom'];
        echo $autheurs['created_at'];
        echo $autheurs['updated_at'];
        echo $autheurs['id'];

        if ($request->has('name') && $request->has('email')) {
            $name = $request->get('name');
            $email = $request->get('email');
            $this->autheur->create([
                'nom' => $name,
                'prenom' => $email
            ]);
            $this->autheur->delete(3);
            echo "Nom : $name, Email : $email";
        } else {
            echo "❌ Nom ou email manquant !";
        }
    }
}
