<?php

namespace App\Controller;

use App\Controller\Api\AccountApiController;
use JsonException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AccountController extends AbstractController
{
    private AccountApiController $api;

    public function __construct()
    {
        $this->api = new AccountApiController();
    }

    /**
     * @throws JsonException
     */
    #[Route('/', name: 'accounts')]
    public function index(): Response
    {
        $accounts = json_decode($this->api->all()->getContent(), true, 512, JSON_THROW_ON_ERROR);

        $total_value = 0.00;
        foreach ($accounts as $account) {
            $total_value += $account['value'];
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