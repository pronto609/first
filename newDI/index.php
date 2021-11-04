<?php
define("APP_SOURCE_PATH",'src');
define('DS', DIRECTORY_SEPARATOR);
define('BASE_DIR', __DIR__);
require_once __DIR__ . '/autoload.php';
Autoload::registerAutoload();
$objectManager = \Framework\ObjectManager::getInstance();
$objectManager->create(\MyModule\Repository::class);
