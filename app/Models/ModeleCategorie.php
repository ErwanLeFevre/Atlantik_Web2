<?php
namespace App\Models;
use CodeIgniter\Model;
class ModeleCategorie extends Model
{
    protected $table = 'categorie';
    protected $primaryKey = 'lettrecategorie'; // clé primaire
    protected $useAutoIncrement = false;
    protected $returnType = 'object'; // résultats retournés sous forme d'objet(s)
    protected $allowedFields = ['lettrecategorie', 'libelle'];
}