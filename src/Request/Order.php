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

namespace WsySDK\DataPoint\Request;

use WsySDK\DataPoint\RequestAbstract;

class Order extends RequestAbstract
{
    const OPERATE_STATUS_CREATED = 'CREATED'; // 订单创建
    const OPERATE_STATUS_PAYED = 'PAYED'; // 订单支付
    const OPERATE_STATUS_SEND = 'SEND'; // 订单发货
    const OPERATE_STATUS_CANCEL = 'CANCEL'; // 订单取消
    const OPERATE_STATUS_CLOSED = 'CLOSED'; // 订单关闭
    const OPERATE_STATUS_SHORTAGE = 'SHORTAGE'; // 订单缺货

    public function getRequestPath()
    {
        return 'data-point/order';
    }

    public function getParams()
    {
        return [
            'message' => json_encode(parent::getParams()),
        ];
    }
}
