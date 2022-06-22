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
return [
    'enable' => [
        'discovery' => true,
        'register' => true,
    ],
    'consumers' => [
        [
            'name' => 'AppService',
            'service' => Contracts\AppServiceInterface::class,
            'id' => Contracts\AppServiceInterface::class,
            'protocol' => 'jsonrpc-http',
            'load_balancer' => 'random',
            'registry' => [
                'protocol' => 'consul',
                'address' => 'http://consul:8500',
            ],
        ],
    ],
    'providers' => [],
    'drivers' => [
        'consul' => [
            'uri' => 'http://consul:8500',
            'token' => '',
            'check' => [
                'deregister_critical_service_after' => '90m',
                'interval' => '1s',
            ],
        ],
        'nacos' => [
            // nacos server url like https://nacos.hyperf.io, Priority is higher than host:port
            // 'url' => '',
            // The nacos host info
            'host' => 'nacos',
            'port' => 8848,
            // The nacos account info
            'username' => 'nacos',
            'password' => 'nacos',
            'guzzle' => [
                'config' => null,
            ],
            'group_name' => 'api',
            'namespace_id' => 'namespace_id',
            'heartbeat' => 5,
            'ephemeral' => false,
        ],
    ],
];
