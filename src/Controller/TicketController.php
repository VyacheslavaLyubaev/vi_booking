<?php

namespace App\Controller;

use App\DTO\TicketDTO;
use App\Entity\Ticket;
use App\Form\Type\BookTicketType;
use App\Repository\FlightRepository;
use App\Repository\TicketRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TicketController extends AbstractController
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {

        $this->entityManager = $entityManager;
    }


    /**
     * @Route("/", name = "app.bookTicket")
     */
    public function bookTicketAction(Request $request, FlightRepository $flightRepository): Response
    {
        $ticketDto = new TicketDTO();
        $activeFlight = $flightRepository->findBy((['status' => '1']));

        $form = $this->createForm(BookTicketType::class, $ticketDto, [
            'action' => $this->generateUrl('app.bookTicket'),
            'activeFlight' => $activeFlight
        ]);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $ticket = Ticket::createFromDTO($ticketDto);
            $day = $ticket->getFlightDate()->format('w');
            $basePrice = $ticket->getFlight()->getBasePrice();
            if ($day == 7 || $day == 0) {
                $price = $basePrice * 2;
                $ticket->setPrice($price);
            } else {
                $ticket->setPrice($basePrice);
            }
            $this->entityManager->persist($ticket);
            $this->entityManager->flush();

            return $this->redirectToRoute('showTicket', [
                'id' => $ticket->getId()
            ]);
        }

        return $this->renderForm('app/bookTicket.html.twig', [
            'form' => $form,
        ]);
    }

    /**
     * @Route("/show/{id}", name = "showTicket")
     */
    public function showTicketAction(int $id, TicketRepository $ticketRepository): Response
    {
        $ticket = $ticketRepository->findById($id);

        return $this->renderForm('ticketShow.html.twig', [
            'ticket' => $ticket,
            'flight' => $ticket->getFlight()->getFlightData(),
            'customer' => $ticket->getCustomer(),
            'flightDate' => $ticket->getFlightDate(),
            'price' => $ticket->getPrice(),
            'status' => $ticket->getStatus()
        ]);
    }

}