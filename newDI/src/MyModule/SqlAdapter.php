<?php

namespace MyModule;


use NyModule\DbAdapterInterface;

class SqlAdapter implements DbAdapterInterface
{
    public function __construct(string $connection){

    }


    public function read(): array
    {

    }


    public function update(): int
    {
        // TOO::
    }


    public function delete(): int
    {

    }


    public function crate(): int
    {
        // TODO: Implement crate() method.
    }
}
