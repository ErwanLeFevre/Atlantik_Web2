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
}