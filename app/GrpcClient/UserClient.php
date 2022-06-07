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

use Grpc\UserListReply;
use Grpc\UserListRequest;
use Grpc\UserReply;
use Grpc\UserRequest;
use Hyperf\GrpcClient\BaseClient;

class UserClient extends BaseClient
{
    public function getUser(UserRequest $request)
    {
        return $this->_simpleRequest(
            '/grpc.user/getUser',
            $request,
            [UserReply::class, 'decode']
        );
    }

    public function getUserList(UserListRequest $request)
    {
        return $this->_simpleRequest(
            '/grpc.user/getUserList',
            $request,
            [UserListReply::class, 'decode']
        );
    }
}
