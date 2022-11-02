<?php

namespace App\Controller\Api;

use JsonException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AccountApiController extends AbstractController
{
    public array $accounts;

    public function __construct()
    {
        $this->accounts = [
            1 => [
                'name' => 'Todd Roth',
                'account_type' => 'Roth IRA',
                'institution' => 'Fidelity Investments',
                'institution_url' => 'https://oltx.fidelity.com/',
                'owner' => 'Todd Twiggs',
                'account_number' => '239147938',
                'value' => 20788.94
            ],
            2 => [
                'name' => 'Emily Roth',
                'account_type' => 'Roth IRA',
                'institution' => 'Fidelity Investments',
                'institution_url' => 'https://oltx.fidelity.com/',
                'owner' => 'Emily Twiggs',
                'account_number' => '233720188',
                'value' => 11555.71
            ],
            3 => [
                'name' => 'Rollover',
                'account_type' => 'Roth IRA',
                'institution' => 'Fidelity Investments',
                'institution_url' => 'https://oltx.fidelity.com/',
                'owner' => 'Todd Twiggs',
                'account_number' => '241287736',
                'value' => 32137.72
            ],
            4 => [
                'name' => 'QEC',
                'account_type' => '401K',
                'institution' => 'Fidelity Investments',
                'institution_url' => 'https://oltx.fidelity.com/',
                'owner' => 'Emily Twiggs',
                'account_number' => '70377',
                'value' => 835.45
            ],
            5 => [
                'name' => 'Firebrand',
                'account_type' => '401K',
                'institution' => 'Transamerica',
                'institution_url' => 'https://participant.transamerica.com/',
                'owner' => 'Todd Twiggs',
                'account_number' => '801461-00000',
                'value' => 1199.37
            ],
            6 => [
                'name' => 'Window World',
                'account_type' => '401K',
                'institution' => 'Vanguard',
                'institution_url' => 'https://my.vanguardplan.com/',
                'owner' => 'Todd Twiggs',
                'account_number' => '251313',
                'value' => 14989.05
            ]
        ];
    }

    /**
     * @throws JsonException
     */
    #[Route('/api/accounts', name: 'api_accounts_all', methods: ['GET'])]
    public function all(): Response
    {
        return new Response(json_encode($this->accounts, JSON_THROW_ON_ERROR), 200);
    }

    /**
     * @throws JsonException
     */
    #[Route('/api/accounts/{id<\d+>}', name: 'api_accounts_find', methods: ['GET'])]
    public function find(int $id): Response
    {
        return new Response(json_encode($this->accounts[$id], JSON_THROW_ON_ERROR), 200);
    }
}