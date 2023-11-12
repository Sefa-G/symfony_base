<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\OnionRepository;

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
}
