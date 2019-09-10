<?php
namespace app\modules\frontend\controllers\qr;

use app\controllers\BaseController;
use app\package\errorcode\ErrorCode;
use app\package\helper\qr\FaultHelper;

class FaultController extends BaseController
{
    /*public function actionList()
    {
        $page = $this->queryParam('page', 1);
        $size = $this->queryParam('size', 15);

        $offset = ($page-1)*$size;
        $list = FaultHelper::fetch($offset, $size);

        return $list;
    }*/

    public function actionSave()
    {
        $params['fault_id'] = $this->queryParam('fault_id', 0);
        $params['eq_id'] = $this->queryParam('eq_id', 0);
        $params['fault'] = $this->queryParam('fault', '');
        $params['repair_man'] = $this->parseFloat('repair_man', '');
        $params['phone'] = $this->queryParam('phone', '');

        if (!$params['eq_id'] || !$params['fault'] || !$params['phone']){
            $this->error(ErrorCode::ERR_PARAM_REQUIRED, \Yii::t('api', '{0} required!', ['eq_id/fault/phone']));
        }

        try{
            if (FaultHelper::save($params)){
                return $this->success();
            }
        }catch (\Exception $e){
            return $this->error($e->getCode(), $e->getMessage());
        }
    }

    /*public function actionDelete()
    {
        $fault_id = $this->queryParam('fault_id', 0);

        if (!$fault_id){
            $this->error(ErrorCode::ERR_PARAM_REQUIRED, \Yii::t('api', '{0} required!', ['fault_id']));
        }

        try{
            if (FaultHelper::delete($fault_id)){
                return $this->success();
            }
        }catch (\Exception $e){
            return $this->error($e->getCode(), $e->getMessage());
        }
    }*/
}