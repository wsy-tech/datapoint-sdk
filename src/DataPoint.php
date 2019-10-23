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

use WsySDK\DataPoint\Request\Goods;
use WsySDK\DataPoint\Request\Order;

class DataPoint extends Client
{
    // 操作者
    const OPERATE_TYPE_USER = 'USER';     //用户
    const OPERATE_TYPE_SYSTEM = 'SYSTEM'; //系统

    // 操作状态
    const OPERATE_STATUS_CREATED = 'CREATED';  //创建
    const OPERATE_STATUS_UP = 'UP';            //上架
    const OPERATE_STATUS_DOWN = 'DOWN';        //下架
    const OPERATE_STATUS_PAYED = 'PAYED';      //支付
    const OPERATE_STATUS_SEND = 'SENT';        //发货
    const OPERATE_STATUS_SENT = 'SENT';        //发货
    const OPERATE_STATUS_CANCLE = 'CANCEL';    //取消
    const OPERATE_STATUS_CANCEL = 'CANCEL';    //取消
    const OPERATE_STATUS_CLOSED = 'CLOSED';    //关闭

    /**
     * 商品埋点接口
     * @param $param
     * @return mixed
     */
    public function goodsPoint($param)
    {
        return $this->batchGoodsPoint([$param]);
    }

    /**
     * 商品埋点接口 批量添加
     * @param $param
     * @return mixed
     */
    public function batchGoodsPoint($param)
    {
        $response = $this->sendRequest(new Goods($param));
        if ($response && $response->getStatusCode() == 200) {
            $result = json_decode($response->getBody()->getContents(), true);
            if ($result && isset($result['code']) && $result['code'] == 0) {
                return true;
            }
        }
        return false;
    }

    /**
     * 订单埋点接口
     * @param $param
     * @return mixed
     */
    public function orderPoint($param)
    {
        return $this->batchOrderPoint([$param]);
    }

    /**
     * 订单埋点接口 批量添加
     * @param $param
     * @return mixed
     */
    public function batchOrderPoint($param)
    {
        $response = $this->sendRequest(new Order($param));
        if ($response && $response->getStatusCode() == 200) {
            $result = json_decode($response->getBody()->getContents(), true);
            if ($result && isset($result['code']) && $result['code'] == 0) {
                return true;
            }
        }
        return false;
    }
}
