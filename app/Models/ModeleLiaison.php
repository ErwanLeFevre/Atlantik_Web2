<?php
namespace App\Models;
use CodeIgniter\Model;
class ModeleLiaison extends Model
{
    protected $table = 'liaison l';
    protected $primaryKey = 'noliaison'; // clé primaire
    protected $useAutoIncrement = true;
    protected $returnType = 'object'; // résultats retournés sous forme d'objet(s)
    protected $allowedFields = ['noport_depart', 'nosecteur', 'noport_arrivee', 'distance'];

    public function getAllLiaisonSecteurPort()
    {
        return $this->join('secteur sec', 'l.nosecteur = sec.nosecteur', 'inner')
        ->join('port pd', 'l.noport_depart = pd.noport',  'inner')
        ->join('port pa', 'l.noport_arrivee = pa.noport',  'inner')
        ->select('sec.nom as nomsecteur, l.noliaison as noliaison,l.distance as distance, pd.nom as portdepart, pa.nom as portarrivee')
        ->get()->getResult();
    }

    public function getAllTarifLiaison()
    {
        return $this->join('periode p', 'p.noperiode = t.noperiode', 'inner')
        ->join('categorie c', 'c.lettrecategorie = t.lettrecategorie',  'inner')
        ->join('type', 'type.notype = t.notype',  'inner')
        ->join('liaison l', 'l.noliaison = t.noliaison',  'inner')
        ->select('c.libelle as libellecategorie, ')
        ->get()->getResult();
    }
}