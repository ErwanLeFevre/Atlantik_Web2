<?php
namespace App\Models;
use CodeIgniter\Model;
class ModeleClient extends Model
{
    protected $table = 'client';
    protected $primaryKey = 'noclient'; // Clé primaire
    protected $useAutoIncrement = true; // Utilisation de l'auto-incrémentation
    protected $returnType = 'object'; // Résultats retournés sous forme d'objet(s)
    protected $allowedFields = ['nom', 'prenom', 'codepostal', 'ville', 'telephonefixe', 'telephonemobile', 'mel', 'motdepasse']; // Champs autorisés pour les opérations de création et de mise à jour
}
?>