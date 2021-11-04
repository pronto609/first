<?php

namespace Framework;

interface DefinitionReaderInterface
{
    /**
     * @param string $className
     * @return array
     */
    public function read(string $className): array;
}



