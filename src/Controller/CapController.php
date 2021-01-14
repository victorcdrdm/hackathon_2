<?php

namespace App\Controller;

use App\Entity\Challenge;
use App\Entity\Defi;
use App\Entity\User;
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
     * @Route("/index", name="_index")
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
     * @Route("/unknown/alea", name="_unknown_alea")
     */
    public function unknown(): Response
    {
        $unknownUsers = $this->getDoctrine()
            ->getRepository(User::class)
            ->findAll();
        $min = $unknownUsers[0]->getId();
        $max = $unknownUsers[count($unknownUsers)-1]->getId();

        $rand = $this->getUser()->getId();
        while($rand === $this->getUser()->getId()) {
            $rand = rand($min, $max);
        }
        $unknownUserId = $rand;

        $defis = $this->getDoctrine()
            ->getRepository(Defi::class)
            ->findAll();
        $aleaNumber = rand(0, count($defis)-1);
        $defi = $defis[$aleaNumber];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $challenge = new Challenge();
            $user = $this->getDoctrine()
                ->getRepository(User::class)
                ->find($this->getUser()->getId());
            $unknown = $this->getDoctrine()
                ->getRepository(User::class)
                ->find($_POST['catcher']);
            $challenge->setCreator($user);
            $challenge->setCatcher($unknown);
            $challenge->setIsSuccess('0');
            $defi = $this->getDoctrine()
                ->getRepository(Defi::class)
                ->find($_POST['id']);
            $challenge->setDefi($defi);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($challenge);
            $entityManager->flush();
            return $this->redirectToRoute('profile');

        }

        return $this->render('cap/unknown.html.twig', [
            'defi' => $defi,
            'unknown_user_id' => $unknownUserId,
        ]);
    }
}
