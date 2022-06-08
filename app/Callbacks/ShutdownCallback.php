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
namespace App\Callbacks;

use Hyperf\Consul\Agent;
use Hyperf\Guzzle\ClientFactory;
use Hyperf\ServiceGovernance\DriverManager;
use Hyperf\ServiceGovernance\IPReaderInterface;
use Hyperf\ServiceGovernance\ServiceManager;
use Hyperf\ServiceGovernanceConsul\ConsulAgent;
use Hyperf\Utils\ApplicationContext;

class ShutdownCallback
{
    protected $consul;

    protected $serviceManager;

    protected $ipReader;

    protected $governanceManager;


    public function __construct()
    {
        $container = ApplicationContext::getContainer();

        $this->serviceManager = $container->get(ServiceManager::class);

        $this->ipReader = $container->get(IPReaderInterface::class);

        $this->consul = $container->get(ConsulAgent::class);

        $this->governanceManager = $container->get(DriverManager::class);
    }

    public function onShutdown($server)
    {
//        $services = $this->serviceManager->all();
//        foreach ($services as $serviceName => $serviceProtocols) {
//            foreach ($serviceProtocols as $paths) {
//                foreach ($paths as $service) {
//                    if (! isset($service['publishTo'], $service['server'])) {
//                        continue;
//                    }
//                    if ($governance = $this->governanceManager->get($service['publishTo'])) {
//
//                    }
//                }
//            }
//        }

//        $ref = new \ReflectionClass($server);
//        $methods = $ref->getMethods();
//        $properties = $ref->getProperties();
//        $container = ApplicationContext::getContainer();
//        $container->get(IPReaderInterface::class);
        $host = $this->ipReader->read();
        $services = $this->consul->services()->json() ?? [];
        foreach ($services as $id => $service) {
            if ($service['Address'] === $host) {
                $this->consul->deregisterService($id);
            }
        }
//        var_dump($methods);
//        var_dump($properties);
//        $clientFactory = $container->get(ClientFactory::class);
//        $agent = new Agent(function () use ($clientFactory) {
//            return $clientFactory->create([
//                'base_uri' => config('consul.uri'),
//                'headers' => [
//                    'Accept' => 'application/json',
//                ],
//            ]);
//        });
//        $agent->deregisterService('AppService-0');
    }
}
