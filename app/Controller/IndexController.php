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

use App\GrpcClient\UserClient;
use Grpc\User;
use Grpc\UserListReply;
use Grpc\UserListRequest;
use Grpc\UserReply;
use Grpc\UserRequest;
use Hyperf\HttpServer\Annotation\AutoController;

/**
 * @AutoController()
 */
class IndexController extends AbstractController
{
    public function index()
    {
        $user = $this->request->input('user', 'Hyperf');
        $method = $this->request->getMethod();

        return [
            'method' => $method,
            'message' => "Hello {$user}.",
        ];
    }

    public function user()
    {
        $client = new UserClient('hi-grpc:9503', [
            'credentials' => null,
        ]);
        $request = new UserRequest();
        $request->setId(10086);
        /**
         * @type UserReply $message
         */
        list($message, $status) = $client->getUser($request);
        $userMsg = $message->getData();
        $user = [
            'id' => $userMsg->getId(),
            'name' => $userMsg->getName(),
            'username' => $userMsg->getUsername(),
        ];
        return compact('user', 'status');
    }

    public function userList()
    {
        $client = new UserClient('hi-grpc:9503', [
            'credentials' => null,
        ]);
        $request = new UserListRequest();
        $request->setUsername("");
        $request->setName("");
        $request->setPage(1);
        $request->setSize(10);
        /**
         * @type UserListReply $message
         */
        list($message, $status) = $client->getUserList($request);
        $msg = $message->getData();
        $result = $message->getResult();
        $userList = $msg->getList();
//        return ['result' => true];
//        $iterator = $userList->getIterator();
        $list = [];

        /**
         * @type User $user
         */
        foreach($userList as $user){
            $list[] = [
                'id' => $user->getId(),
                'name' => $user->getName(),
                'username' => $user->getUsername(),
            ];
        }
        $code = $result->getCode();
        return compact('list', 'status', 'code');
    }
}
