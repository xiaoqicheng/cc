<?php

namespace app\package\requests;

use app\package\interfaces\IRequestParamsBuilder;

abstract class AbstractRequestParamsBuilder implements IRequestParamsBuilder
{
    private $header;
    private $request;
    private $cookies;

    public function __construct()
    {
        $this->header = \Yii::$app->request->headers;
        $this->cookies = \Yii::$app->request->cookies;
        $this->request = \Yii::$app->request;
    }

    public function paresStr($paramKey, $default = '')
    {
        $param = $this->parseParam($paramKey, $default);

        if (! empty($param)){
            $param = trim($param);
        }

        return strval($param);
    }

    public function paresInt($paramKey, $default = 0)
    {
        $param = $this->parseParam($paramKey, $default);

        return intval($param);
    }

    public function paresFloat($paramKey, $default = 0.0)
    {
        $param = $this->parseParam($paramKey, $default);

        return floatval($param);
    }

    public function paresBoolean($paramKey, $default = '')
    {
        // TODO: Implement paresBoolean() method.
    }

    public function paresStringArray($paramKey, $default = [])
    {
        // TODO: Implement paresStringArray() method.
    }

    public function paresIntArray($paramKey, $default = [])
    {
        // TODO: Implement paresIntArray() method.
    }

    public function paresFloatArray($paramKey, $default = [])
    {
        // TODO: Implement paresFloatArray() method.
    }

    protected function parseParam($paramKey, $default = null)
    {
        if (isset($this->cookies[$paramKey])){
            return $this->cookies[$paramKey];
        }

        if ($this->request->isGet){
            return $this->request->get($paramKey, $default);
        }

        if ($this->request->isPost){
            return $this->request->post($paramKey, $default);
        }

        return $default;
    }
}