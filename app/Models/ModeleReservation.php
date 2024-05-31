<?php
namespace App\Models;
use CodeIgniter\Model;
class ModeleReservation extends Model
{
    protected $table = 'reservation';
    protected $primaryKey = 'noreservation'; // clé primaire
    protected $useAutoIncrement = false;
    protected $returnType = 'object'; // résultats retournés sous forme d'objet(s)
    protected $allowedFields = ['noreservation', 'notraversee', 'noclient', 'dateheure', 'montanttotal', 'paye', 'modereglement'];

    public function getHistoriqueReservations($noclient, $perPage, $offset)
    {
        return $this->select('reservation.noreservation, reservation.dateheure as datereservation, portdepart.nom as portdepart, portarrivee.nom as portarrivee, traversee.dateheuredepart as datedepart, reservation.montanttotal, reservation.paye')
                    ->join('traversee', 'traversee.notraversee = reservation.notraversee')
                    ->join('liaison', 'liaison.noliaison = traversee.noliaison')
                    ->join('port as portdepart', 'portdepart.noport = liaison.noport_depart')
                    ->join('port as portarrivee', 'portarrivee.noport = liaison.noport_arrivee')
                    ->where('reservation.noclient', $noclient)
                    ->orderBy('reservation.dateheure', 'DESC')
                    ->paginate($perPage, '', $offset);
    }

}