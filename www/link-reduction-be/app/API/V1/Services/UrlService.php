<?php

namespace App\API\V1\Services;

use App\API\V1\Adapters\Json\UrlJson;
use App\API\V1\Classes\Bijective;
use App\API\V1\Entities\UrlEntity;
use App\API\V1\Filters\UrlFilter;
use App\API\V1\Mappers\UrlMapper;
use App\API\V1\Collections\UrlCollection;
use App\API\V1\Validators\UrlValidator;
use App\Exceptions\ApiException;
use Dingo\Api\Http\Request;

/**
 * API link reduction
 * Url Service class
 *
 * @package  api
 * @subpackage link reduction
 * @author Max Nagaychenko nagaychenko.dev[at]gmail.com
 * @license
 * @filesource
 */
class UrlService extends ServiceAbstract
{
    /**
     * @var UrlMapper
     */
    private $urlMapper;

    /**
     * @var UrlCollection
     */
    protected $data;

    /**
     * Url service constructor.
     *
     * @param Request $request
     * @param UrlMapper $urlMapper
     *
     * @throws \LogicException
     */
    public function __construct(Request $request, UrlMapper $urlMapper)
    {
        $this->request = $request;
        $this->urlMapper = $urlMapper;
        $this->setArguments();
    }

    /**
     * Get urls data
     *
     * @throws ApiException|\LogicException
     *
     * @return $this
     */
    public function getUrls(): self
    {
        $this->data = $this->urlMapper->getUrlsData($this->arguments);

        return $this;
    }

    /**
     * Get url data from request
     *
     * @throws ApiException|\LogicException
     *
     * @return $this
     */
    public function getUrlFromRequest(): self
    {
        $adapterName = 'App\API\V1\Adapters\\' . $this->getFormat() . '\Url' . $this->getFormat();
        $adapter = new $adapterName($this->request);

        /** @var UrlJson $adapter */
        $adapter
            ->setEntity((new UrlEntity)->getArray())
            ->setAction($this->request->method())
        ;

        $urlService = new UrlService($this->request, new UrlMapper( $adapter));

        $this->data = $urlService->getUrls()->getData();
        $this->entityFields = $adapter->getMappingFields();

        return $this;
    }

    /**
     * Set data
     *
     * @param UrlEntity $urlEntity
     *
     * @return $this
     */
    public function setData(UrlEntity $urlEntity): self
    {
        $urlCollection = new UrlCollection();
        $urlCollection->add($urlEntity);

        $this->data = $urlCollection;

        return $this;
    }

    /**
     * Filter url entity
     *
     * @param UrlFilter $filterObject
     *
     * @throws ApiException|\ReflectionException
     *
     * @return $this
     */
    public function filterUrl(UrlFilter $filterObject): self
    {
        $urlEntity = current($this->getData()->get()); // works only with one element in collection

        $this->getData()->updateEntity($filterObject->setData($urlEntity)->getData());

        return $this;
    }

    /**
     * Validate url entity
     *
     * @param UrlValidator $validationObject
     * @param array $fieldsForValidation
     *
     * @throws ApiException
     *
     * @return $this
     */
    public function validateUrl(UrlValidator $validationObject, array $fieldsForValidation): self
    {
        /** @var UrlEntity $urlEntity */
        $urlEntity = current($this->getData()->get()); // works only with one element in collection

        /** @var UrlValidator $validator */
        $validator = $validationObject->setData($urlEntity->getArray($fieldsForValidation));
        $this->setValidator($validator);

        if (!$validator->check()) {
            throw new ApiException(422, __('The :entity has validation mistakes.',
                ['entity' => 'UrlEntity']));
        }

        return $this;
    }

    /**
     * Create url
     *
     * @param array $expected
     *
     * @throws ApiException
     *
     * @return $this
     */
    public function createUrl(array $expected = []): self
    {
        if ($this->getValidator() === null) {
            throw new ApiException(404, __('The method :method firstly needs validation.',
                ['method' => __METHOD__]));
        }

        if (!empty($expected)) {
            $this->entityFields = $expected;
        }

        $urlEntity = $this->urlMapper->createUrlData(current($this->getData()->get()), $this->entityFields);

        $urlEntity->setKey($this->keyEncode($urlEntity->getId()));

        $urlCollection = new UrlCollection;
        $urlCollection->add($this->urlMapper->updateUrlData($urlEntity, ['key']));

        $this->data = $urlCollection;

        return $this;
    }

    /**
     * Update url
     *
     * @param array $expected
     *
     * @throws ApiException
     *
     * @return $this
     */
    public function updateUrl(array $expected = []): self
    {
        if ($this->getValidator() === null) {
            throw new ApiException(404, __('The method :method firstly needs validation.',
                ['method' => __METHOD__]));
        }

        if (!empty($expected)) {
            $this->entityFields = $expected;
        }

        $urlCollection = new UrlCollection;
        $urlCollection->add($this->urlMapper->updateUrlData(current($this->getData()->get()), $this->entityFields));

        $this->data = $urlCollection;

        return $this;
    }

    /**
     * Get data
     *
     * @throws ApiException
     *
     * @return UrlCollection
     */
    public function getData(): UrlCollection
    {
        if ($this->data === null || empty($this->data->get())) {
            $this->notFoundException();
        }

        return $this->data;
    }

    private function keyEncode(int $id): string
    {
        $bijectiveObj = new Bijective;

        return $bijectiveObj->encode($id);
    }
}
