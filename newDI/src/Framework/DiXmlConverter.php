<?php

namespace Framework;
include('XmlConverterInterface.php');
class DiXmlConverter implements XmlConverterInterface
{
    private const CLASS_NODE = 'class';
    private const ARGUMENTS_NODE = 'arguments';
    private const ARGUMENT_NODE = 'argument';
    private const ATTRIBUTE_ID_KEY = 'name';


    /**
     * @param \SimpleXMLElement $simpleXMLElement
     * @return array
     */
    public function convert(\SimpleXMLElement $simpleXMLElement): array
    {
        $result = [];
        foreach ($simpleXMLElement->children() as $child){

            $attributes = (array) $child->attributes()[self::ATTRIBUTE_ID_KEY];
            $identifier = $attributes[self::ATTRIBUTE_ID_KEY];
            foreach ($child->children() as $argument){
                $childAttributes = (array)$child->attributes();
                $agrumentIdentifier = $childAttributes[self::ATTRIBUTE_ID_KEY];
                $result[$identifier][$agrumentIdentifier] = (string) $argument;
            }

        }
        return $result;
    }
}
