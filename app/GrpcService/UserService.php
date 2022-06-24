<?php

namespace App\GrpcService;

use HiGrpc\Result;
use HiGrpc\User;
use HiGrpc\UserList;
use HiGrpc\UserListReply;
use HiGrpc\UserListRequest;
use HiGrpc\UserReply;
use HiGrpc\UserRequest;
use Hyperf\RpcServer\Annotation\RpcService;

/**
 * @RpcService(name="HiGrpc.UserService", server="grpc", protocol="grpc")
 */
class UserService
{
    public function EmptyUser(\Google\Protobuf\GPBEmpty $argument): ?Result
    {
        var_dump("=== EmptyUser ===");
        return new Result([
            'success' => true,
            'code' => '0000',
            'message' => 'success',
        ]);
    }

    public function getUser(UserRequest $request): ?UserReply
    {
        $userId = $request->getId();
        $user = new User([
            'id' => $userId,
            'username' => 'admin',
            'name' => 'Administrator',
        ]);

        $result = new Result([
            'success' => true,
            'code' => '0000',
            'message' => 'success',
        ]);

        return new UserReply([
            'data' => $user,
            'result' => $result,
        ]);
    }

    public function getUserList(UserListRequest $request): ?UserListReply
    {
        $dataList = array_map(
            fn ($u) => new User($u),
            [
                [
                    'id' => 1,
                    'name' => 'Administrator',
                    'username' => 'admin',
                ],
                [
                    'id' => 2,
                    'name' => 'Super Admin',
                    'username' => 'root',
                ],
            ]
        );

        $list = new UserList([
            'size' => 100,
            'count' => 10086,
            'list' => $dataList,
        ]);

        $result = new Result([
            'success' => true,
            'code' => '0000',
            'message' => 'success',
        ]);

        return new UserListReply([
            'data' => $list,
            'result' => $result,
        ]);
    }
}