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
use HiGrpc\UserListReply;
use HiGrpc\UserListRequest;
use HiGrpc\UserReply;
use HiGrpc\UserRequest;
use HiGrpc\UserServiceClient;
use Hyperf\Contract\ConfigInterface;
use Hyperf\Consul\Agent;
use Hyperf\Di\Annotation\Inject;
use Hyperf\Guzzle\ClientFactory;
use Hyperf\HttpServer\Annotation\AutoController;
use Hyperf\Utils\ApplicationContext;

/**
 * @AutoController
 */
class IndexController extends AbstractController
{
    /**
     * @Inject
     */
    protected ConfigInterface $config;

    public function index()
    {
        $user = $this->request->input('user', 'Hyperf');
        $method = $this->request->getMethod();

        return [
            'method' => $method,
            'message' => "Hello {$user}.",
        ];
    }

    public function config()
    {
        $key = $this->request->input('key', '');
        $config = $this->config->get($key, '');
        return [
            'config' => $config,
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

    public function services()
    {
        $container = ApplicationContext::getContainer();
        $clientFactory = $container->get(ClientFactory::class);
        $agent = new Agent(function () use ($clientFactory) {
            return $clientFactory->create([
                'base_uri' => config('consul.uri'),
                'headers' => [
                    'Accept' => 'application/json',
                ],
            ]);
        });
        $services = $agent->services();
        return [
            'services' => $services->json(),
        ];
    }

    public function register()
    {
        $container = ApplicationContext::getContainer();
        $clientFactory = $container->get(ClientFactory::class);
        $agent = new Agent(function () use ($clientFactory) {
            return $clientFactory->create([
                'base_uri' => config('consul.uri'),
                'headers' => [
                    'Accept' => 'application/json',
                ],
            ]);
        });
        $res = $agent->registerService([
            'name' => 'HiGrpc',
            'id' => 'HiGrpc',
            'port' => 9503,
            'tags' => ['HiGrpc'],
        ]);
        return [
            'res' => $res->getBody()->getContents(),
            'status' => $res->getStatusCode(),
        ];
    }

    public function down()
    {
        $id = $this->request->input('id', 'HiGrpc');
        $container = ApplicationContext::getContainer();
        $clientFactory = $container->get(ClientFactory::class);
        $agent = new Agent(function () use ($clientFactory) {
            return $clientFactory->create([
                'base_uri' => config('consul.uri'),
                'headers' => [
                    'Accept' => 'application/json',
                ],
            ]);
        });
        $res = $agent->deregisterService($id);
        return [
            'res' => $res->getBody()->getContents(),
            'status' => $res->getStatusCode(),
        ];
    }
}
