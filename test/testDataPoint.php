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

use WsySDK\DataPoint\DataPoint;
use WsySDK\DataPoint\Request\Goods;

require_once __DIR__ . '/../vendor/autoload.php';

$uri = 'http://localhost:9501';
$token = 'a6a5fcdb6dd7d4f42724e7ee4cb694aa';

$client = new DataPoint($uri, $token);
$result = $client->goodsPoint([
    'goods_id' => mt_rand(1000, 9999),
    'operate_type' => Goods::OPERATE_TYPE_USER,
    'operate_status' => Goods::OPERATE_STATUS_CREATED,
    'operate_user_id' => mt_rand(10000, 99999),
    'operate_reason' => '手动发布',
]);
var_dump($result);
