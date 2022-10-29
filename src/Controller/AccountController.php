<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use function Symfony\Component\String\u;

class AccountController extends AbstractController
{
    #[Route('/accounts')]
    public function index(): Response
    {
        $accounts = [
            [
                'name' => 'Todd\'s Roth IRA',
                'institution' => 'Fidelity Investments',
                'owner' => 'Todd Twiggs',
                'account_number' => '239147938',
                'total' => '$20,788.94'
            ],
            [
                'Name' => 'Emily\'s Roth IRA',
                'institution' => 'Fidelity Investments',
                'owner' => 'Emily Twiggs',
                'account_number' => '233720188',
                'total' => '$11,555.71'
            ],
            [
                'name' => 'QEC 401k',
                'institution' => 'Fidelity Investments',
                'owner' => 'Emily Twiggs',
                'account_number' => '70377',
                'total' => '$835.45'
            ],
            [
                'name' => 'Firebrand 401k',
                'institution' => 'Transamerica',
                'owner' => 'Todd Twiggs',
                'account_number' => '801461-00000',
                'total' => '$1,199.37'
            ],
        ];

        return $this->render('account/index.html.twig', [
            'title' => 'Accounts',
            'accounts' => $accounts
        ]);
    }

    #[Route('/accounts/{slug}')]
    public function show(string $slug): Response
    {
        return $this->render('account/index.html.twig', [
            'title' => ucwords(str_replace('-', ' ', $slug))
        ]);
    }
}