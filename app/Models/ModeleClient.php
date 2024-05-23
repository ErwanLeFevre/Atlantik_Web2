<?php
namespace App\Models;
use CodeIgniter\Model;
class ModeleClient extends Model
{
    protected $table = 'client';
    protected $primaryKey = 'noclient'; // clé primaire
    protected $useAutoIncrement = true;
    protected $returnType = 'object'; // résultats retournés sous forme d'objet(s)
    protected $allowedFields = ['nom', 'prenom', 'codepostal', 'ville', 'tephonefixe', 'telephonemobile', 'mel', 'motdepasse'];

    
}