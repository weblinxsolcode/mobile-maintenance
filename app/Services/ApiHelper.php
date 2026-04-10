<?php

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Facades\Http;

class ApiHelper
{
    /**
     * Make an HTTP request to an API endpoint.
     *
     * @param string $method HTTP method (GET, POST, PUT, DELETE, PATCH)
     * @param string $endpoint API endpoint URL
     * @param array $params Query parameters
     * @param array $body Request body data
     * @param array $headers Custom headers
     * @param int $timeout Request timeout in seconds
     * @return array|string Response data
     * @throws \Exception
     */
    public static function hitApi(
        string $method,
        string $endpoint,
        array $params = [],
        array $body = [],
        array $headers = [],
        int $timeout = 30
    ) {
        try {
            $method = strtoupper($method);
            $allowedMethods = ['GET', 'POST', 'PUT', 'DELETE', 'PATCH'];

            if (!in_array($method, $allowedMethods)) {
                throw new \InvalidArgumentException(
                    "Invalid HTTP method: $method. Allowed methods: " . implode(', ', $allowedMethods)
                );
            }

            $client = new Client(['timeout' => $timeout]);

            $defaultHeaders = [
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ];

            $finalHeaders = array_merge($defaultHeaders, $headers);

            $options = [
                'headers' => $finalHeaders,
            ];

            // Add query parameters for GET requests
            if (!empty($params)) {
                $options['query'] = $params;
            }

            // Add body for POST, PUT, PATCH requests
            if (in_array($method, ['POST', 'PUT', 'PATCH']) && !empty($body)) {
                $options['json'] = $body;
            }

            $response = $client->request($method, $endpoint, $options);

            $responseBody = $response->getBody()->getContents();

            // Try to decode JSON
            $decodedData = json_decode($responseBody, true);
            if (json_last_error() === JSON_ERROR_NONE) {
                return $decodedData;
            }

            return $responseBody;
        } catch (RequestException $e) {
            throw new \Exception(
                "API request failed: " . $e->getMessage(),
                $e->getCode(),
                $e
            );
        }
    }

    /**
     * Make a GET request using Laravel Http facade.
     *
     * @param string $url
     * @param array $params
     * @param array $headers
     * @return \Illuminate\Http\Client\Response
     */
    public static function get(string $url, array $params = [], array $headers = [])
    {
        return Http::withHeaders($headers)->get($url, $params);
    }

    /**
     * Make a POST request using Laravel Http facade.
     *
     * @param string $url
     * @param array $data
     * @param array $headers
     * @return \Illuminate\Http\Client\Response
     */
    public static function post(string $url, array $data = [], array $headers = [])
    {
        return Http::withHeaders($headers)->post($url, $data);
    }

    /**
     * Make a PUT request using Laravel Http facade.
     *
     * @param string $url
     * @param array $data
     * @param array $headers
     * @return \Illuminate\Http\Client\Response
     */
    public static function put(string $url, array $data = [], array $headers = [])
    {
        return Http::withHeaders($headers)->put($url, $data);
    }

    /**
     * Make a DELETE request using Laravel Http facade.
     *
     * @param string $url
     * @param array $data
     * @param array $headers
     * @return \Illuminate\Http\Client\Response
     */
    public static function delete(string $url, array $data = [], array $headers = [])
    {
        return Http::withHeaders($headers)->delete($url, $data);
    }

    /**
     * Make a PATCH request using Laravel Http facade.
     *
     * @param string $url
     * @param array $data
     * @param array $headers
     * @return \Illuminate\Http\Client\Response
     */
    public static function patch(string $url, array $data = [], array $headers = [])
    {
        return Http::withHeaders($headers)->patch($url, $data);
    }
}

