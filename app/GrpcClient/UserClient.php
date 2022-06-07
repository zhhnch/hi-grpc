<?php

declare(strict_types=1);
/**
 * This file is part of Hyperf.
 *
 * @link     https://www.hyperf.io
 * @document https://hyperf.wiki
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf/hyperf/blob/master/LICENSE
 */
namespace App\GrpcClient;

use HiGrpc\UserListRequest;
use HiGrpc\UserRequest;
use Hyperf\GrpcClient\BaseClient;

class UserClient extends BaseClient
{
    /**
     * @param \HiGrpc\UserListRequest $argument input argument
     * @param array $metadata metadata
     * @param array $options call options
     */
    public function getUserList(UserListRequest $argument, $metadata = [], $options = [])
    {
        return $this->_simpleRequest(
            '/HiGrpc.UserService/getUserList',
            $argument,
            ['\HiGrpc\UserListReply', 'decode'],
            $metadata,
            $options
        );
    }

    /**
     * @param \HiGrpc\UserRequest $argument input argument
     * @param array $metadata metadata
     * @param array $options call options
     */
    public function getUser(UserRequest $argument, $metadata = [], $options = [])
    {
        return $this->_simpleRequest(
            '/HiGrpc.UserService/getUser',
            $argument,
            ['\HiGrpc\UserReply', 'decode'],
            $metadata,
            $options
        );
    }
}
