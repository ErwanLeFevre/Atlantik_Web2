<?php
namespace App\Models;
use CodeIgniter\Model;
class ModeleLiaison extends Model
{
    protected $table = 'liaison';
    protected $primaryKey = 'noliaison';
    protected $useAutoIncrement = true;
    protected $returnType = 'object';
    protected $allowedFields = ['noport_depart', 'nosecteur', 'noport_arrivee', 'distance'];

    public function getAllLiaisonSecteurPort()
    {
        return $this->join('secteur', 'liaison.nosecteur = secteur.nosecteur', 'inner')
                    ->join('port as port_depart', 'liaison.noport_depart = port_depart.noport', 'inner')
                    ->join('port as port_arrivee', 'liaison.noport_arrivee = port_arrivee.noport', 'inner')
                    ->select('secteur.nom as nomsecteur, liaison.noliaison as liaison, liaison.distance as distance, port_depart.nom as portdepart, port_arrivee.nom as portarrivee')
                    ->get()->getResult();
    }

    public function getAllTarifLiaison()//$liaison
    {
        return $this->join('tarifer', 'tarifer.noliaison = liaison.noliaison', 'inner')
                    ->join('periode', 'periode.noperiode = tarifer.noperiode', 'inner')
                    ->join('categorie', 'categorie.lettrecategorie = tarifer.lettrecategorie', 'inner')
                    ->join('type', 'type.notype = tarifer.notype', 'inner')
                    ->join('port as port_depart', 'liaison.noport_depart = port_depart.noport', 'inner')
                    ->join('port as port_arrivee', 'liaison.noport_arrivee = port_arrivee.noport', 'inner')
                    ->select('categorie.lettrecategorie as lettrecategorie, categorie.libelle as categorielibelle, type.libelle as type, periode.datedebut as datedebut, periode.datefin as datefin, port_depart.nom as portdepart, port_arrivee.nom as portarrivee, tarifer.tarif as tarif')
                    //->where('liaison.noliaison', $noLiaison)
                    ->get()->getResult();
    }

    public function LesTraverseesBateaux($noLiaison, $dateTraversee)
    {
        return $this->join('traversee', 'traversee.noliaison = liaison.noliaison', 'inner')
                    ->join('bateau', 'traversee.nobateau = bateau.nobateau', 'inner')
                    ->select('traversee.notraversee as traversee, traversee.dateheuredepart as DHDepart, traversee.dateheurearrivee as DHArrivee')
                    ->get()->getResult();
    }
}