<?php

namespace App\Controller;

use App\Form\Type\BookTicketType;
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
        $form = $this->createForm(BookTicketType::class, [
            'action' => $this->generateUrl('app.addCustomer')
        ]);
        return $this->render('app/bookTicket.html.twig', [
            'form' => $form->createView(),
        ]);
    }

}