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
        if (!$this->request->is('post')) {
            /* le formulaire n'a pas été posté, on retourne le formulaire */
            return view('Templates/Header')
            . view('Visiteur/vue_Inscription', $data)
            . view('Templates/Footer');
        }
        /* VALIDATION DU FORMULAIRE */
        $reglesValidation = [
            'txtNom' => 'required|string|max_length[30]',
            'txtPrenom' => 'required|string|max_length[30]',
            // obligatoire, chaîne de carac. <= 30 carac.
            'txtAdresse' => 'required|string|max_length[30]',
            'txtCP' => 'required|string|max_length[30]',
            'txtVille' => 'required|string|max_length[30]',
            'txtTelFixe' => 'required|string|max_length[10]',
            'txtTelMobile' => 'required|string|max_length[10]',
            'txtMel' => 'required|string|max_length[30]',
            'txtMDP' => 'required|string|max_length[30]',
        ];
        if (!$this->validate($reglesValidation)) {
            /* formulaire non validé, on renvoie le formulaire */
            $data['TitreDeLaPage'] = "Inscription incorrecte";
            return view('Templates/Header')
            . view('Visiteur/vue_Inscription', $data)
            . view('Templates/Footer');
        }
        $donneesAInserer = array(
            'nom' => $this->request->getPost('txtNom'),
            'prenom' => $this->request->getPost('txtPrenom'),
            'adresse' => $this->request->getPost('txtAdresse'),
            'cp' => $this->request->getPost('txtCP'),
            'ville' => $this->request->getPost('txtVille'),
            'telfixe' => $this->request->getPost('txtTelFixe'),
            'telmobile' => $this->request->getPost('txtTelMobile'),
            'mel' => $this->request->getPost('txtMel'),
            'mdp' => $this->request->getPost('txtMDP'),
        );
        $modelClient = newModeleClient();
        $donnees['clientAjoute'] = $modelClient->insert($donneesAInserer, false);
        return view('Templates/Header')
            .view('Visiteur/vue_RapportInscrition', $donnees)
            .view('Templates/Footer');
    } // ajouterClient



    public function voirSecteursLiaisons($noLiaison = null)
    {
        $modLiaison = new ModeleLiaison();
        if ($noLiaison === null)
        {   
            $donnees['secteursLiaisons'] = $modLiaison->getAllLiaisonSecteurPort();
            // var_dump($donnees);
            return view('Templates/Header')
               .view('Visiteur/vue_SecteursLiaisons', $donnees)
               . view('Templates/Footer');
        } else
        {
            $donnees['tarifsLiaisons'] = $modLiaison->getAllTarifLiaison();
            // var_dump($donnees);
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
        $condition = ['nom'=>$nom,'motdepasse'=>$MdP];
        $ClientRetourne = $modClient->where($condition)->first();
        /* where : méthode, QueryBuilder, héritée de Model (), retourne,
        ici sous forme d'un objet, le résultat de la requête :
        SELECT * FROM Client  WHERE nom='$pId' and motdepasse='$MotdePasse
        ClientRetourne = objet Client ($returnType = 'object')
        */
        if ($ClientRetourne != null) {
            /* nom et mot de passe OK : nom et profil sont stockés en session */
            $session->set('nom', $ClientRetourne->nom);
            $session->set('profil', $ClientRetourne->profil);
            $data['nom'] = $nom;
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

