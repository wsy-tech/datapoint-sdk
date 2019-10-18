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

namespace core;


class DataPoint
{
    //操作者
    const OPERATE_TYPE_USER = 'USER';    //用户
    const OPERATE_TYPE_SYSTEM = 'SYSTEM'; //系统

    //操作状态
    const OPERATE_STATUS_CREATED = 'CREATED';  //创建
    const OPERATE_STATUS_SYNC = 'SYNC';        //同步
    const OPERATE_STATUS_UP = 'UP';            //上架
    const OPERATE_STATUS_DOWN = 'DOWN';        //下架


    const OPERATE_STATUS_PAYED = 'PAYED';      //支付
    const OPERATE_STATUS_SEND = 'SEND';        //发货
    const OPERATE_STATUS_CANCLE = 'CANCLE';    //取消
    const OPERATE_STATUS_CLOSED = 'CLOSED';    //关闭


    private $baseUrl = "http://192.168.1.15:9501";//访问数据埋点地址  暂定

    public $connecttimeout = 5;  //连接超时时间


    /**
     * 商品埋点接口
     * @param $param
     * @return mixed
     */
    public function goodsPoint($param)
    {

        $params['message'] = json_encode([$param]);

        $result = $this->sendRequest($this->baseUrl . '/data-point/goods', $params, 'post');

        return $result;
    }

    /**
     * 商品埋点接口 批量添加
     * @param $param
     * @return mixed
     */
    public function batchGoodsPoint($param)
    {

        $params['message'] = json_encode($param);

        $result = $this->sendRequest($this->baseUrl . '/data-point/goods', $params, 'post');

        return $result;
    }


    /**
     * 订单埋点接口
     * @param $param
     * @return mixed
     */
    public function orderPoint($param)
    {

        $params['message'] = json_encode([$param]);
        $result = $this->sendRequest($this->baseUrl . '/data-point/order', $params, 'post');

        return $result;


    }

    /**
     * 订单埋点接口 批量添加
     * @param $param
     * @return mixed
     */
    public function batchOrderPoint($param)
    {

        $params['message'] = json_encode($param);
        $result = $this->sendRequest($this->baseUrl . '/data-point/order', $params, 'post');

        return $result;


    }


    public function sendRequest($url, $params = [], $method = "get")
    {
        $result = $this->getContent($url, $method, $params);
        return $result;
    }

    public function getContent($url, $type, $param = [])
    {

        $ch = curl_init();
        if (isset($param['header']) && $param['header']) {
            curl_setopt($ch, CURLOPT_HTTPHEADER, $param['header']);
        } else if (isset($param['cookie']) && $param['cookie']) {
            curl_setopt($ch, CURLOPT_COOKIE, $param['cookie']);
        }
        $ssl = substr($url, 0, 8) == "https://" ? true : false; // 如果是的话，则不接受证书认证
        if ($ssl) {
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // 不接受证书认证
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2); // 严格检查证书中是否设置域名
        }
        if ($type == 'post') {
            curl_setopt($ch, CURLOPT_POSTFIELDS, $param['post']);
        } else {
            if ($param) {
                $paramStr = http_build_query($param);
                if (!strstr($url, '?')) {
                    $url = $url . '?' . $paramStr;
                } else {
                    $url = $url . '&' . $paramStr;
                }
            }
        }
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $this->connecttimeout);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_AUTOREFERER, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $output1 = curl_exec($ch);
        //$http_status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        $resp = json_decode($output1, true);
        return $resp;

    }

}
