<?php

namespace app\models;

use yii\db\ActiveRecord;

/**
 * Class Fault
 * @property int    $id;
 * @property int    $eq_id;
 * @property string $fault;
 * @property string $repair_man;
 * @property string $phone;
 * @property string $status;
 * @property string $create_time
 * @property string $update_time
 * @package app\models
 */
class Fault extends ActiveRecord
{

    const STATUs_ACTIVE = 1;
    const STATUS_DELETE = 2;
    /**
     * @return string
     */
    public static function tableName()
    {
        return '{{%fault}}';
    }

    public function rules()
    {
        return parent::rules(); // TODO: Change the autogenerated stub
    }
}