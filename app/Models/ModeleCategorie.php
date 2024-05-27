<?php
namespace App\Models;
use CodeIgniter\Model;
class ModeleCategorie extends Model
{
    protected $table = 'categorie';
    protected $primaryKey = 'lettrecategorie'; // clé primaire
    protected $useAutoIncrement = false;
    protected $returnType = 'object'; // résultats retournés sous forme d'objet(s)
    protected $allowedFields = ['lettrecategorie', 'libelle'];


    public function  getCapaciteMaximale($noTraversee, $lettreCategorie)
    {
        return $this->join('contenir', 'categorie.lettrecategorie = contenir.lettrecategorie', 'inner')
                    ->join('bateau', 'contenir.nobateau = bateau.nobateau', 'inner')
                    ->join('traversee', 'bateau.nobateau = traversee.nobateau', 'inner')
                    ->select('contenir.capacitemax as capaMax')
                    ->where('traversee.notraversee', $noTraversee)
                    ->where('categorie.lettrecategorie', $lettreCategorie)
                    ->get()->getResult();
    }

    public function getLesCategories()
    {
        return $this->select('lettrecategorie, libelle')
                    ->get()->getResult();
    }
}