<?php

namespace App\Services\VBase2;

use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\RequestOptions;

class Api
{
    protected $client;

    protected $baseUri = 'http://www.vbase2.org';

    protected $requestUri = [
        'dnaplot' => '/cgi-bin/vsearch_vbase2.pl',
    ];

    public function __construct(GuzzleClient $client)
    {
        $this->client = $client;
    }

    public function dnaPlot(string $sequence)
    {
        $requestUrl = $this->baseUri . $this->requestUri['dnaplot'];

        $options = [
            RequestOptions::FORM_PARAMS => [
                'input' => $sequence,
            ],
        ];

        return $this->request('POST', $requestUrl, $options);
    }

    protected function request($method, $uri, array $options = [])
    {
        try {
            /* @var GuzzleHttp\Psr7\Response */
            $response = $this->client->request($method, $uri, $options);
            return $response->getBody()->getContents();
        } catch (GuzzleRequestException $e) {
            print_r($e->getMessage());
        }
    }
}
