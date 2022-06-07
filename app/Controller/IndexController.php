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
use HiGrpc\User;
use HiGrpc\UserListReply;
use HiGrpc\UserListRequest;
use HiGrpc\UserReply;
use HiGrpc\UserRequest;
use HiGrpc\UserServiceClient;
use Hyperf\HttpServer\Annotation\AutoController;

/**
 * @AutoController
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
//        $client = new UserServiceClient('hi-grpc:9503', [
//
//        ]);
        $request = new UserRequest([
            'id' => 10086,
        ]);
        /**
         * @var UserReply $message
         */
        [$message, $status] = $client->getUser($request);
        $result = json_decode($message->getResult()->serializeToJsonString(), true);
        $data = json_decode($message->getData()->serializeToJsonString(), true);
        return compact('data', 'status', 'result');
    }

    public function userList()
    {
        $client = new UserClient('192.168.31.9:9503', [
            'credentials' => null,
        ]);
        $request = new UserListRequest([
            'username' => '',
            'name' => '',
            'page' => 1,
            'size' => 10,
        ]);
        /**
         * @var UserListReply $message
         */
        [$message, $status] = $client->getUserList($request);
        $result = json_decode($message->getResult()->serializeToJsonString(), true);
        $data = json_decode($message->getData()->serializeToJsonString(), true);
        return compact('data', 'status', 'result');
    }
}
