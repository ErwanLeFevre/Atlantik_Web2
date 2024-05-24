<?php
namespace App\Controllers;
use App\Models\ModeleClient;
use App\Models\ModeleLiaison;
use App\Models\ModeleSecteur;
use App\Models\ModelePort;


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
        $data['TitreDeLaPage'] = 'Se créer un Compte';
    
        // Vérifier si le formulaire a été soumis
        if (!$this->request->is('post')) {
            /* Le formulaire n'a pas été posté, on retourne le formulaire */
            return view('Templates/Header')
                . view('Visiteur/vue_Inscription', $data)
                . view('Templates/Footer');
        }
    
        /* Validation du formulaire */
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
            /* Formulaire non validé, on renvoie le formulaire */
            $data['TitreDeLaPage'] = "Inscription incorrecte";
            return view('Templates/Header')
                . view('Visiteur/vue_Inscription', $data)
                . view('Templates/Footer');
        }
    
        // Données à insérer dans la base de données
        $donneesAInserer = [
            'nom' => $this->request->getPost('txtNom'),
            'prenom' => $this->request->getPost('txtPrenom'),
            'adresse' => $this->request->getPost('txtAdresse'),
            'cp' => $this->request->getPost('txtCP'),
            'ville' => $this->request->getPost('txtVille'),
            'telfixe' => $this->request->getPost('txtTelFixe'),
            'telmobile' => $this->request->getPost('txtTelMobile'),
            'mel' => $this->request->getPost('txtMel'),
            'mdp' => password_hash($this->request->getPost('txtMDP'), PASSWORD_DEFAULT),
        ];
    
        // Insérer les données dans la base de données
        $modelClient = new ModeleClient();
        $donnees['clientAjoute'] = $modelClient->insert($donneesAInserer, true);
    
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
            $donnees['liaison'] = $modLiaison->find($noLiaison);
            $donnees['tarifsLiaisons'] = $modLiaison->getAllTarifLiaison();
            return view('Templates/Header')
                   .view('Visiteur/vue_TarifsLiaisons', $donnees)
                   . view('Templates/Footer');
        }
        
    }

    public function seConnecter()
    {
        helper(['form']);
        $session = session();
        $data['TitreDeLaPage'] = 'Se connecter';
        /* TEST SI FORMULAIRE POSTE OU SI APPEL DIRECT (EN GET) */
        if (!$this->request->is('post')) {
            return view('Templates/Header', $data) // Renvoi formulaire de connexion
            . view('Visiteur/vue_SeConnecter')
            . view('Templates/Footer');
        }
        /* SI FORMULAIRE NON POSTE, LE CODE QUI SUIT N'EST PAS EXECUTE */
        /* VALIDATION DU FORMULAIRE */
        $reglesValidation = [ // Régles de validation
            'txtnom' => 'required',
            'txtMotDePasse' => 'required',
        ];

        if (!$this->validate($reglesValidation)) {
            /* formulaire non validé */
            $data['TitreDeLaPage'] = "Saisie incorrecte";
            return view('Templates/Header', $data)
            . view('Visiteur/vue_SeConnecter') // Renvoi formulaire de connexion
            . view('Templates/Footer');
        }
        /* SI FORMULAIRE NON VALIDE, LE CODE QUI SUIT N'EST PAS EXECUTE */
        /* RECHERCHE Client DANS BDD */
        $nom = $this->request->getPost('txtnom');
        $MdP = $this->request->getPost('txtMotDePasse');
        /* on va chercher dans la BDD l'Client correspondant aux id et mot de passe saisis */
        $modClient = new ModeleClient(); // instanciation modèle
        $condition = ['NOM'=>$nom,'motdepasse'=>$MdP];
        $ClientRetourne = $modClient->where($condition)->first();
        /* where : méthode, QueryBuilder, héritée de Model (), retourne,
        ici sous forme d'un objet, le résultat de la requête :
        SELECT * FROM Client  WHERE nom='$pId' and motdepasse='$MotdePasse
        ClientRetourne = objet Client ($returnType = 'object')
        */
        //die();
        if ($ClientRetourne != null) {
            /* nom et mot de passe OK : nom et profil sont stockés en session */
            $session->set('NOM', $ClientRetourne->NOM);
            $data['NOM'] = $nom;
            $data['profil'] = 'Client';
            echo view('Templates/Header', $data);
            echo view('Visiteur/vue_ConnexionReussie');
        } else {
            /* nom et/ou mot de passe OK : on renvoie le formulaire  */
            $data['TitreDeLaPage'] = "Identifiant ou/et Mot de passe inconnu(s)";
            return view('Templates/Header', $data)
            . view('Visiteur/vue_SeConnecter')
            . view('Templates/Footer');
        }
    } // Fin seconnecter
    
}

