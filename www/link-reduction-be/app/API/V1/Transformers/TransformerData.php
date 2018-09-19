<?php

namespace App\API\V1\Transformers;

use Dingo\Api\Http\Request;

/**
 * API link reduction
 * Data class for converter data
 *
 * @package  api
 * @subpackage link reduction
 * @author Max Nagaychenko nagaychenko.dev[at]gmail.com
 * @license
 * @filesource
 */
class TransformerData
{
    /**
     * @var Request
     */
    private $request;

    /**
     * @var array
     */
    private $arguments;

    /**
     * @var object|array
     */
    private $data;

    /**
     * @var array
     */
    private $errors = [];

    /**
     * TransformerData constructor.
     *
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Get arguments object
     *
     * @return array
     */
    public function getArguments(): array
    {
        return $this->arguments;
    }

    /**
     * Set arguments object
     *
     * @param array $arguments
     *
     * @return $this
     */
    public function setArguments(array $arguments): self
    {
        $this->arguments = $arguments;

        return $this;
    }

    /**
     * Get data
     *
     * @return object
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * Set data
     *
     * @param object|array $data
     *
     * @return $this
     */
    public function setData($data) :self
    {
        $this->data = $data;

        return $this;
    }

    /**
     * Get errors
     *
     * @return array
     */
    public function getErrors(): array
    {
        return $this->errors;
    }

    /**
     * Set errors
     *
     * @param array $errors
     *
     * @return $this
     */
    public function setErrors($errors): self
    {
        $this->errors = $errors;

        return $this;
    }

    /**
     * Get request
     *
     * @return Request
     */
    public function getRequest(): Request
    {
        return $this->request;
    }
}