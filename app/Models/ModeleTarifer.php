<?php
namespace App\Models;
use CodeIgniter\Model;
class ModeleTarifer extends Model
{
    protected $table = 'tarifer t';
    protected $primaryKey = 'noperiode, lettrecategorie, notype, noliaison'; // clé primaire
    protected $useAutoIncrement = false;
    protected $returnType = 'object'; // résultats retournés sous forme d'objet(s)
    protected $allowedFields = ['noperiode', 'lettrecategorie', 'notype', 'noliaison', 'tarif'];

    public function getAllTarifLiaison()
    {
        return $this->join('periode p', 'p.noperiode = t.noperiode', 'inner')
        ->join('categorie c', 'c.lettre = pd.noport',  'inner')
        ->join('type', 'l.noport_arrivee = pa.noport',  'inner')
        ->join('liaison l', 'l.noport_arrivee = pa.noport',  'inner')
        ->select('sec.nom as nomsecteur, ')
        ->get()->getResult();
  }
}