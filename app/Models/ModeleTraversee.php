<?php
namespace App\Models;
use CodeIgniter\Model;
class ModeleTraversee extends Model
{
    protected $table = 'traversee';
    protected $primaryKey = 'notraversee'; // clé primaire
    protected $useAutoIncrement = false;
    protected $returnType = 'object'; // résultats retournés sous forme d'objet(s)
    protected $allowedFields = ['notraversee', 'noliaison', 'nobateau', 'dateheuredepart', 'dateheurearrivee'];
}