<?php

namespace App\API\V1\Validators;

use App\API\V1\Entities\UrlEntity;
use Illuminate\Validation\Rule;

/**
 * API link reduction
 * Validator class for url data
 *
 * @package  api
 * @subpackage link reduction
 * @author Max Nagaychenko nagaychenko.dev[at]gmail.com
 * @license
 * @filesource
 */
class UrlValidator extends AbstractValidator
{
    /**
     * UrlValidator constructor.
     *
     * @param UrlEntity|null $urlEntity
     * @param array $fieldsForValidation
     */
    public function __construct(UrlEntity $urlEntity = null, array $fieldsForValidation = [])
    {
        if ($urlEntity !== null) {
            parent::__construct($urlEntity->getArray($fieldsForValidation));
        }
    }

    /**
     * Rules for validation
     *
     * @return array
     */
    protected function prepareRules(): array
    {
        $rules = [];

        foreach ($this->rawData as $key => $value) {
            switch ($key) {
                case 'id':
                    $rules[$key] = 'required|not_in:0|numeric';
                    break;
                case 'key':
                    $rules[$key] = 'required';

                    if (isset($this->rawData['id'])) {
                        $rules[$key][] = Rule::unique('urls')->ignore($this->rawData['id']);
                    } else {
                        $rules[$key][] = Rule::unique('urls');
                    }
                    break;
                case 'url':
                    $rules[$key] = ['required', 'regex:/^(https|http)\:\/\/.+$/'];
                    break;
            }
        }

        return $rules;
    }

    /**
     * Custom massages for validation
     *
     * return array
     */
    protected function messages(): array
    {
        $messageFile = 'urlEntity';

        return [
            'id.required' => __($messageFile . '.id.required'),
            'id.not_in' => __($messageFile . '.id.not_in'),
            'key.required' => __($messageFile . '.key.required'),
            'key.unique' => __($messageFile . '.key.unique'),
            'url.required' => __($messageFile . '.url.required'),
            'url.regex' => __($messageFile . '.url.regex'),
        ];
    }
}
