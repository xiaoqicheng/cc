<?php

namespace app\modules\backend\controllers\backend\qr;

use app\controllers\BaseController;
use app\package\errorcode\ErrorCode;
use app\package\helper\qr\EquipmentHelper;

class EquipmentController extends BaseController
{

    public function actionList()
    {
        $page = $this->queryParam('page', 1);
        $size = $this->queryParam('size', 15);
        $offset = ($page-1)*$size;

        $list = EquipmentHelper::getList($offset, $size);
        $this->success($list);
    }

    public function actionSave()
    {
        $params['id'] = $this->queryParam('eq_id', 0);
        $params['name'] = $this->queryParam('name', '');
        $params['version'] = $this->parseFloat('version', 0.0);
        $params['intro'] = $this->queryParam('intro', '');

        try{
            if (EquipmentHelper::save($params)){
                return $this->success();
            }
        }catch (\Exception $e){
            return $this->error($e->getCode(), $e->getMessage());
        }

    }

    public function actionDelete()
    {
        $id = $this->queryParam('eq_id', 0);

        if (!$id){
            return $this->error(ErrorCode::ERR_PARAM_REQUIRED, \Yii::t('api', '{0} required!', ['eq_id']));
        }

        try{
            if (EquipmentHelper::delete($id)){
                return $this->success();
            }
        }catch (\Exception $e){
            return $this->error($e->getCode(), $e->getMessage());
        }
    }


    public function actionQrCode(){
        $id = $this->queryParam('eq_id', 0);

        if (!$id){
            return $this->error(ErrorCode::ERR_PARAM_REQUIRED, \Yii::t('api', '{0} required!', ['eq_id']));
        }

        try{
            if (EquipmentHelper::updateCode($id)){
                return $this->success();
            }
        }catch (\Exception $e){
            return $this->error($e->getCode(), $e->getMessage());
        }
    }
}