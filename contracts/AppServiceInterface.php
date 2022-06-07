<?php

namespace Contracts;

interface AppServiceInterface
{

    public function add(array $request);

    public function detail(string $appId);

    public function update(string $appId, array $request);

}
