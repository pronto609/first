<?php

namespace Framework;

interface XmlConverterInterface {

    /**
     * @param \SimpleXMLElement $simpleXMLElement
     * @return array
     */
    public function convert(\SimpleXMLElement $simpleXMLElement ): array;
}
