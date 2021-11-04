<?php

namespace NyModule;

interface DbAdapterInterface
{
     public function crate(): int;
     public function read(): array;

    /**
     * @return int
     */
     public function update(): int;

    /**
     * @return int
     */
    public function delete(): int;

}
