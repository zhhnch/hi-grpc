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
namespace HiGrpc;

use Hyperf\GrpcClient\BaseClient;

class UserServiceClient extends BaseClient
{
    /**
     * @param string $hostname hostname
     * @param array $opts channel options
     * @param \Grpc\Channel $channel (optional) re-use channel object
     */
    public function __construct($hostname, $opts, $channel = null)
    {
        parent::__construct($hostname, $opts, $channel);
    }

    /**
     * @param \HiGrpc\UserListRequest $argument input argument
     * @param array $metadata metadata
     * @param array $options call options
     */
    public function getUserList(
        UserListRequest $argument,
        $metadata = [],
        $options = []
    )
    {
        return $this->_simpleRequest(
            '/HiGrpc.UserService/getUserList',
            $argument,
            ['\HiGrpc\UserListReply', 'decode'],
            $metadata,
            $options
        );
    }

    /**
     * @param \HiGrpc\UserRequest $argument input argument
     * @param array $metadata metadata
     * @param array $options call options
     */
    public function getUser(
        UserRequest $argument,
        $metadata = [],
        $options = []
    )
    {
        return $this->_simpleRequest(
            '/HiGrpc.UserService/getUser',
            $argument,
            ['\HiGrpc\UserReply', 'decode'],
            $metadata,
            $options
        );
    }

    /**
     * @param \Google\Protobuf\GPBEmpty $argument input argument
     * @param array $metadata metadata
     * @param array $options call options
     */
    public function EmptyUser(
        \Google\Protobuf\GPBEmpty $argument,
        $metadata = [],
        $options = []
    )
    {
        return $this->_simpleRequest(
            '/HiGrpc.UserService/EmptyUser',
            $argument,
            ['\HiGrpc\Result', 'decode'],
            $metadata,
            $options
        );
    }
}
