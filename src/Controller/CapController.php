<?php

namespace App\Controller;

use App\Entity\Challenge;
use App\Form\DefiType;
use App\Form\SucesseType;
use App\Repository\ChallengeRepository;
use App\Repository\DefiRepository;
use App\Repository\UserRepository;
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
     * @Route("/{id}", name="challenge", methods={"GET"})
     */
    public function toDo(Request $request, int $id , ChallengeRepository $challengeRepository, UserRepository $userRepository, DefiRepository $defiRepository): Response
    {
        $challenge = $challengeRepository->findOneBy(['id'=> $id]);
        $creator = $userRepository->findOneBy(['id' => $challenge->getCreator()]);
        $defi = $defiRepository->findOneBy(['id' => $challenge->getDefi()]);
        $creator= $creator->getUsername();

        $form = $this->createForm(SucesseType::class);
        $form->handleRequest($request);

        return $this->render('cap/todo.html.twig', [
            'defi' => $defi,
            'creator' => $creator,
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
