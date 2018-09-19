<?php

namespace App\API\V1\Entities;

/**
 * Entity for url
 *
 * @package  api
 * @subpackage link reduction
 * @author Max Nagaychenko nagaychenko.dev[at]gmail.com
 * @license
 * @filesource
 */
class UrlEntity extends CommonEntity implements InterfaceEntity
{
    protected $key = '';
    protected $url = '';

    /**
     * Get key
     *
     * @return string
     */
    public function getKey(): string
    {
        return $this->key;
    }

    /**
     * Set key
     *
     * @param string $key
     *
     * @return $this
     */
    public function setKey($key): self
    {
        $this->key = (string)$key;

        return $this;
    }

    /**
     * Get url
     *
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * Set url
     *
     * @param string $url
     *
     * @return $this
     */
    public function setUrl($url): self
    {
        $this->url = (string)$url;

        return $this;
    }
}
