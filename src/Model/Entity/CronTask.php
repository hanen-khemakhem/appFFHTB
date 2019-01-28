<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * CronTask Entity
 *
 * @property int $id
 * @property string $controllers
 * @property string $action
 * @property string $data
 * @property string $level
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $executed
 * @property \Cake\I18n\FrozenTime $succeded
 * @property \Cake\I18n\FrozenTime $aborded
 * @property int $tentative
 */
class CronTask extends Entity
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
        'controllers' => true,
        'action' => true,
        'data' => true,
        'level' => true,
        'created' => true,
        'executed' => true,
        'succeded' => true,
        'aborded' => true,
        'tentative' => true
    ];
}
