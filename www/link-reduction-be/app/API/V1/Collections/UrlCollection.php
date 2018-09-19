<?php

namespace App\API\V1\Collections;

use App\API\V1\Entities\UrlEntity;

/**
 * Collection entity for url
 *
 * @package  api
 * @subpackage link reduction
 * @author Max Nagaychenko nagaychenko.dev[at]gmail.com
 * @license
 * @filesource
 */
class UrlCollection extends CommonCollection
{
    /**
     * Add entity to collection
     *
     * @param UrlEntity $urlEntity
     *
     * @return void
     */
    public function add(UrlEntity $urlEntity): void
    {
        $this->collection[$urlEntity->getId()] = $urlEntity;
    }

    /**
     * Update entity in collection
     *
     * @param UrlEntity $urlEntity
     *
     * @return void
     */
    public function updateEntity(UrlEntity $urlEntity): void
    {
        $this->add($urlEntity);
    }
}
