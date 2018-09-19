<?php

namespace App\API\V1\Services;

use App\Exceptions\ApiException;

/**
 * Service abstract class
 *
 * @codeCoverageIgnore
 *
 * @package  api
 * @subpackage link reduction
 * @author Max Nagaychenko nagaychenko.dev[at]gmail.com
 * @license
 * @filesource
 */
abstract class ServiceAbstract
{
    /**
     * @var string
     */
    protected $format;

    /**
     * @var \Dingo\Api\Http\Request
     */
    protected $request;

    /**
     * @var array
     */
    protected $arguments;

    /**
     * @var object
     */
    protected $validator;

    /**
     * @var array
     */
    protected $entityFields = [];

    /**
     * Get data
     *
     * @return object|array
     */
    abstract public function getData();

    /**
     * Get API format
     */
    public function getFormat(): string
    {
        $this->format = ucfirst(strtolower($this->request->format()));

        return $this->format;
    }

    /**
     * Get arguments
     *
     * @return array
     */
    public function getArguments(): array
    {
        return $this->arguments;
    }

    /**
     * Set arguments
     *
     * @throws \LogicException
     *
     * @return void
     */
    protected function setArguments(): void
    {
        $this->arguments = $this->request->method() === 'POST'
            ? $this->arguments = [$this->request->getContent()]
            : $this->arguments = $this->request->attributes->all()
        ;
    }

    /**
     * Set validator object
     *
     * @param object $validator
     *
     * @return $this
     */
    protected function setValidator($validator): self
    {
        $this->validator = $validator;

        return $this;
    }

    /**
     * Get validator object
     *
     * @return object
     */
    public function getValidator()
    {
        return $this->validator;
    }

    /**
     * Not found exception
     * (wrapper for valid inspection code)
     *
     * @throws ApiException
     *
     * @return void
     */
    protected function notFoundException(): void
    {
        $apiException = new ApiException(404, __('No record found'));
        $apiException->detail_message = __('The entity you are looking for is not found in the database');

        throw $apiException;
    }
}
