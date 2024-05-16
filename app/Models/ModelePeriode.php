<?php
namespace App\Models;
use CodeIgniter\Model;
class ModelePeriode extends Model
{
    protected $table = 'periode';
    protected $primaryKey = 'noperiode'; // clé primaire
    protected $useAutoIncrement = false;
    protected $returnType = 'object'; // résultats retournés sous forme d'objet(s)
    protected $allowedFields = ['noperiode', 'datedebut', 'datefin'];
}