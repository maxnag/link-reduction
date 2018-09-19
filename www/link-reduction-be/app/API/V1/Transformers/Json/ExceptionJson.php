<?php

namespace App\API\V1\Transformers\Json;

use App\API\V1\Transformers\TransformerData;
use App\Exceptions\ApiException;

/**
 * ExceptionJson class
 *
 * @package  ExceptionJson
 * @subpackage link reduction
 * @author Max Nagaychenko nagaychenko.dev[at]gmail.com
 * @license
 * @filesource
 */
class ExceptionJson
{
    /**
     * Get errors data
     *
     * @param TransformerData $data
     *
     * @return array
     */
    public function getErrorsData(TransformerData $data): array
    {
        /** @var ApiException $ex */
        $ex = $data->getData();

        return [
            'message' => [$ex->detail_message],
            'status_code' => $ex->getStatusCode(),
            'title' => $ex->getMessage(),
        ];
    }
}
