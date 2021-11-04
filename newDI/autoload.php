<?php

if (!defined('APP_SOURCE_PATH')) {
    define('APP_SOURCE_PATH', 'src');
}

class Autoload
{
    private static $isAutoloaded = [];

    /**
     * Autoload constructor.
     * @throws Exception
     */
    public function __construct()
    {
        throw new \Exception("This is singleton");
    }

    /**
     * Register autoload callback
     * @param Callable|null $callback
     */
    public static function registerAutoload(callable $callback = null): void
    {
        $hash = serialize($callback);
        if (!isset(self::$isAutoloaded[$hash])) {
            spl_autoload_register($callback ?: [__CLASS__, 'handle']);
            self::$isAutoloaded[$hash] = true;
        }
    }

    /**
     * @param string $className
     * $className = \MyModule\Repository /MyModule/Repository
     *
     * $classPath = newDi/src/MyModule/Repository.php
     */
    public static function handle(string $className)
    {
//        $srcPath = __DIR__ . DS . APP_SOURCE_PATH . DS . str_replace('\\', DS, $className) . '.php';
//        $generatedPath = __DIR__ . DS . GENERATED_SOURCE_PATH . DS . str_replace('\\', DS, $className) . '.php';
//        $path = file_exists($generatedPath) ? $generatedPath : $srcPath;
        require_once __DIR__ . DS . APP_SOURCE_PATH . DS . str_replace('\\', DS, $className) . '.php';;
    }
}
