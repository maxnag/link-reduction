<?php

namespace App\API\V1\Transformers\Json;

use App\API\V1\Collections\UrlCollection;
use App\API\V1\Entities\UrlEntity;
use App\API\V1\Transformers\TransformerData;

/**
 * API link reduction
 * Strategy Json class for url transformer data class
 *
 * @package  api
 * @subpackage link reduction
 * @author Max Nagaychenko nagaychenko.dev[at]gmail.com
 * @license
 * @filesource
 */
class UrlJson
{
    /**
     * Get transformed data
     *
     * @param TransformerData $data
     *
     * @return array
     */
    public function getTransformedData(TransformerData $data): array
    {
        /** @var UrlEntity $urlEntity */
        $urlEntity = current($data->getData()->get());

        return [
            'id' => $urlEntity->getId(),
            'key' => $urlEntity->getKey(),
            'url' => $urlEntity->getUrl(),
        ];
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
        $out = [];

        foreach ($data->getErrors() as $key => $errors) {
            if (\is_array($errors)) {
                foreach ($errors as $error) {
                    $out['message'][] = $error;
                }
            } else {
                $out['message'][] = $errors;
            }

            $out['status_code'] = 422;
            $out['title'] = __('Field validation error');
        }

        return $out;
    }
}
