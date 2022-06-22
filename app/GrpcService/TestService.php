<?php

namespace App\GrpcService;

use Hi\GrpcServer\Annotation\GrpcService;

/**
 * @GrpcService(name="TestService")
 */
class TestService
{
    public function add()
    {
        return [];
    }

}
