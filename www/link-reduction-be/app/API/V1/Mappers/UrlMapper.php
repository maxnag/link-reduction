<?php

namespace App\API\V1\Mappers;

use App\API\V1\Adapters\Interfaces\UrlInterface;
use App\API\V1\Adapters\MySQL\UrlMySQL;
use App\API\V1\Collections\UrlCollection;
use App\API\V1\Entities\UrlEntity;
use App\Exceptions\ApiException;

/**
 * API link reduction
 * Url Mapper class
 *
 * @package  api
 * @subpackage link reduction
 * @author Max Nagaychenko nagaychenko.dev[at]gmail.com
 * @license
 * @filesource
 */
class UrlMapper
{
    /**
     * @var UrlInterface
     */
    private $adapter;

    /**
     * Url Mapper constructor.
     *
     * @param mixed $adapterClassName
     *
     * @throws ApiException
     */
    public function __construct($adapterClassName = 'UrlMySQL')
    {
        $this->adapter = \is_object($adapterClassName)
            ? $adapterClassName
            : new $adapterClassName
        ;
    }

    /**
     * Get urls data
     *
     * @param array $arguments
     *
     * @throws ApiException|\LogicException
     *
     * @return UrlCollection
     */
    public function getUrlsData(array $arguments): UrlCollection
    {
        $urlCollection = new UrlCollection;

        $urlsData = $this->adapter->get($arguments);

        foreach ($urlsData as $urlData) {
            $urlEntity = $this->getUrlEntity($urlData);
            $urlCollection->add($urlEntity);
        }

        return $urlCollection;
    }

    /**
     * Create url
     *
     * @param UrlEntity $url
     * @param array $expected
     *
     * @return UrlEntity
     */
    public function createUrlData(UrlEntity $url, array $expected): UrlEntity
    {
        return $this->adapter->createEntity($url, $expected);
    }

    /**
     * Update url
     *
     * @param UrlEntity $url
     * @param array $expected
     *
     * @return UrlEntity
     */
    public function updateUrlData(UrlEntity $url, array $expected): UrlEntity
    {
        return $this->adapter->updateEntity($url, $expected);
    }

    /**
     * Convert url data to url entity
     *
     * @param \stdClass|UrlMySQL $urlData
     *
     * @throws ApiException
     *
     * @return UrlEntity
     *
     */
    private function getUrlEntity($urlData): UrlEntity
    {
        $urlEntity = (new UrlEntity)
            ->setId($urlData->id)
            ->setKey($urlData->key)
            ->setUrl($urlData->url)
            ->setDateCreate($urlData->date_create)
            ->setDateModify($urlData->date_modify)
        ;

        return $urlEntity;
    }
}
