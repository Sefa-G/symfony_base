<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\BreadRepository;

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
}
