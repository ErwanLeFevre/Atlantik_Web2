<?php
namespace App\Models;
use CodeIgniter\Model;
class ModeleType extends Model
{
    protected $table = 'type';
    protected $primaryKey = 'lettrecategorie, notype'; // clé primaire
    protected $useAutoIncrement = false;
    protected $returnType = 'object'; // résultats retournés sous forme d'objet(s)
    protected $allowedFields = ['lettrecategorie', 'notype', 'libelle'];
}