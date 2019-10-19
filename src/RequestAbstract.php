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

abstract class RequestAbstract
{
    const OPERATE_TYPE_USER = 'USER';
    const OPERATE_TYPE_SYSTEM = 'SYSTEM';

    protected $data = [];

    public function __construct($data = [])
    {
        $this->data = $data;
    }

    public abstract function getRequestPath();

    public function getParams()
    {
        return $this->data;
    }
}
