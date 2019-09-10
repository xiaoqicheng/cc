<?php

namespace app\package\helper\qr;

use app\config\DENV;
use app\models\Equipment;
use app\package\errorcode\ErrorCode;
use app\package\helper\QrCodeHelper;

class EquipmentHelper
{
    public static function getList($offset, $limit)
    {
        $list = Equipment::find()->select('id, name, version, introduce, qr_code')
            ->where(['status' => Equipment::STATUS_ACTIVE])
            ->offset($offset)->limit($limit)->asArray()->all();

        return $list;
    }

    /**
     * @param $params
     * @return bool
     * @throws \Exception
     */
    public static function save($params)
    {
        if (!$params['id']){
            $equipment = new Equipment();
        }else{
            $equipment = Equipment::find()->where(['id' => $params['id']])
                ->andWhere(['status' => Equipment::STATUS_ACTIVE])->one();

            if (empty($equipment)){
                throw new \Exception(\Yii::t('api', 'Record not found or has been deleted!', ['eq_id']), ErrorCode::ERR_RECORD_NOT_FOUND);
            }
        }

        $equipment->name = $params['name'];
        $equipment->version = $params['version'];
        $equipment->introduce = $params['intro'];
        $equipment->status = Equipment::STATUS_ACTIVE;

        if ($equipment->save()){
            $eq_id = $equipment->attributes['id'];

            if (self::updateCode($eq_id)){
                return true;
            }
        }
    }

    /**
     * @param $eq_id
     * @return bool
     * @throws \Exception
     */
    public static function updateCode($eq_id)
    {
        $url = DENV::WEBSITE . '/qr/equipment/info/eq_id=' . $eq_id;
        $name = time() . $eq_id . '.png';
        $path = QrCodeHelper::makeQrCode($url, $name);
        $equipment = Equipment::find()->where(['id' => $eq_id])
            ->andWhere(['status' => Equipment::STATUS_ACTIVE])->one();

        if (empty($equipment)){
            throw new \Exception(\Yii::t('api', 'Record not found or has been deleted!', ['eq_id']), ErrorCode::ERR_RECORD_NOT_FOUND);
        }

        if (file_exists($equipment->qr_code)){
            unlink($equipment->qr_code);
        }

        $equipment->qr_code = $path;

        if ($equipment->save()){
            return true;
        }
    }

    /**
     * @param $id
     * @return bool
     * @throws \Exception
     */
    public static function delete($id)
    {
        $equipment = Equipment::find()->where(['id' => $id])
            ->andWhere(['status' => Equipment::STATUS_ACTIVE])->one();

        if (empty($equipment)){
            throw new \Exception(\Yii::t('api', 'Record not found or has been deleted!', ['eq_id']), ErrorCode::ERR_RECORD_NOT_FOUND);
        }

        $equipment->status = Equipment::STATUS_DELETE;

        if ($equipment->save()){
            return true;
        }
    }

    /**
     * @param $id
     * @return array|\yii\db\ActiveRecord|null
     * @throws \Exception
     */
    public static function getInfoById($id)
    {
        $info = Equipment::find()->select('id, name, version, introduce, qr_code')
            ->where(['id' => $id])
            ->andWhere(['status' => Equipment::STATUS_ACTIVE])->asArray()->one();

        if (empty($info)){
            throw new \Exception(\Yii::t('api', 'Record not found or has been deleted!', ['eq_id']), ErrorCode::ERR_RECORD_NOT_FOUND);
        }

        return $info;
    }
}