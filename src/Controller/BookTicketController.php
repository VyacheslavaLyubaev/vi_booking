<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BookTicketController extends AbstractController
{
    /**
     * @Route("/", name = "app.bookTicket")
     */
    public function bookTickerAction(Request $request): Response
    {
        echo "123";
    }

}