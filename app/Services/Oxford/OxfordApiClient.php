<?php

namespace App\Services\Oxford;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Contracts\Config\Repository as Config;
use Illuminate\Support\Collection;

class OxfordApiClient
{
    protected $baseUrl = 'https://od-api.oxforddictionaries.com/api/v1';

    /* @var Client */
    protected $client;

    /* @var array */
    protected $config;

    public function __construct(Client $client, Config $config)
    {
        $this->config = $config->get('oxford');
        $this->client = $client;
    }

    public function getEntries(string $wordId)
    {
        $requestUrl = $this->baseUrl . '/entries/en/' . $wordId;
        $options = ['headers' => $this->getDefaultHeaders()];
        return $this->parseResults($this->request('GET', $requestUrl, $options));
    }

    protected function parseResults(array $results)
    {
        $data = new Collection();
        foreach ($results as $result) {
            foreach ($result['lexicalEntries'] as $lexical) {
                foreach ($lexical['entries'] as $entry) {
                    foreach ($entry['senses'] as $sense) {
                        if (isset($sense['definitions'])) {
                            $data->push($this->buildSense($sense));
                        }
                    }
                }
            }
        }
        return $data;
    }

    private function buildSense(array $sense)
    {
        $definition = $sense['definitions'][0];
        $examples = [];
        if (isset($sense['examples'])) {
            foreach ($sense['examples'] as $example) {
                $examples[] = $example['text'];
            }
        }
        return new Sense($definition, $examples);
    }

    protected function request(string $method, string $uri, array $options = [])
    {
        try {
            $response = $this->client->request($method, $uri, $options);
            $result = json_decode($response->getBody(), true);
            return $result['results'];
        } catch (RequestException $e) {
            logger($e->getMessage());
            throw $e;
        }
    }

    protected function getDefaultHeaders()
    {
        return ['Accept' => 'application/json'] + $this->config;
    }
}
