<?php

namespace Drewlabs\Txn\TMoney\Tests\Stubs;

interface Callback
{
    public function __invoke(...$args);
}