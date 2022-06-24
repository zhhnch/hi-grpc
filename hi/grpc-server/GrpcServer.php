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
namespace Hi\GrpcServer;

use Hyperf\ExceptionHandler\ExceptionHandlerDispatcher;
use Hyperf\HttpServer\Contract\CoreMiddlewareInterface;
use Hyperf\HttpServer\ResponseEmitter;
use Hyperf\HttpServer\Server;
use Hyperf\Rpc\Protocol;
use Hyperf\Rpc\ProtocolManager;
use Hyperf\RpcServer\RequestDispatcher;
use Hyperf\HttpServer\Router\DispatcherFactory;
use Psr\Container\ContainerInterface;
use Hyperf\RpcServer\CoreMiddleware;

class GrpcServer extends Server
{
    protected Protocol $protocol;

    public function __construct(
        ContainerInterface $container,
        RequestDispatcher $dispatcher,
        ExceptionHandlerDispatcher $exceptionHandlerDispatcher,
        ResponseEmitter $responseEmitter,
        ProtocolManager $protocolManager
    ) {
        parent::__construct($container, $dispatcher, $exceptionHandlerDispatcher, $responseEmitter);
        $this->protocol = new Protocol($container, $protocolManager, 'grpc');
    }

    protected function createCoreMiddleware(): CoreMiddlewareInterface
    {
        return new GrpcCoreMiddleware($this->container, $this->protocol, 'grpc');
    }
}
