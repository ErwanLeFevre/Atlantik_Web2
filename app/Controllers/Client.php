<?php
namespace App\Controllers;
use App\Models\ModeleClient;

helper(['url', 'assets', 'form']);

class Client extends BaseController
{
    public function seDeconnecter()
    {
        session()->destroy();
        returnredirect()->to('accueil');
    } // Fin seDeconnecter
    
}

