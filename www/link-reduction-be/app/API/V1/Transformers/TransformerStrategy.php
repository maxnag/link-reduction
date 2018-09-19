<?php

namespace App\API\V1\Transformers;

use App\API\V1\Transformers\Json\ExceptionJson;

/**
 * API link reduction
 * TransformerStrategy class
 *
 * @package  api
 * @subpackage link reduction
 * @author Max Nagaychenko nagaychenko.dev[at]gmail.com
 * @license
 * @filesource
 */
class TransformerStrategy implements TransformerInterface
{
    /**
     * @var object
     */
    private $strategy;

    /**
     * TransformerStrategy constructor.
     *
     * @param object|ExceptionJson| $transformedObject
     */
    public function __construct($transformedObject)
    {
        $this->strategy = $transformedObject;
    }

    /**
     * Get transformed data
     *
     * @param TransformerData $data
     *
     * @return array
     */
    public function getTransformedData(TransformerData $data): array
    {
        return $this->strategy->getTransformedData($data);
    }

    /**
     * Get errors data
     *
     * @param TransformerData $data
     *
     * @return array
     */
    public function getErrorsData(TransformerData $data): array
    {
        return $this->strategy->getErrorsData($data);
    }

}