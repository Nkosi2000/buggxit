<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class SupabaseTable
{
    protected string $baseUrl;
    protected string $apiKey;
    protected string $table;
    protected array $query = [];

    public function __construct(string $baseUrl, string $apiKey, string $table)
    {
        $this->baseUrl = rtrim($baseUrl, '/');
        $this->apiKey  = $apiKey;
        $this->table   = $table;
    }

    protected function headers(): array
    {
        return [
            'apikey'        => $this->apiKey,
            'Authorization' => 'Bearer ' . $this->apiKey,
            'Content-Type'  => 'application/json',
            'Accept'        => 'application/json',
            'Prefer'        => 'return=representation', // ensures Supabase returns affected rows
        ];
    }

    // Filtering helper
    public function eq(string $column, $value)
    {
        $this->query[$column] = "eq.$value";
        return $this;
    }

    public function select(string $columns = '*')
    {
        $this->query['select'] = $columns;
        return $this->get();
    }

    public function limit(int $n)
    {
        $this->query['limit'] = $n;
        return $this;
    }

    public function orderBy(string $col, string $dir = 'asc')
    {
        $this->query['order'] = "{$col}.{$dir}";
        return $this;
    }

    public function get()
    {
        $res = Http::withHeaders($this->headers())
            ->get("{$this->baseUrl}/rest/v1/{$this->table}", $this->query);

        return $res->json() ?? [];
    }

    public function insert(array $data)
    {
        $res = Http::withHeaders($this->headers())
            ->post("{$this->baseUrl}/rest/v1/{$this->table}?select=*", $data);

        return $res->json() ?? [];
    }

    public function update(array $data, array $filters)
    {
        $query = http_build_query($filters);

        $url = "{$this->baseUrl}/rest/v1/{$this->table}?select=*&{$query}";

        $res = Http::withHeaders($this->headers())
            ->patch($url, $data);

        return $res->json() ?? [];
    }


    public function delete(array $filters)
    {
        $query = http_build_query($filters);

        $url = "{$this->baseUrl}/rest/v1/{$this->table}?select=*&{$query}";

        $res = Http::withHeaders($this->headers())
            ->delete($url);

        return $res->json() ?? [];
    }
}