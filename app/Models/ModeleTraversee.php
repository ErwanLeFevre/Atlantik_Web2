<?php
namespace App\Models;
use CodeIgniter\Model;
class ModeleTraversee extends Model
{
    protected $table = 'traversee';
    protected $primaryKey = 'notraversee'; // clé primaire
    protected $useAutoIncrement = true;
    protected $returnType = 'object'; // résultats retournés sous forme d'objet(s)
    protected $allowedFields = ['noliaison', 'nobateau', 'dateheuredepart', 'dateheurearrivee'];

    public function getLesTraverseesBateaux($noLiaison, $dateTraversee)
{
    return $this->join('bateau', 'traversee.nobateau = bateau.nobateau', 'inner')
                ->select('traversee.notraversee, traversee.heure, bateau.nom')
                ->where('traversee.noliaison', $noLiaison)
                ->where('traversee.date', $dateTraversee)
                ->get()->getResult();
}


}