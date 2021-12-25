<?php

namespace App\Controller;

use App\DTO\FlightDTO;
use App\DTO\TicketDTO;
use App\Entity\Ticket;
use App\Form\Type\BookTicketType;
use App\Repository\FlightRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BookTicketController extends AbstractController
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
            $this->entityManager->persist($ticket);
            $this->entityManager->flush();

            return $this->redirectToRoute('app.bookTicket');
        }

       return $this->renderForm('app/bookTicket.html.twig',[
           'form' => $form,
       ]);
    }

}