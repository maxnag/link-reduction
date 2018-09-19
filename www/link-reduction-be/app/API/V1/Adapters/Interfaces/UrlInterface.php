<?php

namespace App\API\V1\Adapters\Interfaces;

use App\API\V1\Collections\UrlCollection;
use App\API\V1\Entities\UrlEntity;

/**
 * Url Adapter interface class
 *
 * @package api
 * @subpackage link reduction
 * @author Max Nagaychenko nagaychenko.dev[at]gmail.com
 * @license
 * @filesource
 */
interface UrlInterface
{
    /**
     * Get data method
     *
     * @param array $arguments
     *
     * @return array|UrlCollection
     */
    public function get(array $arguments): array;

    /**
     * Create data method
     *
     * @param UrlEntity $urlEntity
     * @param array $expected
     *
     * @return UrlEntity
     */
    public function createEntity(UrlEntity $urlEntity, array $expected): UrlEntity;

    /**
     * Update data method
     *
     * @param UrlEntity $urlEntity
     * @param array $expected
     *
     * @return UrlEntity
     */
    public function updateEntity(UrlEntity $urlEntity, array $expected): UrlEntity;
}