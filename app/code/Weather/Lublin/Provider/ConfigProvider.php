<?php

declare(strict_types=1);

namespace Weather\Lublin\Provider;

use Magento\Framework\App\Config\ScopeConfigInterface;

class ConfigProvider
{
    public const IS_ENABLED = 'weather/general/enabled';
    public const API_ENDPOINT = 'weather/general/api_endpoint';
    public const API_KEY = 'weather/general/api_key';
    public const WEATHER_CITY = 'weather/general/city';
    public const WEATHER_PARAMETERS = 'weather/general/parameters';

    private ScopeConfigInterface $scopeConfig;

    public function __construct(ScopeConfigInterface $scopeConfig)
    {
        $this->scopeConfig = $scopeConfig;
    }

    public function isEnabled(): bool
    {
        return $this->scopeConfig->isSetFlag(self::IS_ENABLED);
    }

    public function getApiEndpoint(): ?string
    {
        return $this->scopeConfig->getValue(self::API_ENDPOINT);
    }

    public function getApiKey(): ?string
    {
        return $this->scopeConfig->getValue(self::API_KEY);
    }

    public function getCity(): ?string
    {
        return $this->scopeConfig->getValue(self::WEATHER_CITY);
    }

    public function getParameters(): ?string
    {
        return $this->scopeConfig->getValue(self::WEATHER_PARAMETERS);
    }
}
