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
namespace App\JsonRpc;

use Contracts\AppServiceInterface;
use Hyperf\RpcServer\Annotation\RpcService;
use Hyperf\ServiceGovernance\ServiceManager;
use Hyperf\Utils\ApplicationContext;

/**
 * @RpcService(name="AppService", protocol="jsonrpc-http", server="jsonrpc-http")
 */
class AppService implements AppServiceInterface
{
    public function add(array $request)
    {
        return [
            'method' => 'add',
        ];
    }

    public function detail(string $appId)
    {
        $container = ApplicationContext::getContainer();
        $serviceManager = $container->get(ServiceManager::class);
        $services = $serviceManager->all();
        return compact('services');
    }

    public function update(string $appId, array $request)
    {
        return [
            'method' => 'update',
        ];
    }
}
