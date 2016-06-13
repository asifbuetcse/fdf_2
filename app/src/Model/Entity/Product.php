<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Product Entity.
 *
 * @property int $id
 * @property string $name
 * @property bool $is_food
 * @property float $price
 * @property int $category_id
 * @property \App\Model\Entity\Category $category
 * @property float $average_rating
 * @property string $image
 * @property int $number
 * @property \App\Model\Entity\Comment[] $comments
 * @property \App\Model\Entity\Rating[] $ratings
 * @property \App\Model\Entity\Cart[] $carts
 */
class Product extends Entity
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
