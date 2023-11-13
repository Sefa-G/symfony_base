<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\ReviewRepository;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Review;

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
}
