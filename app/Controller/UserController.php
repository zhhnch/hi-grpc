<?php

declare(strict_types=1);

namespace App\Controller;

use Grpc\Reply;
use Grpc\User;
use Grpc\UserList;
use Grpc\UserListReply;
use Grpc\UserListRequest;
use Grpc\UserReply;
use Grpc\UserRequest;
use Hyperf\HttpServer\Contract\RequestInterface;
use Hyperf\HttpServer\Contract\ResponseInterface;

class UserController
{
    public function getUser(UserRequest $request)
    {
        $userId = $request->getId();
        $user = new User();
        $user->setId($userId);
        $user->setName("Administrator");
        $user->setUsername("admin");

        $result = new Reply();
        $result->setCode("0000");
        $result->setMessage("success");

        $return = new UserReply();
        $return->setData($user);
        $return->setResult($result);
        return $return;
    }

    public function getUserList(UserListRequest $request)
    {
        $list = new UserList();

        $user = new User();
        $user->setId(1);
        $user->setName("Administrator");
        $user->setUsername("admin");

        $user2 = new User();
        $user2->setId(2);
        $user2->setName("SuperAdmin");
        $user2->setUsername("root");

        $list->setList([
            $user,
            $user2
        ]);
        $list->setSize(10);
        $list->setCount(100);

        $result = new Reply();
        $result->setCode("0000");
        $result->setMessage("success");

        $reply = new UserListReply();
        $reply->setData($list);
        $reply->setResult($result);
        return $reply;
    }
}
