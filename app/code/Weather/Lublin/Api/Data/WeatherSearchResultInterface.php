<?php
namespace Weather\Lublin\Api\Data;

use Magento\Framework\Api\SearchResultsInterface;

/**
 * Interface WeatherSearchResultInterface
 * @package Weather\Lublin\Api\Data
 */
interface WeatherSearchResultInterface extends SearchResultsInterface
{
    public function getItems(): array;

    public function setItems(array $items): self;
}
