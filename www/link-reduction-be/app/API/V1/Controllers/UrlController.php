<?php

namespace App\API\V1\Controllers;

use App\API\V1\Adapters\MySQL\UrlMySQL;
use App\API\V1\Filters\UrlFilter;
use App\API\V1\Mappers\UrlMapper;
use App\API\V1\Services\UrlService;
use App\API\V1\Transformers\TransformerData;
use App\API\V1\Transformers\TransformerStrategy;
use App\API\V1\Validators\UrlValidator;
use App\Exceptions\ApiException;
use Illuminate\Database\QueryException;
use Illuminate\Http\JsonResponse as Response;
use Illuminate\Support\Facades\DB;

class UrlController extends BaseApiController
{
    /**
     * GET request
     *
     * @param mixed $key
     *
     * @throws \LogicException
     *
     * @return Response
     */
    public function getUrlFromKey($key = null): Response
    {
        try {
            $this->request->attributes->add(['key' => $key]);

            $urlService = new UrlService($this->request, new UrlMapper(UrlMySQL::class));
            $urlsData = $urlService->getUrls()->getData();

            $collectData = (new TransformerData($this->request))
                ->setArguments($urlService->getArguments())
                ->setData($urlsData)
            ;

            $transformerClassName = "App\API\V1\Transformers\\{$this->format}\Url{$this->format}";
            $specificationClassName = "App\API\V1\Classes\Specifications\\{$this->format}\Specification{$this->format}";
            $transformer = new TransformerStrategy(new $transformerClassName(new $specificationClassName));

            return response()->json($transformer->getTransformedData($collectData));
        } catch (ApiException $ae) {
            return $this->getApiException($ae);
        } catch (QueryException $e) {
            return $this->getQueryException($e, 'url');
        }
    }

    /**
     * POST request
     *
     * @throws ApiException|\Exception|\LogicException|\ReflectionException
     *
     * @return Response
     */
    public function createShortUrl(): Response
    {
        try {
            DB::connection()->beginTransaction();

            $urlService = new UrlService($this->request, new UrlMapper(UrlMySQL::class));
            $urlService
                ->getUrlFromRequest()
                ->filterUrl(new UrlFilter)
                ->validateUrl(new UrlValidator, ['url'])
                ->createUrl()
            ;

            $collectData = (new TransformerData($this->request))
                ->setArguments($urlService->getArguments())
                ->setData($urlService->getData())
            ;

            $transformerClassName = "App\API\V1\Transformers\\{$this->format}\Url{$this->format}";
            $specificationClassName = "App\API\V1\Classes\Specifications\\{$this->format}\Specification{$this->format}";
            $transformer = new TransformerStrategy(new $transformerClassName(new $specificationClassName));

            DB::connection()->commit();

            return response()->json($transformer->getTransformedData($collectData), 201);
        } catch (ApiException $ae) {
            DB::connection()->rollBack();

            return $this->wrongPropertyException($ae, $urlService, 'Url');
        } catch (QueryException $e) {
            DB::connection()->rollBack();

            return $this->getQueryException($e, 'url');
        }
    }
}
