<?php
namespace App\Controllers;
use App\Models\ModeleClient;
use App\Models\ModeleLiaison;
use App\Models\ModeleReservation;

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
        $session = session();
        $noClient = $session->get('noclient');
        
        if (!$noClient) {
            return redirect()->to('/connexion');
        }

        $quantites = $this->request->getPost('quantite');
        $noTraversee = $this->request->getPost('notraversee');

        $modReservation = new ModeleReservation();
        $modLiaison = new ModeleLiaison();
        $modClient = new ModeleClient();

        // Vérifier la disponibilité des places
        if (!$modReservation->verifierDisponibilite($noTraversee, $quantites)) {
            return redirect()->to('/reservation/echec');
        }

        // Calculer le montant total
        $montantTotal = 0;
        foreach ($quantites as $type => $quantite) {
            if ($quantite > 0) {
                $montantTotal += $quantite * $tarifs[$type];
            }
        }

        // Générer un numéro de réservation unique
        $noReservation = uniqid();

        // Insérer la réservation
        $data = [
            'noreservation' => $noReservation,
            'noclient' => $noClient,
            'notraversee' => $noTraversee,
            'dateheure' => date('Y-m-d H:i:s'),
            'montanttotal' => $montantTotal,
            'paye' => true, // ou false si vous implémentez le paiement
            'modereglement' => 'Carte Bancaire'
        ];

        $modReservation->insert($data);

        // Mettre à jour les disponibilités
        $modReservation->mettreAJourDisponibilite($noTraversee, $quantites);

        // Générer le compte-rendu
        $donnees['reservation'] = [
            'noReservation' => $noReservation,
            'traversee' => $modLiaison->getTraverseeDetails($noTraversee),
            'client' => $modClient->getClientDetails($noClient),
            'quantites' => $quantites,
            'montantTotal' => $montantTotal
        ];

        // Envoyer l'email
        $this->envoyerEmailReservation($donnees['reservation']);

        return view('Templates/Header')
               . view('Client/vue_CompteRendu', $donnees)
               . view('Templates/Footer');
    }


    private function envoyerEmailReservation($reservation)
    {
        $email = \Config\Services::email();
        
        $email->setFrom('no-reply@compagnie-atlantik.com', 'Compagnie Atlantik');
        $email->setTo($reservation['client']->email);

        $email->setSubject('Confirmation de votre réservation');
        
        $message = view('Client/vue_confirmationReservation', $reservation);
        $email->setMessage($message);

        $email->send();
    }
    




    public function Modification()
    {
        helper(['form']);
        $session = session();

        // Vérifie si l'utilisateur est connecté
        

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

    public function historique()
    {
        $session = session();
        $noClient = $session->get('noclient');
        
        if (!$noClient) {
            return redirect()->to('/connexion');
        }

        $modReservation = new ModeleReservation();

        $perPage = 10;
        $currentPage = $this->request->getGet('page') ?? 1;
        $offset = ($currentPage - 1) * $perPage;

        $historiqueReservations = $modReservation->getHistoriqueReservations($noClient, $perPage, $offset);

        $pagination = $modReservation->pager;

        $donnees = [
            'historiqueReservations' => $historiqueReservations,
            'pagination' => $pagination
        ];

        return view('Templates/Header')
               . view('Client/vue_Historique', $donnees)
               . view('Templates/Footer');
    }
}
    


