<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\BurgerRepository;
use App\Repository\ReviewRepository;
use App\Repository\OnionRepository;
use App\Repository\SauceRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Burger;
use App\Form\BurgerType;
use Symfony\Component\HttpKernel\KernelInterface;
use App\Entity\Image;

class BurgerController extends AbstractController
{
    #[Route('/burger_list', name: 'app_burger')]
    public function index(BurgerRepository $burgerRepository): Response
    {

        $burgers = $burgerRepository->findAll();

        return $this->render('burger/index.html.twig', [
            'burgers' => $burgers,
        ]);

    }

    #[Route('/burger_list/new', name: 'create_burger', methods: ['GET', 'POST'])]
    public function creation(Request $request, EntityManagerInterface $em , KernelInterface $kernel): Response
    {
        $burger = new Burger();
        $form = $this->createForm(BurgerType::class, $burger);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $image = $form->get('image')->getData();

            $fichier = md5(uniqid()) . '.' . $image->guessExtension();

            try {
                $image->move(
                    $kernel->getProjectDir().'/public/img',
                    $fichier
                );
            } catch (FileException $e) {
            }

            $img = new Image();
            $img->setSource($fichier);
            $burger->setImage($img);

            $em->persist($burger);
            $em->flush();
    
            $this->addFlash('success', 'Burger créé!');
            return $this->redirectToRoute('app_burger');
        }
    
        return $this->render('burger/add_burger.html.twig', [
            'burger' => $burger,
            'form' => $form->createView()
        ]);
    }

    #[Route('/burger_list/{id}', name: 'show_burger', methods: ['GET'])]
    public function show(Request $request, BurgerRepository $burgerRepository, ReviewRepository $reviewRepository, OnionRepository $onionRepository, SauceRepository $sauceRepository, $id): Response
    {
        $burger = $burgerRepository->find($id);
        $reviews = $reviewRepository->findBy(array('burger' => $id));
        $onions = $onionRepository->findOnionsByBurger($burger);
        $sauces = $sauceRepository->findSaucesByBurger($burger);

        return $this->render('burger/detail_burger.html.twig', [
            'burger' => $burger,
            'reviews' => $reviews,
            'onions' => $onions,
            'sauces' => $sauces,
        ]);
    }
}
