<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\OnionRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Onion;
use App\Form\OnionType;


class OnionController extends AbstractController
{
    #[Route('/onion', name: 'app_onion' , methods: ['GET'])]
    public function indexOnion(OnionRepository $onionRepository): Response
    {

        $onions = $onionRepository->findAll();

        return $this->render('onion/index.html.twig', [
            'onions' => $onions,
        ]);
    }

    #[Route('/onion/new', name: 'create_onion', methods: ['GET', 'POST'])]
    public function creation(Request $request, EntityManagerInterface $em): Response
    {
        $onion = new Onion();
        $form = $this->createForm(OnionType::class, $onion);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($onion);
            $em->flush();
    
            $this->addFlash('success', 'Oignon créé!');
            return $this->redirectToRoute('app_onion');
        }
    
        return $this->render('onion/add_onion.html.twig', [
            'onion' => $onion,
            'form' => $form->createView()
        ]);
    }

}
