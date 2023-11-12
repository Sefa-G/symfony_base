<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ImageRepository;

class ImageController extends AbstractController
{
    #[Route('/image', name: 'app_image')]
    public function indexImage(ImageRepository $imageRepository): Response
    {

        $images = $imageRepository->findAll();

        return $this->render('image/index.html.twig', [
            'images' => $images,
        ]);
    }
}
