<?php

namespace app\package\helper\qr;

use app\models\Fault;
use app\package\errorcode\ErrorCode;

class FaultHelper
{
    /**
     * @param $offset
     * @param $limit
     * @return array|\yii\db\ActiveRecord[]
     */
    public static function fetch($offset, $limit)
    {
        $list = Fault::find()->select('id, equ_id, fault, repair_man, phone, repair_time')
            ->offset($offset)->limit($limit)->orderBy('id desc')->asArray()->all();

        return $list;
    }

    /**
     * @param $params
     * @return bool
     * @throws \Exception
     */
    public static function save($params)
    {
        if ($params['fault_id']){
            $fault = Fault::find()->where(['id' => $params['fault_id']])->one();
            if (empty($fault)){
                throw new \Exception(\Yii::t('api', 'Record not found or has been deleted!', ['fault_id']), ErrorCode::ERR_RECORD_NOT_FOUND);
            }
        }else{
            $fault = new Fault();
        }

        $fault->eq_id = $params['eq_id'];
        $fault->fault = $params['fault'];
        $fault->repair_man = $params['repair_man'];
        $fault->phone = $params['phone'];

        if ($fault->save()){
            return true;
        }
    }

    /**
     * @param $fault_id
     * @return bool
     * @throws \Exception
     */
    public static function delete($fault_id)
    {
        $fault = Fault::find()->where(['id' => $fault_id])->one();
        if (empty($fault)){
            throw new \Exception(\Yii::t('api', 'Record not found or has been deleted!', ['fault_id']), ErrorCode::ERR_RECORD_NOT_FOUND);
        }

        $fault->status = Fault::STATUS_DELETE;
        if ($fault->save()){
            return true;
        }
    }
}