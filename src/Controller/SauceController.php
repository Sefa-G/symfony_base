<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\SauceRepository;

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
}
