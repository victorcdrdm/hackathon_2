<?php

namespace App\Controller;

use App\Entity\Challenge;
use App\Entity\Defi;
use App\Entity\User;
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
<<<<<<< HEAD
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
=======
     * @Route("/unknown", name="_unknown")
>>>>>>> 1fde71fb1bfa3f366549d03937b69829b410cae6
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
            $defi = new Defi();
            $defi->setDescription($_POST['description']);
            $defi->setTitle($_POST['title']);
            $defi->setFormat($_POST['format']);
            $defi->setPoint($_POST['point']);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($defi);
            $entityManager->flush();

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
