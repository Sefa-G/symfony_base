<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\ReviewRepository;
use App\Repository\BurgerRepository;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Review;
use App\Form\ReviewType;

class ReviewController extends AbstractController
{
    #[Route('/review', name: 'app_review')]
    public function index(ReviewRepository $reviewRepository): Response
    {

        $reviews = $reviewRepository->findAll();

        return $this->render('review/index.html.twig', [
            'reviews' => $reviews,
        ]);
    }

    #[Route('/{id}/review', name: 'create_review', methods: ['GET', 'POST'])]
    public function creation(Request $request, EntityManagerInterface $em , BurgerRepository $burgerRepository , $id): Response
    {
        $review = new Review();
        $form = $this->createForm(ReviewType::class, $review);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $burger = $burgerRepository->find($id);
            $review->setBurger($burger);

            $em->persist($review);
            $em->flush();
    
            $this->addFlash('success', 'Commentaire créé!');
            return $this->redirectToRoute('show_burger' , ['id' => $id]);
        }
    
        return $this->render('review/add_review.html.twig', [
            'review' => $review,
            'form' => $form->createView()
        ]);
    }
}
