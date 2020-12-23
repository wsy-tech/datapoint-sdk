<?php

declare(strict_types=1);

namespace WsySDK\DataPoint\Request;

use WsySDK\DataPoint\RequestAbstract;

class User extends RequestAbstract
{
    const OPERATE_STATUS_LOGIN = 'LOGIN'; // 用户登录

    public function getRequestPath()
    {
        return 'data-point/user';
    }

    public function getParams()
    {
        return [
            'message' => json_encode(parent::getParams()),
        ];
    }
}
