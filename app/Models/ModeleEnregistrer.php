<?php
namespace App\Models;
use CodeIgniter\Model;
class ModeleEnregistrer extends Model
{
    protected $table = 'enregistrer';
    protected $primaryKey = ['noreservation', 'lettrecategorie', 'notype']; // clé primaire
    protected $useAutoIncrement = false;
    protected $returnType = 'object'; // résultats retournés sous forme d'objet(s)
    protected $allowedFields = ['noreservation', 'lettrecategorie', 'notype', 'quantitereservee', 'quantiteembarquee'];

    public function getQuantiteEnregistree($noTraversee, $lettreCategorie)
    {
        return $this->join('reservation', 'enregistrer.noreservation = reservation.noreservation', 'inner')
                    ->join('traversee', 'reservation.notraversee = traversee.notraversee', 'inner')
                    ->select('SUM(enregistrer.quantitereservee) as placeRes')
                    ->where('reservation.notraversee', $noTraversee)
                    ->where('enregistrer.lettrecategorie', $lettreCategorie)
                    ->get()
                    ->get()->getResult();
    }
}