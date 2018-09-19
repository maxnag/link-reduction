<?php

namespace App\API\V1\Adapters\MySQL;

use App\API\V1\Adapters\Interfaces\UrlInterface;
use App\API\V1\Entities\UrlEntity;
use App\Exceptions\ApiException;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * Url ORM Model
 *
 * @package    backend
 * @subpackage url
 * @author Max Nagaychenko nagaychenko.dev[at]gmail.com
 * @license
 */
class UrlMySQL extends Model implements UrlInterface
{
    const CREATED_AT = 'date_create';
    const UPDATED_AT = 'date_modify';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * Table name
     *
     * @var string
     */
    protected $table = 'urls';

    /**
     * Get data
     *
     * @param array $arguments
     *
     * @throws ApiException
     *
     * @return array
     */
    public function get(array $arguments): array
    {
        $urls = $this->filters($arguments);

        return $urls->get()->all();
    }

    /**
     * Create data
     *
     * @param UrlEntity $urlEntity
     * @param array $expected
     *
     * @return UrlEntity
     */
    public function createEntity(UrlEntity $urlEntity, array $expected): UrlEntity
    {
        $this->date_create = date('Y-m-d H:i:s');

        if (\in_array('key', $expected, false)) {
            $this->key = $urlEntity->getKey();
        }

        if (\in_array('url', $expected, false)) {
            $this->url = $urlEntity->getUrl();
        }

        $this->save();

        return $urlEntity
            ->setId($this->getKey())
            ->setDateCreate($this->date_create)
            ;
    }

    /**
     * Update data
     *
     * @param UrlEntity $urlEntity
     * @param array $expected
     *
     * @return UrlEntity
     */
    public function updateEntity(UrlEntity $urlEntity, array $expected): UrlEntity
    {
        $url = $this->find($urlEntity->getId());
        $urlEntity->setDateCreate($url->date_create);
        $url->date_modify = date('Y-m-d H:i:s');

        if (\in_array('key', $expected, false)) {
            $url->key = $urlEntity->getKey();
        }

        if (\in_array('url', $expected, false)) {
            $url->url = $urlEntity->getUrl();
        }

        $url->save();

        return $urlEntity
            ->setId($this->getKey())
            ->setDateModify($url->date_modify)
        ;
    }

    /**
     * Apply filters
     *
     * @param array $arguments
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected function filters(array $arguments): Builder
    {
        $urlModel = $this->newQuery()->select($this->table . '.*');

        if (isset($arguments['id'])) {
            $urlModel
                ->where($this->table . '.id', '=', $arguments['id']);
        }

        if (isset($arguments['key'])) {
            $urlModel
                ->where($this->table . '.key', '=', $arguments['key']);
        }

        return $urlModel;
    }
}
