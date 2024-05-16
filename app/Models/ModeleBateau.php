<?php
namespace App\Models;
use CodeIgniter\Model;
class ModeleBateau extends Model
{
    protected $table = 'bateau';
    protected $primaryKey = 'nobateau'; // clé primaire
    protected $useAutoIncrement = false;
    protected $returnType = 'object'; // résultats retournés sous forme d'objet(s)
    protected $allowedFields = ['nobateau', 'nom'];
}