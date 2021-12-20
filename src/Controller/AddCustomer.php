<?php

namespace App\Controller;

use App\Entity\Customer;
use App\Form\Type\AddCustomerType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class AddCustomer extends AbstractController
{

    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {

        $this->entityManager = $entityManager;
    }

    /**
     * @Route("/add-customer", name="app.addCustomer")
     */
    public function registrationAction(Request $request): Response
    {
        $customer = new Customer();

        $form = $this->createForm(AddCustomerType::class, $customer,[
            'action'=>$this->generateUrl('app.addCustomer')
        ]);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $this->entityManager->persist($customer);
            $this->entityManager->flush();
        }

        return $this->render('app/addCustomer.html.twig',[
            'form' => $form->createView(),
        ]);
    }
}