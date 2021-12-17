<?php

declare(strict_types=1);

namespace Weather\Lublin\Model\ResourceModel;

use Weather\Lublin\Api\Data\WeatherInterface;
use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

/**
 * Class Weather
 * @package Weather\Lublin\Model\ResourceModel
 */
class Weather extends AbstractDb
{
    /**
     * @var string
     */
    const TABLE_NAME = 'weather_lublin';

    /**
     * Resource initialization
     *
     * @return void
     */
    protected function _construct(): void
    {
        $this->_init(self::TABLE_NAME, WeatherInterface::ID);
    }
}
