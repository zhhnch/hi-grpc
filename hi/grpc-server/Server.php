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

use Hi\GrpcServer\Annotation\GrpcService;
use Hyperf\Contract\ConfigInterface;
use Hyperf\Di\Annotation\AnnotationCollector;
use Hyperf\GrpcServer\CoreMiddleware;
use Hyperf\GrpcServer\Exception\Handler\GrpcExceptionHandler;
use Hyperf\HttpServer\Server as HttpServer;

class Server extends HttpServer
{
    public function initCoreMiddleware(string $serverName): void
    {
        $this->serverName = $serverName;
        $this->coreMiddleware = new CoreMiddleware($this->container, $serverName);

        // custom
        $this->initAnnotationRoute(AnnotationCollector::list());
        // end custom

        $config = $this->container->get(ConfigInterface::class);
        $this->middlewares = $config->get('middlewares.' . $serverName, []);
        $this->exceptionHandlers = $config->get('exceptions.handler.' . $serverName, [
            GrpcExceptionHandler::class,
        ]);
    }

    private function initAnnotationRoute(array $collector): void
    {
        foreach ($collector as $className => $metadata) {
            if (isset($metadata['_c'][GrpcService::class])) {
                $middlewares = $this->handleMiddleware($metadata['_c']);
                $this->handleRpcService($className, $metadata['_c'][GrpcService::class], $metadata['_m'] ?? [], $middlewares);
            }
        }
    }

    private function handleMiddleware(array $metadata): array
    {
        var_dump($metadata);
        return [];
    }

    private function handleRpcService(
        string $className,
        GrpcService $annotation,
        array $methodMetadata,
        array $middlewares = []
    ) {
        var_dump($className, $methodMetadata);
    }
}
