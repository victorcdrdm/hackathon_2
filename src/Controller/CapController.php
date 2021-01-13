<?php

namespace App\Controller;

use App\Entity\Defi;
use App\Form\DefiType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/cap", name="cap")
 */
class CapController extends AbstractController
{
    /**
     * @Route("/index", name="index")
     */
    public function index(): Response
    {

        return $this->render('cap/index.html.twig', [
        ]);
    }

    /**
     * @Route("/friends", name="_friends")
     */
    public function new(Request $request): Response
    {
        $form = $this->createForm(DefiType::class);
        $form->handleRequest($request);

        return $this->render('cap/friends.html.twig', [
            'form' => $form->createView(),
       ]);
    }

    /**
     * @Route("/unknown", name="_unknown")
     */
    public function unknown(): Response
    {
        $defis = $this->getDoctrine()
            ->getRepository(Defi::class)
            ->findAll();
        $aleaNumber = rand(0, count($defis)-1);
        $defi = $defis[$aleaNumber];
        return $this->render('cap/unknown.html.twig', [
            'defi' => $defi,
        ]);
    }
}
