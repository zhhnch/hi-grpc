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

/**
 * @RpcService(name="AppService", protocol="jsonrpc-http", server="jsonrpc-http", publishTo="consul")
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
        return [
            'method' => 'detail',
        ];
    }

    public function update(string $appId, array $request)
    {
        return [
            'method' => 'update',
        ];
    }
}
