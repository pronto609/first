<?php

namespace Pronto\RegularPrice\Plugin;

class FinalPricePlugin
{
    public function beforeSetTemplate(\Magento\Catalog\Pricing\Render\FinalPriceBox $subject, $template)
    {
        if ($template == 'Magento_ConfigurableProduct::product/price/final_price.phtml') {
            return ['MyVendor_MyModule::product/price/final_price.phtml'];
        }
        else
        {
            return [$template];
        }

    }
}
