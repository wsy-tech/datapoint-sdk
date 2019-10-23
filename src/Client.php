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

use Psr\Http\Message\ResponseInterface;

class Client
{
    /**
     * @var \GuzzleHttp\Client
     */
    protected $client;
    /** @var string */
    protected $token;

    public function __construct($uri, $token, $timeout = 0.5)
    {
        $this->token = $token;
        $this->client = new \GuzzleHttp\Client([
            'base_uri' => $uri,
            'timeout' => $timeout,
        ]);
    }

    /**
     * @param RequestAbstract $request
     * @return ResponseInterface|null
     */
    public function sendRequest(RequestAbstract $request)
    {
        try {
            $params = $request->getParams();
            $sign = Sign::sign($params, $this->token);
            $params['sign'] = $sign;
            $response = $this->client->post($request->getRequestPath(), [
                'form_params' => $params,
                'http_errors' => false,
                'verify' => false,
            ]);
            return $response;
        } catch (\Exception $e) {
            return null;
        }
    }
}
