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
namespace App\GrpcService;

use Hi\GrpcServer\Annotation\GrpcService;

/**
 * @GrpcService(name="/HiGrpc.Calc", server="grpc", protocol="grpc")
 */
class GrpcCalcService
{
    public function TestAdd(): ?array
    {
        var_dump("---- GrpcCalcService::TestAdd ----");
        return [];
    }

    public function TestMinus(): ?array
    {
        var_dump("---- GrpcCalcService::TestMinus ----");
        return [];
    }

    public function TestMulti(): array
    {
        var_dump("---- GrpcCalcService::TestMulti ----");
        return [];
    }
}
