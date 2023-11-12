<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BurgerController extends AbstractController
{
    #[Route('/burger_list', name: 'app_burger')]
    public function index(): Response
    {

        $burgers = "";

        return $this->render('burger/index.html.twig', [
            'burgers' => $burgers,
        ]);

    }
}
