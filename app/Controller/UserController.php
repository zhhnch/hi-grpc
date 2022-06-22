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
namespace App\Controller;

use HiGrpc\Result;
use HiGrpc\User;
use HiGrpc\UserList;
use HiGrpc\UserListReply;
use HiGrpc\UserListRequest;
use HiGrpc\UserReply;
use HiGrpc\UserRequest;

class UserController
{
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
