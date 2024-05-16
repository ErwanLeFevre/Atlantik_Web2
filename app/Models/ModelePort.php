<?php
namespace App\Models;
use CodeIgniter\Model;
class ModelePort extends Model
{
    protected $table = 'port';
    protected $primaryKey = 'noport'; // clé primaire
    protected $useAutoIncrement = false;
    protected $returnType = 'object'; // résultats retournés sous forme d'objet(s)
    protected $allowedFields = ['noport', 'nom'];
}