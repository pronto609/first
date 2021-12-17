<?php

declare(strict_types=1);

namespace Weather\Lublin\Model\Config\Source;

use Magento\Framework\Data\OptionSourceInterface;


class ConfigWeatherParamsProvider implements OptionSourceInterface
{
    /**
     * @inheritDoc
     */
    public function toOptionArray()
    {
            $res =
                [
                [
                'value' => 'temp_c',
                'label' => 'Temperature C',
                ],
                    [
                        'value' => 'temp_c',
                        'label' => 'Temperature C',
                    ],
                    [
                        'value' => 'temp_f',
                        'label' => 'Temperature F',
                    ],
                    [
                        'value' => 'wind_kph',
                        'label' => 'Wind km/h',
                    ],
                    [
                        'value' => 'wind_mph',
                        'label' => 'Wind m/h',
                    ],
                    [
                        'value' => 'wind_dir',
                        'label' => 'Wind Direction',
                    ],
                    [
                        'value' => 'humidity',
                        'label' => 'Humidity',
                    ],
                    [
                        'value' => 'precip_mm',
                        'label' => 'Precipitation mm',
                    ],
                    [
                        'value' => 'feelslike_c',
                        'label' => 'Feelslike C',
                    ],
                    [
                        'value' => 'feelslike_f',
                        'label' => 'Feelslike F',
                    ],
                    [
                    'value' => 'name',
                    'label' => 'City',
                ],
                    [
                    'value' => 'country',
                    'label' => 'Country',
                ],
            ];


        return $res;
    }
}
