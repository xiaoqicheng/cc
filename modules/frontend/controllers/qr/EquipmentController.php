<?php

namespace app\modules\frontend\controllers\qr;

use app\controllers\BaseController;
use app\package\errorcode\ErrorCode;
use app\package\helper\qr\EquipmentHelper;

class EquipmentController extends BaseController
{
    public function actionInfo()
    {
        $id = $this->queryParam('eq_id', 0);

        if (!$id){
            return $this->error(ErrorCode::ERR_PARAM_REQUIRED, \Yii::t('api', '{0} required!', ['eq_id']));
        }

        try{
            $info = EquipmentHelper::getInfoById($id);
            $this->success($info);
        }catch (\Exception $e){
            return $this->error($e->getCode(), $e->getMessage());
        }
    }



}