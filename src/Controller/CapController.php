<?php

namespace App\Controller;

use App\Form\DefiType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/cap", name="cap_")
 */
class CapController extends AbstractController
{
    /**
     * @Route("/new", name="new")
     */
    public function new(Request $request): Response
    {
        $form = $this->createForm(DefiType::class);
        $form->handleRequest($request);

        return $this->render('cap/new.html.twig', [
            'form' => $form->createView(),
       ]);
    }

    /**
     * @Route("/alea", name="alea")
     */
    public function alea(): Response
    {
        return $this->redirectToRoute('program_index');
    }
}
