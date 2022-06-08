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

use Contracts\AppServiceInterface;
use Hyperf\Di\Annotation\Inject;
use Hyperf\HttpServer\Annotation\AutoController;
use Hyperf\HttpServer\Contract\RequestInterface;
use Hyperf\HttpServer\Contract\ResponseInterface;
use Hyperf\ServiceGovernance\IPReaderInterface;
use Hyperf\ServiceGovernance\ServiceManager;
use Hyperf\ServiceGovernanceConsul\ConsulAgent;
use Hyperf\Utils\ApplicationContext;

/**
 * @AutoController
 */
class ConsumerController
{
    /**
     * @Inject
     */
    protected AppServiceInterface $service;

    public function detail(RequestInterface $request, ResponseInterface $response)
    {
        return $this->service->detail('12345');
    }

    public function services()
    {
        $container = ApplicationContext::getContainer();
        $serviceManager = $container->get(ServiceManager::class);
        $services = $serviceManager->all();
        $container = ApplicationContext::getContainer();
        $ipReader = $container->get(IPReaderInterface::class);
        $host = $ipReader->read();

        $consul = $container->get(ConsulAgent::class);
        $svc = $consul->services()->json();
        return compact('services', 'host', 'svc');
    }
}
