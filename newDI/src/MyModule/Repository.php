<?php
namespace MyModule;

use MyModule\SqlAdapter;

class Repository
{
    /**
     * @var $sqlAdapter
     */
    private $sqlAdapter;

    public function __construct(SqlAdapter $sqlAdapter){
        $this->sqlAdapter = $sqlAdapter;
    }
}
