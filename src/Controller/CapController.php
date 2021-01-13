<?php

namespace App\Controller;

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
     * @Route("/index", name="")
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
     * @Route("/alea", name="_alea")
     */
    public function alea(): Response
    {

        return $this->redirectToRoute('cap_unknown');
    }
}
