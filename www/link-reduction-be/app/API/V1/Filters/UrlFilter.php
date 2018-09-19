<?php

namespace App\API\V1\Filters;

use App\API\V1\Entities\UrlEntity;
use App\Exceptions\ApiException;

/**
 * API link reduction
 * Filter class for url data
 *
 * @package  api
 * @subpackage link reduction
 * @author Max Nagaychenko nagaychenko.dev[at]gmail.com
 * @license
 * @filesource
 */
class UrlFilter extends AbstractFilter
{
    /**
     * UrlFilter constructor.
     *
     * @param UrlEntity|null $urlEntity
     *
     * @throws ApiException|\ReflectionException
     */
    public function __construct(UrlEntity $urlEntity = null)
    {
        parent::__construct($urlEntity);
    }

    /**
     * Get data
     *
     * @return UrlEntity
     */
    public function getData(): UrlEntity
    {
        return $this->object;
    }

    /**
     * Prepare rules for filtering
     *
     * @return array
     */
    protected function prepareRules(): array
    {
        $rules = [
            true => [
                ['strip_tags'],
                ['trim'],
            ]
        ];

        foreach ($this->rawData as $key => $value) {
            switch ($key) {
                case 'id':
                case 'key':
                case 'url':
                    break;
            }
        }

        return $rules;
    }
}
