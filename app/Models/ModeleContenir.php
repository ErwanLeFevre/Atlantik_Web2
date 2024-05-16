<?php
namespace App\Models;
use CodeIgniter\Model;
class ModeleContenir extends Model
{
    protected $table = 'contenir';
    protected $primaryKey = 'lettrecategorie, nobateau'; // clé primaire
    protected $useAutoIncrement = false;
    protected $returnType = 'object'; // résultats retournés sous forme d'objet(s)
    protected $allowedFields = ['lettrecategorie', 'nobateau', 'capacitemax'];
}