<?php

namespace App\Controller;

use App\Entity\Bread;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\BreadRepository;
use App\Form\BreadType;

class BreadController extends AbstractController
{
    #[Route('/bread', name: 'app_bread' , methods: ['GET'])]
    public function indexBread(BreadRepository $breadRepository): Response
    {

        $breads = $breadRepository->findAll();

        return $this->render('bread/index.html.twig', [
            'breads' => $breads,
        ]);
    }

    #[Route('/bread/new', name: 'create_bread', methods: ['GET', 'POST'])]
    public function creation(Request $request, EntityManagerInterface $em): Response
    {
        $bread = new Bread();
        $form = $this->createForm(BreadType::class, $bread);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($bread);
            $em->flush();
    
            $this->addFlash('success', 'Pain créé!');
            return $this->redirectToRoute('app_bread');
        }
    
        return $this->render('bread/add_bread.html.twig', [
            'bread' => $bread,
            'form' => $form->createView()
        ]);
    }

}
