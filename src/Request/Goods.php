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

class Goods extends RequestAbstract
{
    const OPERATE_STATUS_CREATED = 'CREATED'; // 创建
    const OPERATE_STATUS_UP = 'UP'; // 上架
    const OPERATE_STATUS_DOWN = 'DOWN'; // 下架
    const OPERATE_STATUS_TITLE_CHANGED = 'TITLE_CHANGED'; // 标题变化
    const OPERATE_STATUS_PRICE_CHANGED = 'PRICE_CHANGED'; // 价格变化
    const OPERATE_STATUS_SKU_CHANGED = 'SKU_CHANGED'; // sku变化

    public function getRequestPath()
    {
        return 'data-point/goods';
    }

    public function getParams()
    {
        return [
            'message' => json_encode(parent::getParams()),
        ];
    }
}
