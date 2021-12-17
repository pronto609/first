<?php

declare(strict_types=1);

namespace Weather\Lublin\Model;

use GuzzleHttp\ClientFactory;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Psr7\ResponseFactory;
use Magento\Framework\App\Response\Http;
use Magento\Framework\Webapi\Rest\Request;
use Psr\Log\LoggerInterface;
use Weather\Lublin\Provider\ConfigProvider;

/**
 * Class GitApiService
 */
class WeatherDownloader
{
    private ResponseFactory $responseFactory;

    private ClientFactory $clientFactory;

    private ConfigProvider $configProvider;

    private LoggerInterface $logger;

    /**
     * GitApiService constructor
     *
     * @param ClientFactory $clientFactory
     * @param ResponseFactory $responseFactory
     * @param ConfigProvider $configProvider
     * @param LoggerInterface $logger
     */
    public function __construct(
        ClientFactory   $clientFactory,
        ResponseFactory $responseFactory,
        ConfigProvider  $configProvider,
        LoggerInterface $logger
    ) {
        $this->clientFactory = $clientFactory;
        $this->responseFactory = $responseFactory;
        $this->configProvider = $configProvider;
        $this->logger = $logger;
    }

    /**
     * Fetch some data from API
     */
    public function execute(): array
    {
        if (!$this->configProvider->isEnabled()) {
            return [];
        }

        $endpoint = $this->configProvider->getApiEndpoint();
        $apiKey = $this->configProvider->getApiKey();
        $city = $this->configProvider->getCity();

        $params = [
            'key' => $apiKey,
            'q' => $city
        ];
        $response = $this->doRequest($endpoint, $params);
        $status = $response->getStatusCode(); // 200 status code
//        var_dump(get_class_methods($response));die();
        if ($status !== Http::STATUS_CODE_200) {
            $this->logger->warning($response->getReasonPhrase());
        }
        $responseBody = $response->getBody();
        $responseContent = $responseBody->getContents();
        if ($responseContent) {
            return json_decode($responseContent, true) ?? [];
        }
        return [];
    }

    /**
     * Do API request with provided params
     *
     * @param string $uriEndpoint
     * @param array $params
     * @param string $requestMethod
     *
     * @return Response
     */
    private function doRequest(
        string $uriEndpoint,
        array  $params = [],
        string $requestMethod = Request::HTTP_METHOD_GET
    ): Response
    {
        $client = $this->clientFactory->create(['config' => [
            'base_uri' => $uriEndpoint
        ]]);

        try {
            $response = $client->request(
                $requestMethod,
                $uriEndpoint,
                ['query' => $params]
            );
        } catch (GuzzleException $exception) {
            $response = $this->responseFactory->create([
                'status' => $exception->getCode(),
                'reason' => $exception->getMessage()
            ]);
        }

        return $response;
    }
}
