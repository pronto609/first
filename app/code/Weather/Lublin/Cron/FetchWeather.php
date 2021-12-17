<?php

declare(strict_types=1);

namespace Weather\Lublin\Cron;

use Magento\Framework\Exception\StateException;
use Psr\Log\LoggerInterface;
use Weather\Lublin\Model\WeatherRepository;
use Weather\Lublin\Model\WeatherFactory;
use Weather\Lublin\Model\WeatherDownloader;

class FetchWeather
{
    private $weatherParams = [
        'current' => [
            'temp_c',
            'temp_f',
            'wind_kph',
            'wind_mph',
            'wind_dir',
            'humidity',
            'precip_mm',
            'feelslike_c',
            'feelslike_f',
        ],
        'location' => [
            'name',
            'country'
        ]
    ];

    private WeatherDownloader $weatherDownloader;

    private WeatherRepository $weatherRepository;

    private WeatherFactory $weatherFactory;

    private LoggerInterface $logger;

    public function __construct(
        WeatherDownloader $weatherManager,
        WeatherRepository $weatherRepository,
        WeatherFactory    $weatherFactory,
        LoggerInterface   $logger
    ) {
        $this->weatherDownloader = $weatherManager;
        $this->weatherRepository = $weatherRepository;
        $this->weatherFactory = $weatherFactory;
        $this->logger = $logger;
    }

    public function execute(): void
    {
        $data = $this->weatherDownloader->execute();
        $weatherData = $this->retrieveData($data);

        if (is_array($weatherData)) {
            $weather = $this->weatherFactory->create();
            $weather->setData($weatherData);
            try {
                $this->weatherRepository->save($weather);
            } catch (StateException $e) {
                $this->logger->critical($e->getMessage());
            }
        }
    }

    private function retrieveData($data): array
    {
        return [
            'timestamp' => $data['location']['localtime_epoch'],
            'country' => $data['location']['country'],
            'city' => $data['location']['name'],
            'temperature' => $data['current']['temp_c'],
            'wind_kph' => $data['current']['wind_kph'],
            'wind_dir' => $data['current']['wind_dir'],
            'pressure' => $data['current']['pressure_mb'],
            'precipitation' => $data['current']['precip_mm'],
            'humidity' => $data['current']['humidity'],
        ];
    }
}
