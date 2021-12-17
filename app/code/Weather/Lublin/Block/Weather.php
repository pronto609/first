<?php
declare(strict_types=1);

namespace Weather\Lublin\Block;

use Magento\Framework\View\Element\Template;
use Weather\Lublin\Provider\ConfigProvider;
use Weather\Lublin\Model\WeatherRepository;

class Weather extends Template
{
    public array $weatherFields = [
        'entity_id',
        'city',
        'country',
        'temperature',
        'precipitation',
        'pressure',
        'humidity',
        'wind_kph',
        'wind_dir',
        'timestamp',
    ];

    private ConfigProvider $configProvider;

    private WeatherRepository $weatherRepository;

    public function __construct(
        Template\Context  $context,
        ConfigProvider    $configProvider,
        WeatherRepository $weatherRepository
    ) {
        $this->configProvider = $configProvider;
        $this->weatherRepository = $weatherRepository;
        parent::__construct($context);
    }

    public function isEnabled()
    {
        return $this->configProvider->isEnabled();
    }

    public function getWeatherData(): array
    {
        $weather = $this->weatherRepository->getLastWeather();
        $data = [];

        foreach ($this->weatherFields as $field) {
            $data[$field] = $weather->getData($field);
        }

        return $data;
    }
}
