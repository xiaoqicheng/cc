<?php

namespace app\modules\frontend\controllers;


use app\controllers\BaseController;

class AuthController extends BaseController
{
    public $layout = 'main';

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionLogin()
    {

    }

    public function actionRegister()
    {

    }

    public function actionError()
    {
        return $this->render('error');
    }
}