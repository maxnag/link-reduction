<?php

namespace App\API\V1\Entities;

/**
 * Entity interface class
 *
 * @package  api
 * @subpackage link reduction
 * @author Max Nagaychenko nagaychenko.dev[at]gmail.com
 * @license
 * @filesource
 */
interface InterfaceEntity
{
    /**
     * Get entity ID
     *
     * @return int
     */
    public function getId(): int;

    /**
     * Set entity ID
     *
     * @param int $id
     *
     * @return $this
     */
    public function setId($id);

    /**
     * Get create date
     *
     * @return string
     */
    public function getDateCreate(): string;

    /**
     * Set create date
     *
     * @param string $date
     *
     * @return $this
     */
    public function setDateCreate($date);

    /**
     * Get modify date
     *
     * @return string
     */
    public function getDateModify(): string;

    /**
     * Set modify date
     *
     * @param string $date
     *
     * @return $this
     */
    public function setDateModify($date);

    /**
     * Converting property of object into array
     *
     * @param array $expected
     *
     * @return array
     */
    public function getArray(array $expected = []): array;
}
