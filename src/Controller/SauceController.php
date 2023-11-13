<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\SauceRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Sauce;
use App\Form\SauceType;

class SauceController extends AbstractController
{
    #[Route('/sauce', name: 'app_sauce')]
    public function indexSauce(SauceRepository $sauceRepository): Response
    {

        $sauces = $sauceRepository->findAll();

        return $this->render('sauce/index.html.twig', [
            'sauces' => $sauces,
        ]);
    }

    #[Route('/sauce/new', name: 'create_sauce', methods: ['GET', 'POST'])]
    public function creation(Request $request, EntityManagerInterface $em): Response
    {
        $sauce = new Sauce();
        $form = $this->createForm(SauceType::class, $sauce);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($sauce);
            $em->flush();
    
            $this->addFlash('success', 'Sauce créée!');
            return $this->redirectToRoute('app_sauce');
        }
    
        return $this->render('sauce/add_sauce.html.twig', [
            'sauce' => $sauce,
            'form' => $form->createView()
        ]);
    }
}
