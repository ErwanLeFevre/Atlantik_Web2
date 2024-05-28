<?php
namespace App\Controllers;
use App\Models\ModeleClient;
use App\Models\ModeleLiaison;
use App\Models\ModeleSecteur;
use App\Models\ModelePort;
use App\Models\ModeleCategorie;
use App\Models\ModeleEnregistrer;


helper(['url', 'assets', 'form']);

class Visiteur extends BaseController
{
    public function accueil()
    {
           return view('Templates/Header')
            . view('Visiteur/vue_Accueil')
            . view('Templates/Footer');
    }


    public function inscription()
    {
        $donnees['TitreDeLaPage'] = 'Se créer un Compte';

        // Vérifier si le formulaire a été soumis
        if (!$this->request->is('post')) {
            // Le formulaire n'a pas été posté, on retourne le formulaire
            return view('Templates/Header')
                . view('Visiteur/vue_Inscription', $donnees)
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
            'txtMDP' => 'required|string|max_length[30]',
        ];

        // Valider les données du formulaire
        if (!$this->validate($reglesValidation)) {
            // Formulaire non validé, on renvoie le formulaire
            $donnees['TitreDeLaPage'] = "Inscription incorrecte";
            return view('Templates/Header')
                . view('Visiteur/vue_Inscription', $donnees)
                . view('Templates/Footer');
        }

        // Données à insérer dans la base de données
        $donneesAInserer = [
            'nom' => $this->request->getPost('txtNom'),
            'prenom' => $this->request->getPost('txtPrenom'),
            'adresse' => $this->request->getPost('txtAdresse'),
            'codepostal' => $this->request->getPost('txtCP'),
            'ville' => $this->request->getPost('txtVille'),
            'telephonefixe' => $this->request->getPost('txtTelFixe'),
            'telephonemobile' => $this->request->getPost('txtTelMobile'),
            'mel' => $this->request->getPost('txtMel'),
            'motdepasse' => password_hash($this->request->getPost('txtMDP'), PASSWORD_DEFAULT),
        ];

        // Insérer les données dans la base de données
        $modelClient = new ModeleClient();
        $donnees['clientAjoute'] = $modelClient->insert($donneesAInserer);

        // Charger la vue pour afficher le rapport d'inscription
        return view('Templates/Header')
            . view('Visiteur/vue_RapportInscription', $donnees)
            . view('Templates/Footer');
    } // Ajout Client




    public function voirSecteursLiaisons($noLiaison = null)
    {
        $modLiaison = new ModeleLiaison();
        if ($noLiaison === null)
        {   
            $donnees['secteursLiaisons'] = $modLiaison->getAllLiaisonSecteurPort();
            $donnees['TitreDeLaPage'] = 'Toutes les liaisons';
            return view('Templates/Header')
               .view('Visiteur/vue_SecteursLiaisons', $donnees)
               . view('Templates/Footer');
        } else
        {
            $donnees['liaison'] = $modLiaison->find();
            $donnees['tarifsLiaisons'] = $modLiaison->getAllTarifLiaison($noLiaison);
            return view('Templates/Header')
                   .view('Visiteur/vue_TarifsLiaisons', $donnees)
                   . view('Templates/Footer');
        }
        
    }
    
    public function voirHorairesTraversees($noLiaison = null, $dateTraversee = null)
    {
        $modeleSecteur = new ModeleSecteur();
        $modeleLiaison = new ModeleLiaison();
        $modeleCategorie = new ModeleCategorie();
        $modeleEnregistrer = new ModeleEnregistrer();

        $donnees['secteurs'] = $modeleSecteur->findAll();
        $donnees['liaisons'] = [];
        $donnees['tableauTraversees'] = [];
        $donnees['categories'] = $modeleCategorie->getLesCategories();
        $donnees['TitreDeLaPage'] = 'Sélectionner le secteur, la liaison et la date souhaitée';

        if ($this->request->getMethod() == 'post') {
            $noSecteur = $this->request->getPost('noSecteur');
            $noLiaison = $this->request->getPost('noLiaison');
            $dateTraversee = $this->request->getPost('dateTraversee');
            if ($noSecteur) {
                $donnees['liaisons'] = $modeleLiaison->where('nosecteur', $noSecteur)->findAll();
            }
            if ($noLiaison && $dateTraversee) {
                $traversees = $modeleTraversee->getLesTraverseesBateaux($noLiaison, $dateTraversee);
                foreach ($traversees as $traversee) {
                    $ligne = [
                        'noTraversee' => $traversee->notraversee,
                        'heure' => $traversee->heure,
                        'bateau' => $traversee->nom,
                    ];
                    foreach ($donnees['categories'] as $categorie) {
                        $capaciteMaximale = $modeleCategorie->getCapaciteMaximale($traversee->notraversee, $categorie->lettrecategorie);
                        $quantiteEnregistree = $modeleEnregistrer->getQuantiteEnregistree($traversee->notraversee, $categorie->lettrecategorie);
                        $placesDisponibles = $capaciteMaximale[0]->capaMax - $quantiteEnregistree[0]->placeRes;
                        $ligne[$categorie->lettrecategorie] = $placesDisponibles;
                    }
                    $donnees['tableauTraversees'][] = $ligne;
                }
            }
        }
        return view('Templates/Header')
            . view('Visiteur/vue_HorairesTraversees', $donnees)
            . view('Templates/Footer');
    }



    public function connexion()
    {
        helper(['form']);
        $session = session();
        $donnees['TitreDeLaPage'] = 'Se connecter';

        // Vérifier si le formulaire a été soumis
        if (!$this->request->is('post')) {
            return view('Templates/Header', $donnees)
                . view('Visiteur/vue_SeConnecter')
                . view('Templates/Footer');
        }

        // Validation du formulaire
        $reglesValidation = [
            'txtnom' => 'required',
            'txtMotDePasse' => 'required',
        ];

        if (!$this->validate($reglesValidation)) {
            $donnees['TitreDeLaPage'] = "Saisie incorrecte";
            return view('Templates/Header', $donnees)
                . view('Visiteur/vue_SeConnecter', ['validation' => $this->validator])
                . view('Templates/Footer');
        }

        // Recherche du client dans la base de données
        $nom = $this->request->getPost('txtnom');
        $MdP = $this->request->getPost('txtMotDePasse');
        $modClient = new ModeleClient();
        $clientRetourne = $modClient->where('nom', $nom)->first();

        if ($clientRetourne && password_verify($MdP, $clientRetourne->MOTDEPASSE)) {
            // nom et mot de passe corrects : stockage en session
            $session->set('NOM', $clientRetourne->NOM);
            $session->set('profil', 'Client');
            $donnees['NOM'] = $clientRetourne->NOM;
            return view('Templates/Header', $donnees)
                . view('Visiteur/vue_ConnexionReussie', $donnees)
                . view('Templates/Footer');
        } else {
            // nom et/ou mot de passe incorrects
            $donnees['TitreDeLaPage'] = "Identifiant ou/et Mot de passe inconnu(s)";
            return view('Templates/Header', $donnees)
                . view('Visiteur/vue_SeConnecter')
                . view('Templates/Footer');
        }
    } // Fin seconnecter
}

