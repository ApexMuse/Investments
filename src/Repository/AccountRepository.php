<?php

namespace App\Repository;

use Exception;
use Psr\Cache\InvalidArgumentException;
use Symfony\Contracts\Cache\CacheInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class AccountRepository
{
    public function __construct(
        private readonly HttpClientInterface $github_http_client,
        private readonly CacheInterface $cache
    ) {}

    /**
     * @throws InvalidArgumentException
     * @throws Exception
     */
    public function findAll(): array
    {
        $responseContent = $this->cache->get('accounts', function () {
            return $this->github_http_client->request('GET', '/ApexMuse/Investments/main/accounts.json')->toArray();
        });

        $accounts = [];
        $time_properties = [
            'created_at',
            'updated_at',
            'deleted_at',
        ];

        foreach ($responseContent as $item) {
            $account = [];
            foreach ($item as $key => $value) {
                if ($value && in_array($key, $time_properties, true)) {
                    $account[$key] = new \DateTime($value);
                }
                else {
                    $account[$key] = $value;
                }
            }
            $accounts[] = $account;
        }

        return $accounts;
    }
}