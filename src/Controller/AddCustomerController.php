<?php

namespace App\Controller;

use App\DTO\CustomerDTO;
use App\Entity\Customer;
use App\Form\Type\AddCustomerType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;


class AddCustomerController extends AbstractController
{

    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {

        $this->entityManager = $entityManager;
    }

    /**
     * @Route("/add-customer", name="app.addCustomer")
     */
    public function addCustomerAction(Request $request, ValidatorInterface $validator): Response
    {
        $customerDto = new CustomerDTO();

        $form = $this->createForm(AddCustomerType::class, $customerDto, [
            'action' => $this->generateUrl('app.addCustomer')
        ]);

        $form->handleRequest($request);



        if ($form->isSubmitted() && $form->isValid()) {
            $customerEntity = Customer::createFromDTO($customerDto);
            $this->entityManager->persist($customerEntity);
            $this->entityManager->flush();

            return $this->redirectToRoute('app.bookTicket');
        }

        return $this->render('app/addCustomer.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}