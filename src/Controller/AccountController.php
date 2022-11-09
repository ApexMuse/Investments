<?php

namespace App\Controller;

use App\Repository\AccountRepositoryOld;
use Exception;
use JsonException;
use Psr\Cache\InvalidArgumentException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AccountController extends AbstractController
{
    public function __construct(
        private AccountRepositoryOld $account_repository
    ) {}

    /**
     * @throws Exception|InvalidArgumentException
     */
    #[Route('/', name: 'accounts')]
    public function index(): Response
    {
        $accounts = $this->account_repository->findAll();

        return $this->render('account/index.html.twig', [
            'title' => 'Accounts',
            'accounts' => $accounts
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