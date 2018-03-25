<?php

namespace BooksApi\RequestPerformer;

use BooksApi\LimitScope\LimitScope;
use BooksApi\LimitScope\LimitScopeInterface;
use BooksApi\LimitScope\NoLimitScope;
use BooksApi\Request\RequestInterface;
use BooksApi\Response\Response;
use BooksApi\Response\ResponseInterface;
use BooksApi\Response\Status;
use Buzz\Browser;
use RuntimeException;
use function json_decode;
use const JSON_ERROR_NONE;
use function json_last_error;
use function json_last_error_msg;

class RequestPerformer implements RequestPerformerInterface
{
    private $buzzBrowser;

    private const statusMap = [
        'OK' => Status::OK,
        'INVALID_REQUEST' => Status::INVALID_REQUEST,
        'NOT_FOUND' => Status::NOT_FOUND, // in documentation it is described as NOT_FOUND
        'NOT_EXIST' => Status::NOT_FOUND, // but actually API returns NOT_EXIST
    ];

    public function __construct(Browser $browser)
    {
        $this->buzzBrowser = $browser;
    }

    public function performRequest(
        string $mainUri,
        RequestInterface $request) :ResponseInterface
    {
        $response = $this->buzzBrowser->get($mainUri.$request->getUri());
        $parsedData = $this->parseData($response->getContent());
        $this->validateResponse($parsedData);
        return $this->transformData($request, $parsedData);
    }

    private function parseData(string $responseContents) :array
    {
        $responseData = json_decode($responseContents, true);

        if (json_last_error() !== JSON_ERROR_NONE)
            throw new RuntimeException('Failed parsing response: '. json_last_error_msg());

        return $responseData;
    }

    private function transformData(
        RequestInterface $request,
        array $parsedData) :ResponseInterface
    {
        return new Response(
            $this->createPayload($request, $parsedData),
            $this->createStatus($parsedData),
            $parsedData['data']['rows'] ?? 0,
            $this->createLimitScope($parsedData)
        );
    }

    private function createStatus(array $parsedData) :Status
    {
        if (!isset(self::statusMap[$parsedData['status']]))
            throw new RuntimeException('Unknown status "'.$parsedData['status'].'"');

        return new Status(
            self::statusMap[$parsedData['status']] ?? -1,
            $parsedData['message']
        );
    }

    private function validateResponse(array $parsedData) :void
    {
        $fields = [ 'status', 'message', 'data' ];

        foreach ($fields as $requiredField)
            if (!isset($parsedData[$requiredField]))
                throw new RuntimeException($requiredField.' is not present in the response');
    }

    private function createPayload(RequestInterface $request, array $parsedData) :array
    {
        $payloadData = $parsedData['data'][$request->getExpectedResponseField()] ?? [];

        if (!is_array($payloadData))
            throw new RuntimeException('data['.$request->getExpectedResponseField().'] '
                .'is not an array.');

        $transformer = $request->getTransformer();
        return array_map([$transformer, 'transformEntity'], $payloadData);
    }

    private function createLimitScope(array $payloadData) :LimitScopeInterface
    {
        if ($payloadData['status'] !== 'OK')
            return new NoLimitScope;

        return new LimitScope(
            $payloadData['data']['limit'],
            $payloadData['data']['offset']
        );
    }
}