<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * EcolesFfhtb Entity
 *
 * @property int $id
 * @property int $user_id
 * @property string $nom
 * @property string $logo
 * @property string $adresse
 * @property string $ville
 * @property string $pays
 * @property string $code_postal
 * @property string $telephone
 * @property string $email
 * @property string $presentation
 * @property string $sujet
 * @property string $site
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\User $user
 */
class EcolesFfhtb extends Entity
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
        'user_id' => true,
        'nom' => true,
        'logo' => true,
        'adresse' => true,
        'ville' => true,
        'pays' => true,
        'code_postal' => true,
        'telephone' => true,
        'email' => true,
        'presentation' => true,
        'sujet' => true,
        'site' => true,
        'created' => true,
        'modified' => true,
        'user' => true
    ];
}
