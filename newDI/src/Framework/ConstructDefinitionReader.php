<?php
namespace Framework;
use Framework\DefinitionReaderInterface;
class ConstructDefinitionReader implements DefinitionReaderInterface
{
    /**
     * @param string $className
     * @return array
     *
     * [
     * name=> type,
     * name1=>type1
     */
    public function read(string $className): array
    {
        $result = [];
        $reflection = new \ReflectionClass($className);
        $constructor = $reflection->getConstructor();
        if(!$constructor){
            return $result;
        }
        $constructorParameters = $constructor->getParameters();


        foreach ($constructorParameters as $constructorParameter){

            var_dump($constructorParameter->getType());

            if ($constructorParameter->getType()->isBuiltin()) {
                //XML
            }else{
                $result[$constructorParameter->getName()] = $constructorParameter->getClass()->getName();
            }


        }
        return $result;
    }
}
