<?php
// GENERATED CODE -- DO NOT EDIT!

namespace HiGrpc;

/**
 */
class UserServiceClient extends \Grpc\BaseStub {

    /**
     * @param string $hostname hostname
     * @param array $opts channel options
     * @param \Grpc\Channel $channel (optional) re-use channel object
     */
    public function __construct($hostname, $opts, $channel = null) {
        parent::__construct($hostname, $opts, $channel);
    }

    /**
     * @param \HiGrpc\UserListRequest $argument input argument
     * @param array $metadata metadata
     * @param array $options call options
     */
    public function getUserList(\HiGrpc\UserListRequest $argument,
      $metadata = [], $options = []) {
        return $this->_simpleRequest('/HiGrpc.UserService/getUserList',
        $argument,
        ['\HiGrpc\UserListReply', 'decode'],
        $metadata, $options);
    }

    /**
     * @param \HiGrpc\UserRequest $argument input argument
     * @param array $metadata metadata
     * @param array $options call options
     */
    public function getUser(\HiGrpc\UserRequest $argument,
      $metadata = [], $options = []) {
        return $this->_simpleRequest('/HiGrpc.UserService/getUser',
        $argument,
        ['\HiGrpc\UserReply', 'decode'],
        $metadata, $options);
    }

}
