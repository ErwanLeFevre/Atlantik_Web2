<?php
namespace App\Controllers;
use App\Models\ModeleClient;
use App\Models\ModeleLiaison;

helper(['url', 'assets', 'form']);

class Client extends BaseController
{
    public function deconnexion()
    {
        session()->destroy();
        return redirect()->to('connexion');
    } // Fin seDeconnecter


    public function reserver($noTraversee)
    {
        $session = session();
        $noClient = $session->get('noclient');
        
        if (!$noClient) {
            return redirect()->to('/connexion');
        }

        $modLiaison = new ModeleLiaison();
        $modClient = new ModeleClient();

        $donnees['traversee'] = $modLiaison->getTraverseeDetails($noTraversee);
        $donnees['client'] = $modClient->getClientDetails($noClient);
        $donnees['tarifsLiaisons'] = $modLiaison->getAllTarifLiaison($donnees['traversee']->noliaison);

        return view('Templates/Header')
               . view('Client/vue_Reserver', $donnees)
               . view('Templates/Footer');
    }
    public function confirmerReservation()
    {
        // Traitement de la réservation
    }




    public function Modification()
    {
        helper(['form']);
        $session = session();

        // Vérifie si l'utilisateur est connecté
        if (!$session->has('NOM')) {
            return redirect()->to('connexion');
        }

        $donnees['TitreDeLaPage'] = 'Modifier vos informations';

        // Récupère les informations actuelles de l'utilisateur
        $nom = $session->get('NOM');
        $modClient = new ModeleClient();
        $client = $modClient->where('nom', $nom)->first();

        $donnees['client'] = $client;

        // Vérifie si le formulaire a été soumis
        if (!$this->request->is('post')) {
            return view('Templates/Header', $donnees)
                . view('Client/vue_Modification', $donnees)
                . view('Templates/Footer');
        }

        // Validation du formulaire
        $reglesValidation = [
            'txtNom' => 'required|string|max_length[30]',
            'txtPrenom' => 'required|string|max_length[30]',
            'txtAdresse' => 'required|string|max_length[30]',
            'txtCP' => 'required|string|max_length[30]',
            'txtVille' => 'required|string|max_length[30]',
            'txtTelFixe' => 'required|string|max_length[10]',
            'txtTelMobile' => 'required|string|max_length[10]',
            'txtMel' => 'required|valid_email|max_length[30]',
            'txtMDP' => 'permit_empty|string|max_length[30]',
        ];

        if (!$this->validate($reglesValidation)) {
            $donnees['TitreDeLaPage'] = "Modification incorrecte";
            return view('Templates/Header', $donnees)
                . view('Client/vue_Modification', $donnees)
                . view('Templates/Footer');
        }

        // Données à mettre à jour dans la base de données
        $donneesAMettreAJour = [
            'nom' => $this->request->getPost('txtNom'),
            'prenom' => $this->request->getPost('txtPrenom'),
            'adresse' => $this->request->getPost('txtAdresse'),
            'cp' => $this->request->getPost('txtCP'),
            'ville' => $this->request->getPost('txtVille'),
            'telephonefixe' => $this->request->getPost('txtTelFixe'),
            'telephonemobile' => $this->request->getPost('txtTelMobile'),
            'mel' => $this->request->getPost('txtMel'),
        ];

        if ($this->request->getPost('txtMDP') !== '') {
            $donneesAMettreAJour['motdepasse'] = password_hash($this->request->getPost('txtMDP'), PASSWORD_DEFAULT);
        }

        // Met à jour les informations dans la base de données
        $modClient->update($client->NOCLIENT, $donneesAMettreAJour);

        // Met à jour le nom en session si modifié
        if ($session->get('NOM') !== $this->request->getPost('txtNom')) {
            $session->set('NOM', $this->request->getPost('txtNom'));
        }

        $donnees['TitreDeLaPage'] = 'Modification réussie';
        return view('Templates/Header', $donnees)
            . view('Client/vue_ModificationReussie', $donnees)
            . view('Templates/Footer');
    }
}
    


