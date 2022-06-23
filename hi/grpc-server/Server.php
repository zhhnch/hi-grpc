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

use FastRoute\Dispatcher;
use Hi\GrpcServer\Annotation\GrpcService;
use Hi\GrpcServer\Router\DispatcherFactory;
use Hyperf\Contract\ConfigInterface;
use Hyperf\Di\Annotation\AnnotationCollector;
use Hyperf\Di\ReflectionManager;
use Hyperf\GrpcServer\CoreMiddleware;
use Hyperf\GrpcServer\Exception\Handler\GrpcExceptionHandler;
use Hyperf\HttpServer\Server as HttpServer;
use ReflectionMethod;

class Server extends HttpServer
{

    protected function createDispatcher(string $serverName): Dispatcher
    {
        $factory = $this->container->get(DispatcherFactory::class);
        return $factory->getDispatcher($serverName);
    }


}
