<?php

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class SupabaseService
{
    protected string $baseUrl;
    protected string $apiKey;
    protected Client $httpClient;

    public function __construct()
    {
        // Ensure trailing slash is removed
        $this->baseUrl = rtrim(config('services.supabase.url'), '/');
        
        // Use the correct secret key for backend/admin panel
        $this->apiKey  = config('services.supabase.key');
        
        if (empty($this->baseUrl) || empty($this->apiKey)) {
            throw new \RuntimeException('Supabase configuration is missing. Check your .env and services.php.');
        }
        
        $this->httpClient = new Client([
            'base_uri' => $this->baseUrl . '/rest/v1/',
            'headers' => [
                'apikey' => $this->apiKey,
                'Authorization' => 'Bearer ' . $this->apiKey,
                'Content-Type' => 'application/json',
                'Prefer' => 'return=representation',
            ],
        ]);
    }

    public function from(string $table): SupabaseTable
    {
        return new SupabaseTable($this->httpClient, $table);
    }
}

class SupabaseTable
{
    protected Client $httpClient;
    protected string $table;
    protected array $queryParams = [];
    protected array $body = [];
    protected string $method = 'GET';

    public function __construct(Client $httpClient, string $table)
    {
        $this->httpClient = $httpClient;
        $this->table = $table;
    }

    public function select(string $columns = '*'): self
    {
        $this->method = 'GET';
        $this->queryParams['select'] = $columns;
        return $this;
    }

    public function eq(string $column, $value): self
    {
        $this->queryParams[$column] = 'eq.' . $value;
        return $this;
    }

    public function insert(array $data): self
    {
        $this->method = 'POST';
        $this->body = $data;
        return $this;
    }

    public function update(array $data): self
    {
        $this->method = 'PATCH';
        $this->body = $data;
        return $this;
    }

    public function delete(): self
    {
        $this->method = 'DELETE';
        return $this;
    }

    public function execute()
    {
        try {
            $options = [];
            
            // Add query parameters for GET, PATCH, DELETE
            if ($this->method !== 'POST' && !empty($this->queryParams)) {
                $options['query'] = $this->queryParams;
            }
            
            // Add body for POST and PATCH
            if (in_array($this->method, ['POST', 'PATCH']) && !empty($this->body)) {
                $options['json'] = $this->body;
            }
            
            $response = $this->httpClient->request($this->method, $this->table, $options);
            $data = json_decode($response->getBody(), true);
            
            return new class($data) {
                protected $data;
                
                public function __construct($data)
                {
                    $this->data = $data;
                }
                
                public function getData()
                {
                    return $this->data;
                }
            };
            
        } catch (RequestException $e) {
            $response = $e->getResponse();
            $errorBody = $response ? $response->getBody()->getContents() : 'No response';
            
            throw new \RuntimeException(
                'Supabase request failed: ' . $e->getMessage() . 
                ' Response: ' . $errorBody
            );
        }
    }
}