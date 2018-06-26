<?php
/**
 * Created by PhpStorm.
 * User: xtn
 * Date: 2018-4-17
 * Time: 21:26
 */

namespace App\Handlers;


class IpAddressHandler
{
    protected static $serverUrl = 'http://ip.taobao.com/service/getIpInfo.php?ip=';

    /**
     * 获取并返回地址
     * @param $ip
     * @return null|string
     */
    public static function getAddress($ip)
    {
        if (self::isIp($ip)) {
            $result = file_get_contents(self::$serverUrl . $ip);
            $result = json_decode($result, true);
            if ($result['code'] === 0) {
                return $result['data']['region'] . '.' . $result['data']['city'];
            } else {
                return '未知';
            }
        }
        return null;
    }

    /**
     * 判断是不是ip地址
     * @param $ip
     * @return bool
     */
    protected static function isIp($ip)
    {
        if (preg_match('/^((?:(?:25[0-5]|2[0-4]\d|((1\d{2})|([1-9]?\d)))\.){3}(?:25[0-5]|2[0-4]\d|((1\d{2})|([1 -9]?\d))))$/', $ip)) {
            return true;
        } else {
            return false;
        }
    }
}