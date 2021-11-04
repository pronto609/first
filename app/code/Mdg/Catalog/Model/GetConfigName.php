<?php

namespace Mdg\Catalog\Model;
use Magento\Framework\App\Config\ScopeConfigInterface;
;

class GetConfigName extends \Magento\Framework\Model\AbstractModel
{
    const XML_CONFIG_PATH = 'secondSect_id/prod_id/add_to_name';
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
