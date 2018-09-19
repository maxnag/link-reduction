<?php

namespace App\API\V1\Adapters\Json;

use App\API\V1\Adapters\Interfaces\UrlInterface;
use App\API\V1\Entities\UrlEntity;
use App\Exceptions\ApiException;

/**
 * Model to convert POST/PATCH data
 * Json Url Adapter class
 *
 * @package  api
 * @subpackage link reduction
 * @author Max Nagaychenko nagaychenko.dev[at]gmail.com
 * @license
 * @filesource
 */
class UrlJson extends CommonJson implements UrlInterface
{
    /**
     * Create data
     *
     * @param UrlEntity $urlEntity
     * @param array $expected
     *
     * @throws ApiException
     *
     * @return UrlEntity
     */
    public function createEntity(UrlEntity $urlEntity, array $expected): UrlEntity
    {
        throw new ApiException(405, __('The adapter method :method is not supported by the class :class',
            ['method' => __METHOD__, 'class' => __CLASS__]));
    }

    /**
     * Upate data
     *
     * @param UrlEntity $urlEntity
     * @param array $expected
     *
     * @throws ApiException
     *
     * @return UrlEntity
     */
    public function updateEntity(UrlEntity $urlEntity, array $expected): UrlEntity
    {
        throw new ApiException(405, __('The adapter method :method is not supported by the class :class',
            ['method' => __METHOD__, 'class' => __CLASS__]));
    }
}
