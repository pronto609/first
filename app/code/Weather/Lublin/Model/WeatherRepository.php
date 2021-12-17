<?php
namespace Weather\Lublin\Model;

use Exception;
use Weather\Lublin\Api\Data\WeatherInterface;
use Weather\Lublin\Api\Data\WeatherSearchResultInterface;
use Weather\Lublin\Api\Data\WeatherSearchResultInterfaceFactory;
use Weather\Lublin\Api\WeatherRepositoryInterface;
use Weather\Lublin\Model\ResourceModel\Weather as WeatherResource;
use Weather\Lublin\Model\ResourceModel\Weather\Collection as WeatherCollection;
use Weather\Lublin\Model\ResourceModel\Weather\CollectionFactory as WeatherCollectionFactory;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Exception\StateException;

/**
 * Class WeatherRepository
 * @package Weather\Lublin\Model
 */
class WeatherRepository implements WeatherRepositoryInterface
{
    private array $registry = [];

    private WeatherResource $weatherResource;

    private WeatherFactory $weatherFactory;

    private WeatherCollectionFactory $weatherCollectionFactory;

    private WeatherSearchResultInterfaceFactory $weatherSearchResultFactory;

    /**
     * @param WeatherResource $weatherResource
     * @param WeatherFactory $weatherFactory
     * @param WeatherCollectionFactory $weatherCollectionFactory
     * @param WeatherSearchResultInterfaceFactory $weatherSearchResultFactory
     */
    public function __construct(
        WeatherResource $weatherResource,
        WeatherFactory $weatherFactory,
        WeatherCollectionFactory $weatherCollectionFactory,
        WeatherSearchResultInterfaceFactory $weatherSearchResultFactory
    ) {
        $this->weatherResource = $weatherResource;
        $this->weatherFactory = $weatherFactory;
        $this->weatherCollectionFactory = $weatherCollectionFactory;
        $this->weatherSearchResultFactory = $weatherSearchResultFactory;
    }

    public function getById(int $id): WeatherInterface
    {
        if (!array_key_exists($id, $this->registry)) {
            $weather = $this->weatherFactory->create();
            $this->weatherResource->load($weather, $id);
            if (!$weather->getId()) {
                throw new NoSuchEntityException(__('Requested weather does not exist'));
            }
            $this->registry[$id] = $weather;
        }

        return $this->registry[$id];
    }

    public function getList(SearchCriteriaInterface $searchCriteria): WeatherSearchResultInterface
    {
        /** @var WeatherCollection $collection */
        $collection = $this->weatherCollectionFactory->create();
        foreach ($searchCriteria->getFilterGroups() as $filterGroup) {
            foreach ($filterGroup->getFilters() as $filter) {
                $condition = $filter->getConditionType() ? $filter->getConditionType() : 'eq';
                $collection->addFieldToFilter($filter->getField(), [$condition => $filter->getValue()]);
            }
        }

        /** @var WeatherSearchResultInterface $searchResult */
        $searchResult = $this->weatherSearchResultFactory->create();
        $searchResult->setSearchCriteria($searchCriteria);
        $searchResult->setItems($collection->getItems());
        $searchResult->setTotalCount($collection->getSize());
        return $searchResult;
    }

    public function save(WeatherInterface $weather): WeatherInterface
    {
        try {
            $this->weatherResource->save($weather);
            $this->registry[$weather->getId()] = $this->getById($weather->getId());
        } catch (Exception $e) {
            throw new StateException(__('Unable to save weather #%1', $weather->getId()));
        }
        return $this->registry[$weather->getId()];
    }

    public function delete(WeatherInterface $weather): bool
    {
        try {
            $this->weatherResource->delete($weather);
            unset($this->registry[$weather->getId()]);
        } catch (Exception $e) {
            throw new StateException(__('Unable to remove weather #%1', $weather->getId()));
        }

        return true;
    }

    public function deleteById(int $id): bool
    {
        return $this->delete($this->getById($id));
    }

    public function getLastWeather()
    {
        $collection = $this->weatherCollectionFactory->create()
            ->addFieldToSelect('*')
            ->setOrder('entity_id');

        return $collection->getFirstItem();
    }
}
