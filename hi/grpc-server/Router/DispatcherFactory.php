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
namespace Hi\GrpcServer\Router;

use FastRoute\DataGenerator\GroupCountBased as DataGenerator;
use FastRoute\Dispatcher;
use FastRoute\Dispatcher\GroupCountBased;
use FastRoute\RouteParser\Std;
use Hi\GrpcServer\Annotation\GrpcService;
use Hyperf\Di\Annotation\AnnotationCollector;
use Hyperf\Di\ReflectionManager;
use Hyperf\HttpServer\Router\RouteCollector;
use ReflectionMethod;

class DispatcherFactory
{
    protected $routes = [BASE_PATH . '/config/services.php'];

    /**
     * @var RouteCollector[]
     */
    private $routers = [];

    /**
     * @var Dispatcher[]
     */
    private $dispatchers = [];

    public function __construct()
    {
        $this->initAnnotationRoute(AnnotationCollector::list());
        $this->initConfigRoute();
    }

    public function initConfigRoute()
    {
        Router::init($this);
        foreach ($this->routes as $route) {
            if (file_exists($route)) {
                require_once $route;
            }
        }
    }

    public function getDispatcher(string $serverName): Dispatcher
    {
        if (isset($this->dispatchers[$serverName])) {
            return $this->dispatchers[$serverName];
        }

        $router = $this->getRouter($serverName);
        return $this->dispatchers[$serverName] = new GroupCountBased($router->getData());
    }

    public function getRouter(string $serverName): RouteCollector
    {
        if (isset($this->routers[$serverName])) {
            return $this->routers[$serverName];
        }

        $parser = new Std();
        $generator = new DataGenerator();
        return $this->routers[$serverName] = new RouteCollector($parser, $generator, $serverName);
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
//        var_dump($metadata);
        return [];
    }

    private function handleRpcService(
        string $className,
        GrpcService $annotation,
        array $methodMetadata,
        array $middlewares = []
    ) {
//        var_dump($className, $methodMetadata);
        $prefix = $annotation->name ?: $className;
        $server = $annotation->server;
        $publicMethods = ReflectionManager::reflectClass($className)->getMethods(ReflectionMethod::IS_PUBLIC);
        $router = $this->getRouter($server);
        foreach ($publicMethods as $reflectionMethod) {
            $methodName = $reflectionMethod->getName();
            var_dump(
                json_encode(compact('server', 'prefix', 'className', 'methodName'))
            );
            $path = "{$prefix}/{$methodName}";
            $router->addRoute('POST', $path, [
                $className,
                $methodName,
            ]);
        }
        var_dump(json_encode($router->getData()));

    }
}
