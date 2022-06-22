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
use Hyperf\ConfigCenter\Mode;

return [
    'enable' => (bool) env('CONFIG_CENTER_ENABLE', true),
    'driver' => env('CONFIG_CENTER_DRIVER', 'nacos'),
    'mode' => env('CONFIG_CENTER_MODE', Mode::PROCESS),
    'drivers' => [
        'nacos' => [
            'driver' => Hyperf\ConfigNacos\NacosDriver::class,
            'merge_mode' => Hyperf\ConfigNacos\Constants::CONFIG_MERGE_OVERWRITE,
            'interval' => 3,
            'default_key' => 'hi_grpc_server',
            'listener_config' => [
                'hi_grpc_server' => [
                    'tenant' => 'public',
                    'data_id' => 'HI_GRPC_SERVER',
                    'group' => 'HI_GRPC_GROUP',
                    'type' => 'json',
                ],
                // dataId, group, tenant, type, content
                // 'nacos_config' => [
                //     'tenant' => 'tenant', // corresponding with service.namespaceId
                //     'data_id' => 'hyperf-service-config',
                //     'group' => 'DEFAULT_GROUP',
                // ],
                // 'nacos_config.data' => [
                //     'data_id' => 'hyperf-service-config-yml',
                //     'group' => 'DEFAULT_GROUP',
                //     'type' => 'yml',
                // ],
            ],
            'client' => [
                // nacos server url like https://nacos.hyperf.io, Priority is higher than host:port
                // 'uri' => '',
                'host' => 'nacos',
                'port' => 8848,
                'username' => 'nacos',
                'password' => 'nacos',
                'guzzle' => [
                    'config' => null,
                ],
            ],
        ],
    ],
];
