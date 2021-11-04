<?php

namespace Mdg\Catalog\Model;
use Magento\Framework\App\Config\ScopeConfigInterface;


class GetConfigPrice extends \Magento\Framework\Model\AbstractModel
{
    const XML_CONFIG_PATH = 'tab_id/section_id/product_id';
    protected $scopeConfig;

    public function __construct(\Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig)
    {
        $this->scopeConfig = $scopeConfig;
    }

    public function getConfig()
    {
        $configValue = $this->scopeConfig->getValue(self::XML_CONFIG_PATH, \Magento\Store\Model\ScopeInterface::SCOPE_STORE); // For Store
        /**
         * For Website
         *
         * $configValue = $this->scopeConfig->getValue(self::XML_CONFIG_PATH,ScopeInterface::SCOPE_WEBSITE);
         */

        return $configValue;
    }
}
