<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Amount Entity.
 *
 * @property int $id
 * @property float $amount
 * @property \Cake\I18n\Time $date
 * @property string $detail
 * @property int $type
 * @property int $association_id
 * @property \App\Model\Entity\Association $association
 * @property int $tract_id
 * @property \App\Model\Entity\Tract $tract
 */
class Amount extends Entity
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
        '*' => true,
        'id' => false,
    ];
}
