<?php

namespace App\GrpcClient;

use Grpc\User;
use Grpc\UserListReply;
use Grpc\UserListRequest;
use Grpc\UserReply;
use Grpc\UserRequest;
use \Hyperf\GrpcClient\BaseClient;

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