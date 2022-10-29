<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use function Symfony\Component\String\u;

class AccountController
{
    #[Route('/accounts/{slug}')]
    public function accounts(?string $slug = null): Response
    {
        if ($slug) {
            $title = 'Account: ' . u(str_replace('-', ' ', $slug))->title(true)->__toString();
        }
        else {
            $title = 'All Accounts';
        }

        return new Response($title, 200);
    }
}