<?php
namespace App\Models;
use CodeIgniter\Model;
class ModeleEnregistrer extends Model
{
    protected $table = 'enregistrer';
    protected $primaryKey = 'noreservation, lettrecategorie, notype'; // clé primaire
    protected $useAutoIncrement = false;
    protected $returnType = 'object'; // résultats retournés sous forme d'objet(s)
    protected $allowedFields = ['noreservation', 'lettrecategorie', 'notype', 'quantitereservee', 'quantiteembarquee'];
}