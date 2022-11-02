<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AccountController extends AbstractController
{
    #[Route('/accounts', name: 'accounts')]
    public function index(): Response
    {
        $accounts = [
            [
                'name' => 'Todd\'s Roth',
                'account_type' => 'Roth IRA',
                'institution' => 'Fidelity Investments',
                'institution_url' => 'https://oltx.fidelity.com/',
                'owner' => 'Todd Twiggs',
                'account_number' => '239147938',
                'value' => 20788.94
            ],
            [
                'name' => 'Emily\'s Roth',
                'account_type' => 'Roth IRA',
                'institution' => 'Fidelity Investments',
                'institution_url' => 'https://oltx.fidelity.com/',
                'owner' => 'Emily Twiggs',
                'account_number' => '233720188',
                'value' => 11555.71
            ],
            [
                'name' => 'Rollover',
                'account_type' => 'Roth IRA',
                'institution' => 'Fidelity Investments',
                'institution_url' => 'https://oltx.fidelity.com/',
                'owner' => 'Todd Twiggs',
                'account_number' => '241287736',
                'value' => 32137.72
            ],
            [
                'name' => 'QEC',
                'account_type' => '401K',
                'institution' => 'Fidelity Investments',
                'institution_url' => 'https://oltx.fidelity.com/',
                'owner' => 'Emily Twiggs',
                'account_number' => '70377',
                'value' => 835.45
            ],
            [
                'name' => 'Firebrand',
                'account_type' => '401K',
                'institution' => 'Transamerica',
                'institution_url' => 'https://participant.transamerica.com/',
                'owner' => 'Todd Twiggs',
                'account_number' => '801461-00000',
                'value' => 1199.37
            ],
            [
                'name' => 'Window World',
                'account_type' => '401K',
                'institution' => 'Vanguard',
                'institution_url' => 'https://my.vanguardplan.com/',
                'owner' => 'Todd Twiggs',
                'account_number' => '251313',
                'value' => 14989.05
            ],
        ];

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

    #[Route('/accounts/{account_name}')]
    public function show(string $account_name): Response
    {
        return $this->render('account/index.html.twig', [
            'title' => ucwords(str_replace('-', ' ', $account_name))
        ]);
    }
}