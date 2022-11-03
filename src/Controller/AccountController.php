<?php

namespace App\Controller;

use App\Controller\Api\AccountApiController;
use App\Entity\Account;
use Exception;
use JsonException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\HttpClient\Exception\DecodingExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class AccountController extends AbstractController
{
    private AccountApiController $api;

    public function __construct()
    {
        $this->api = new AccountApiController();
    }

    /**
     * @throws Exception
     * @throws TransportExceptionInterface|DecodingExceptionInterface
     */
    #[Route('/', name: 'accounts')]
    public function index(HttpClientInterface $http_client): Response
    {
        $response = $http_client->request('GET', 'https://raw.githubusercontent.com/ApexMuse/Investments/main/accounts.json');
        $responseContent = $response->toArray();

        $total_value = 0.00;
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
            $total_value += $account['value'];
            $accounts[] = $account;
        }

        return $this->render('account/index.html.twig', [
            'title' => 'Accounts',
            'accounts' => $accounts,
            'total_value' => $total_value
        ]);
    }

    /**
     * @throws JsonException
     */
    #[Route('/accounts/{account_id}', name: 'show-account')]
    public function show(int $account_id): Response
    {
        $account = json_decode($this->api->find($account_id)->getContent(), true, 512, JSON_THROW_ON_ERROR);

        return $this->render('account/show.html.twig', [
            'title' => $account['name'],
            'account' => $account
        ]);
    }
}