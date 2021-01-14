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
     * @Route("/index", name="index")
     */
    public function index(): Response
    {

        return $this->render('cap/index.html.twig', [
        ]);
    }

    /**
     * @Route("/unknown/new", name="unknown_new")
     */
    public function unknownNew(Request $request): Response
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
        $unknownUser = $this->getDoctrine()
            ->getRepository(User::class)
            ->find($unknownUserId);

        $challenge = new Challenge();
        $defi = new Defi();
        $form = $this->createForm(DefiType::class, $defi);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($defi);
            $entityManager->flush();

            $challenge->setCreator($this->getUser());
            $challenge->setCatcher($unknownUser);
            $challenge->setDefi($defi);
            $challenge->setIsSuccess('0');
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($challenge);
            $entityManager->flush();
            return $this->redirectToRoute('profile');
        }

        return $this->render('cap/unknown-new.html.twig', [
            'form' => $form->createView(),
       ]);
    }

    /**
     * @Route("/unknown/alea", name="_unknown_alea")
     */
    public function unknownAlea(): Response
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

        return $this->render('cap/unknown-alea.html.twig', [
            'defi' => $defi,
            'unknown_user_id' => $unknownUserId,
        ]);
    }

    /**
     * @Route("/friend/new", name="friend_new")
     */
    public function friendNew(Request $request): Response
    {
        $friendId = 3;
        $friend = $this->getDoctrine()
            ->getRepository(User::class)
            ->find($friendId);

        $challenge = new Challenge();
        $defi = new Defi();
        $form = $this->createForm(DefiType::class, $defi);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($defi);
            $entityManager->flush();

            $challenge->setCreator($this->getUser());
            $challenge->setCatcher($friend);
            $challenge->setDefi($defi);
            $challenge->setIsSuccess('0');
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($challenge);
            $entityManager->flush();
            return $this->redirectToRoute('profile');
        }

        return $this->render('cap/friend-new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/friend/alea", name="_friend_alea")
     */
    public function friendAlea(): Response
    {
        $friendId = 3;
        $friend = $this->getDoctrine()
            ->getRepository(User::class)
            ->find($friendId);

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
            $challenge->setCreator($user);
            $challenge->setCatcher($friend);
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

        return $this->render('cap/friend-alea.html.twig', [
            'defi' => $defi,
        ]);
    }
}
