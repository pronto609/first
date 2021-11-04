<?php

namespace Mdg\Catalog\Plugin\Model;

use Magento\Catalog\Model\Product;
use Mdg\Catalog\Model\GetConfigPrice;

class ProductPricePlugin
{
    protected $configPrice;

    public function __construct( GetConfigPrice $configPrice ){
        $this->configPrice = $configPrice;
    }
    public function afterGetPrice(Product $product, $result)
    {

        // Do something with $result
        $result += $this->configPrice->getConfig();
        return $result;
    }
}
