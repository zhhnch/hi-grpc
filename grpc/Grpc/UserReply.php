<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: user.proto

namespace Grpc;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Generated from protobuf message <code>grpc.UserReply</code>
 */
class UserReply extends \Google\Protobuf\Internal\Message
{
    /**
     * Generated from protobuf field <code>.grpc.Result result = 1;</code>
     */
    private $result = null;
    /**
     * Generated from protobuf field <code>.grpc.User data = 2;</code>
     */
    private $data = null;

    /**
     * Constructor.
     *
     * @param array $data {
     *     Optional. Data for populating the Message object.
     *
     *     @type \Grpc\Result $result
     *     @type \Grpc\User $data
     * }
     */
    public function __construct($data = NULL) {
        \GPBMetadata\User::initOnce();
        parent::__construct($data);
    }

    /**
     * Generated from protobuf field <code>.grpc.Result result = 1;</code>
     * @return \Grpc\Result
     */
    public function getResult()
    {
        return $this->result;
    }

    /**
     * Generated from protobuf field <code>.grpc.Result result = 1;</code>
     * @param \Grpc\Result $var
     * @return $this
     */
    public function setResult($var)
    {
        GPBUtil::checkMessage($var, \Grpc\Result::class);
        $this->result = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>.grpc.User data = 2;</code>
     * @return \Grpc\User
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * Generated from protobuf field <code>.grpc.User data = 2;</code>
     * @param \Grpc\User $var
     * @return $this
     */
    public function setData($var)
    {
        GPBUtil::checkMessage($var, \Grpc\User::class);
        $this->data = $var;

        return $this;
    }

}

