<?php
namespace App\Models;
use CodeIgniter\Model;
class ModeleAdministrateur extends Model
{
    protected $table = 'administrateur';
    protected $primaryKey = 'identifiant'; // clé primaire
    protected $useAutoIncrement = false;
    protected $returnType = 'object'; // résultats retournés sous forme d'objet(s)
    protected $allowedFields = ['identifiant', 'motdepasse', 'profil'];
}