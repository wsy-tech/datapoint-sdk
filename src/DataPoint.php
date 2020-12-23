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
use WsySDK\DataPoint\Request\User;

class DataPoint extends Client
{
    // 操作者
    const OPERATE_TYPE_USER = RequestAbstract::OPERATE_TYPE_USER;     //用户
    const OPERATE_TYPE_SYSTEM = RequestAbstract::OPERATE_TYPE_SYSTEM; //系统

    // 操作状态
    const OPERATE_STATUS_CREATED = Goods::OPERATE_STATUS_CREATED;  //创建
    const OPERATE_STATUS_UP = Goods::OPERATE_STATUS_UP;            //上架
    const OPERATE_STATUS_DOWN = Goods::OPERATE_STATUS_DOWN;        //下架
    const OPERATE_STATUS_TITLE_CHANGED = Goods::OPERATE_STATUS_TITLE_CHANGED; //标题变更
    const OPERATE_STATUS_PRICE_CHANGED = Goods::OPERATE_STATUS_PRICE_CHANGED; //价格变更
    const OPERATE_STATUS_SKU_CHANGED = Goods::OPERATE_STATUS_SKU_CHANGED; //颜色尺码变更
    const OPERATE_STATUS_PAYED = Order::OPERATE_STATUS_PAYED;      //支付
    const OPERATE_STATUS_SEND = Order::OPERATE_STATUS_SEND;        //发货
    const OPERATE_STATUS_CANCLE = Order::OPERATE_STATUS_CANCEL;    //取消
    const OPERATE_STATUS_CANCEL = Order::OPERATE_STATUS_CANCEL;    //取消
    const OPERATE_STATUS_CLOSED = Order::OPERATE_STATUS_CLOSED;    //关闭
    const OPERATE_STATUS_SHORTAGE = Order::OPERATE_STATUS_SHORTAGE; //订单缺货
    const OPERATE_STATUS_LOGIN = User::OPERATE_STATUS_LOGIN; // 用户登录

    /**
     * 商品埋点接口
     *
     * @param $param
     *
     * @return mixed
     */
    public function goodsPoint($param)
    {
        return $this->batchGoodsPoint([$param]);
    }

    /**
     * 商品埋点接口 批量添加
     *
     * @param $param
     *
     * @return mixed
     */
    public function batchGoodsPoint($param)
    {
        return $this->batchPoint(new Goods($param));
    }

    /**
     * 订单埋点接口
     *
     * @param $param
     *
     * @return mixed
     */
    public function orderPoint($param)
    {
        return $this->batchOrderPoint([$param]);
    }

    /**
     * 订单埋点接口 批量添加
     *
     * @param $param
     *
     * @return mixed
     */
    public function batchOrderPoint($param)
    {
        return $this->batchPoint(new Order($param));
    }

    /**
     * 用户埋点接口
     *
     * @param $param
     *
     * @return bool
     */
    public function userPoint($param)
    {
        return $this->batchUserPoint([$param]);
    }

    /**
     * 用户埋点接口 批量添加
     *
     * @param $param
     *
     * @return bool
     */
    public function batchUserPoint($param)
    {
        return $this->batchPoint(new User($param));
    }

    protected function batchPoint(RequestAbstract $requestAbstract)
    {
        $response = $this->sendRequest($requestAbstract);
        if ($response && $response->getStatusCode() == 200) {
            $result = json_decode($response->getBody()->getContents(), true);
            if ($result && isset($result['code']) && $result['code'] == 0) {
                return true;
            }
        }
        return false;
    }
}
