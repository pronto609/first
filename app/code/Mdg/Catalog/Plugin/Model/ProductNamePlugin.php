<?php

namespace Mdg\Catalog\Plugin\Model;

use Magento\Catalog\Model\Product;
use Mdg\Catalog\Model\GetConfigName;

class ProductNamePlugin
{
    protected $configPrice;

    public function __construct(GetConfigPrice $configPrice)
    {
        $this->configPrice = $configPrice;
    }

    public function afterGetName(Product $product, $result)
    {

        // Do something with $result
        $result += $this->configPrice->getConfig();
        return $result;
    }
}
