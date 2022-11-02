<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractController
{
    #[Route('/', name: 'dashboard')]
    public function index(): Response
    {
        $accounts = [
            [
                'name' => 'Todd\'s Roth IRA',
                'value' => 20788.94
            ],
            [
                'name' => 'Emily\'s Roth IRA',
                'value' => 11555.71
            ],
            [
                'name' => 'Rollover IRA',
                'value' => 32137.72
            ],
            [
                'name' => 'QEC 401K',
                'value' => 835.45
            ],
            [
                'name' => 'Firebrand 401K',
                'value' => 1199.37
            ],
            [
                'name' => 'Window World 401K',
                'value' => 14989.05
            ],
        ];

        $total_value = 0.00;
        foreach ($accounts as $account) {
            $total_value += $account['value'];
        }

        return $this->render('dashboard/index.html.twig', [
            'title' => 'Dashboard',
            'accounts' => $accounts,
            'total_value' => $total_value
        ]);
    }
}