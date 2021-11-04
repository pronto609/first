<?php

namespace Framework;

class XmlReader
{
    /**
     * @return XmlConverterInterface
     */
    protected function getConverter(): XmlConverterInterface
    {
        return new DiXmlConverter();
    }

    public function read(string $xmlFile): array
    {

        $result = [];
        $converter = $this->getConverter();
        $recurciveDirectoryIterator = glob(BASE_DIR . DS . APP_SOURCE_PATH . DS . '*' . DS . $xmlFile);

        foreach ($recurciveDirectoryIterator as $file){
            var_dump($file);
            die;
            $fileContent = file_get_contents($file);
            $result = array_replace_recursive($result,
                $converter->convert(new \SimpleXMLElement($fileContent))
            );
        }
        return $result;
    }
}
