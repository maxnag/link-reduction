<?php

namespace App\API\V1\Transformers;

/**
 * Adapter Transformer interface class
 *
 * @package api
 * @subpackage link reduction
 * @author Max Nagaychenko nagaychenko.dev[at]gmail.com
 * @license
 * @filesource
 */
interface TransformerInterface
{
    /**
     * Get transformer data
     *
     * @param TransformerData $data
     *
     * @return array
     */
    public function getTransformedData(TransformerData $data): array;

    /**
     * Get errors data
     *
     * @param TransformerData $data
     *
     * @return array
     */
    public function getErrorsData(TransformerData $data): array;
}