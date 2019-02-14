<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Praticien Entity
 *
 * @property int $id
 * @property int $user_id
 * @property string $nom
 * @property string $niveau
 * @property string $annee_certif
 * @property string $pays
 * @property string $adresse
 * @property string $ville
 * @property string $codepostal
 * @property string $telephone
 * @property string $email
 * @property string $specialite
 * @property int $in_annuaire
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 */
class Praticien extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'user_id'=>true,
        'nom' => true,
        'niveau' => true,
        'annee_certif' => true,
        'pays' => true,
        'adresse'=>true,
        'ville'=>true,
        'codepostal'=>true,
        'telephone'=>true,
        'email'=>true,
        'specialite'=>true,
        'in_annuaire'=>true,
        'created' => true,
        'modified' => true
    ];
}
