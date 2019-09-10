<?php

namespace app\package\helper;

use Endroid\QrCode\QrCode;
use Endroid\QrCode\ErrorCorrectionLevel;
use Symfony\Component\HttpFoundation\Response;

class QrCodeHelper
{

    public static function makeQrCode($url, $name, $size = 12, $set_log = true, $logPath = '', $logWidth = 50)
    {
        $qrCode = new QrCode();
        $qrCode->setText($url);
        $qrCode->setLabel('微信扫一扫', $size);

        if($set_log ==true){

            if(!$logPath){
                $logPath = \Yii::getAlias('@runtime').'\logs\images\1ac882b96b427573192b780c7498b43.png';
            }

            $qrCode->setLogoPath($logPath);
            $qrCode->setLogoWidth($logWidth);
        }

        //$qrCode->setErrorCorrectionLevel(ErrorCorrectionLevel::HIGH());
        $path = \Yii::getAlias('@runtime'). '/logs/images/' . $name;
        $qrCode->writeFile($path);

        return $path;
        /*header('Content-Type: '.$qrCode->getContentType());
        echo $qrCode->writeString();*/
    }
}