<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class InvestmentFirmController extends AbstractController
{
    #[Route('/firms/new')]
    public function new(): Response
    {
        dd('new investment firm');
    }
}