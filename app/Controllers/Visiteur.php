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



    public function voirSecteursLiaisons()
    {
        $modLiaison = new ModeleLiaison();
        $donnees['secteursLiaisons'] = $modLiaison->getAllLiaisonSecteurPort();
        // var_dump($donnees);
        return view('Visiteur/vue_SecteursLiaisons', $donnees);
    }



    public function voirLesLiaisons($referencLiaison = null)
    {
        $modLiaison = new ModeleLiaison();
        if ($referenceLiaison === null)
        {
            $data['lesLiaisons'] = $modLiaison->findAll();
            $data['TitreDeLaPage'] = 'Tous les Liaisons';
            return view('Templates/Header')
            . view('Visiteur/vue_VoirLesLiaisons', $data)
            . view('Templates/Footer');
        } else
        {
            $data['uneLiaison'] = $modLiaison->find($noliaison);
            if (empty($data['uneLiaison'])) { 
                throw\CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            }
            $data['TitreDeLaPage'] = $data['uneLiaison']->noliaison; 
            return view('Templates/Header')
            . view('Visiteur/vue_VoirDetailUneLiaison', $data)
            . view('Templates/Footer');
        }
    } // Fin voirLesLiaisons









    
}

