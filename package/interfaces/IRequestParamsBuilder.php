<?php

namespace app\package\interfaces;

/**
 * Interface IRequestParamsBuilder
 * 解析客户端->服务的参数
 * @package app\package\interfaces
 */
interface IRequestParamsBuilder
{
    /**
     * get param with name $paramKey, convert to string
     * @param $paramKey
     * @param string $default
     * @return mixed
     */
    public function paresStr($paramKey, $default = '');

    /**
     * get param with name $paramKey, convert to int
     * @param $paramKey
     * @param int $default
     * @return mixed
     */
    public function paresInt($paramKey, $default = 0);

    /**
     * get param with name $paramKey, convert to float
     * @param $paramKey
     * @param float $default
     * @return mixed
     */
    public function paresFloat($paramKey, $default = 0.0);

    /**
     * get param with name $paramKey, convert to boolean
     * @param $paramKey
     * @param string $default
     * @return mixed
     */
    public function paresBoolean($paramKey, $default = '');

    /**
     * get comma separated string, return array split by comma
     * @param $paramKey
     * @param array $default
     * @return mixed
     */
    public function paresStringArray($paramKey, $default = []);

    /**
     * get comma separated string, return array split by comma
     * @param $paramKey
     * @param array $default
     * @return mixed
     */
    public function paresIntArray($paramKey, $default = []);

    /**
     * get comma separated string, return array split by comma
     * @param $paramKey
     * @param array $default
     * @return mixed
     */
    public function paresFloatArray($paramKey, $default = []);
}