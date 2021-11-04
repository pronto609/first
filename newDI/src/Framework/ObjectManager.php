<?php

namespace Framework;

class ObjectManager
{
    private const FILE_NAME = 'dependency_injection.xml';
    /**
     * @var $instance
     */
    private static $instance;

    private $constructDefinitionReader;
    /**
     * @param ConstructDefinitionReader $constructDefinitionReader
     */

    /**
     * @var array
     */
    private $createionStack;

    private function __construct(ConstructDefinitionReader $constructDefinitionReader)
    {
        //Make onstructor private in order to instantioate singelton onli one time
        $this->constructDefinitionReader = $constructDefinitionReader;
    }

    /**
     * @return array
     */
     private function getArguments():array
     {
        $xmlReader = new XmlReader();
        return $xmlReader->read(self::FILE_NAME);
     }

    /**
     * @return static
     */
    public static function getInstance(): self
    {
        //self - current classes + children clases
        //static - current class
        if (!self::$instance instanceof self) {
            $defineReader = new ConstructDefinitionReader();
            self::$instance = new self($defineReader);
        }
        return self::$instance;
    }

    /**
     * @param string $className
     * @return object
     */
    public function create(string $className): object
    {
        $aditionalArguments = $this->getArguments();
        var_dump($aditionalArguments);
        $parameters = $this->constructDefinitionReader->read($className);
        $stack = [];

        $this->createionStack[$className] = true;
        foreach($parameters as $argumentName => $type){
            if (in_array($type, $stack)){
                throw new \Exception('Mistake of Bogdan');
            }
            $stack[] = $this->create($type);

        }

        unset($this->createionStack[$className]);

        return new $className(...$stack);
    }


}
