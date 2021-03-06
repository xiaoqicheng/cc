<?php
namespace app\models;

use yii\db\ActiveRecord;

/**
 * Class Equipment
 * @property int $  id
 * @property string $name
 * @property float  $version
 * @property string $introduce
 * @property string $qr_code
 * @property int    $status
 * @property string $create_time
 * @property string $update_time
 * @package app\models
 */
class Equipment extends ActiveRecord
{
    const STATUS_ACTIVE = 1;
    const STATUS_DELETE = 2;
    /**
     * @return string
     */
    public static function tableName()
    {
        return '{{%equipment}}';
    }

    /**
     * @return array
     */
    public function rules()
    {
        return parent::rules(); // TODO: Change the autogenerated stub
    }
}