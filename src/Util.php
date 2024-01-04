<?php

namespace Qiyuesuo;

use Exception;
use Qiyuesuo\sdk\SDKClient;

class Util
{

    /**
     * @throws Exception
     */
    public static function getSDk($accessKey, $accessSecret, $endpoint = '')
    {
        $accessKey = trim($accessKey);
        $accessKeySecret = trim($accessSecret);

        if (empty($accessKey)) {
            throw new Exception('access key id is empty');
        }
        if (empty($accessKeySecret)) {
            throw new Exception('access key secret is empty');
        }

        $url = ($endpoint == 'dev') ? 'https://openapi.qiyuesuo.cn' : 'https://openapi.qiyuesuo.com';

        return new SDKClient($accessKey, $accessSecret, $url);
    }

    /**
     * 解密
     * @param $encrypt
     * @param $secretKey
     * @return false|string
     */
    public static function aesDecrypt($encrypt, $secretKey)
    {
        return openssl_decrypt(
            base64_decode($encrypt),
            'AES-128-ECB',
            $secretKey,
            OPENSSL_RAW_DATA
        );
    }

    /**
     * 加密
     * @param $encrypt
     * @param $secretKey
     * @return string
     */
    public static function aesEncrypt($encrypt, $secretKey)
    {
        $data = openssl_encrypt(
            $encrypt,
            'AES-128-ECB',
            $secretKey,
            OPENSSL_RAW_DATA
        );
        return base64_encode($data);
    }

    public static function checkSignature($signature, $timestamp, $secretKey)
    {
        return $signature === md5($timestamp . $secretKey);
    }
}
