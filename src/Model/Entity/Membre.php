<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Membre Entity
 *
 * @property int $id
 * @property int $country_id
 * @property int $is_referant
 * @property string $nom
 * @property string $email
 * @property string $title
 * @property string $adresse1
 * @property string $adresse2
 * @property string $adresse3
 * @property string $code_postal
 * @property string $ville
 * @property string $telephone
 * @property string $site_web
 * @property string $commentaire
 * @property \Cake\I18n\FrozenDate $installed
 * @property string $departement
 * @property string $region
 * @property string $lat
 * @property string $lng
 * @property string $domaines
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 */
class Membre extends Entity
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
        'country_id' => true,
        'is_referant' => true,
        'nom' => true,
        'email'=>true,
        'title' => true,
        'adresse1' => true,
        'adresse2' => true,
        'adresse3' => true,
        'code_postal' => true,
        'ville' => true,
        'telephone' => true,
        'site_web' => true,
        'commentaire' => true,
        'installed' => true,
        'departement' => true,
        'region' => true,
        'lat' => true,
        'lng' => true,
        'domaines' => true,
        'created' => true,
        'modified' => true
    ];
}
