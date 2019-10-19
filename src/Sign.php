<?php
/**
 * Hangzhou Yunshang Network Technology Inc.
 * http://www.wsy.com
 * ==============================================
 * @author: xrn
 * @date: 2019年10月15日
 * @time: 上午11:12:36
 * @desc: DataPoint.php
 */

namespace WsySDK\DataPoint;

class Sign
{
    public static function sign($params, $token)
    {
        ksort($params);
        $sign = '';
        foreach ($params as $k => $v) {
            $v = trim($v);
            if ($k == 'sign' || !$v) {
                continue;
            }
            $sign .= $k . '=' . $v . '&';
        }
        $sign = $token . substr($sign, 0, -1);
        return md5($sign);
    }
}
