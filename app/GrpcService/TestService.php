<?php

namespace App\GrpcService;

use Hi\GrpcServer\Annotation\GrpcService;

/**
 * @GrpcService(name="HiGrpc.Test")
 */
class TestService
{
    public function add()
    {
        return [];
    }

    public function sub()
    {
        return [];
    }

}
