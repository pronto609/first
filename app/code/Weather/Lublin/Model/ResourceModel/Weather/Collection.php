<?php
namespace Weather\Lublin\Model\ResourceModel\Weather;

use Weather\Lublin\Model\Weather;
use Weather\Lublin\Model\ResourceModel\Weather as WeatherResource;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

/**
 * Class Collection
 * @package Weather\Lublin\Model\ResourceModel\Weather
 */
class Collection extends AbstractCollection
{
    /**
     * @inheritdoc
     */
    protected function _construct()
    {
        $this->_init(Weather::class, WeatherResource::class);
    }
}
