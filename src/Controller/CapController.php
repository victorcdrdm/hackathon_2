<?php

namespace App\Controller;

use App\Entity\Challenge;
use App\Entity\Defi;
use App\Entity\User;
use App\Form\DefiType;
use App\Form\SucesseType;
use App\Form\ValidateType;
use App\Repository\ChallengeRepository;
use App\Repository\DefiRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
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
            'unknown_user' => $unknownUser,
       ]);
    }

    /**
     * @Route("/{id}", name="challenge", methods={"GET","POST"})
     */
    public function toDo(Request $request, int $id ,
                         ChallengeRepository $challengeRepository,
                         UserRepository $userRepository,
                         DefiRepository $defiRepository,
                         EntityManagerInterface $entityManager): Response
    {
        $challenge = $challengeRepository->findOneBy(['id'=> $id]);
        $creator = $userRepository->findOneBy(['id' => $challenge->getCreator()]);
        $defi = $defiRepository->findOneBy(['id' => $challenge->getDefi()]);
        $form = $this->createForm(SucesseType::class);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $challengeDown = $form->getData();
            $challenge->setImage($challengeDown->getImageFile());
            $challenge->setImageFile($challengeDown->getImageFile());
            $challenge->setIsSuccess(true);
            $entityManager->flush();
            return $this->redirectToRoute('profile');
        }

        return $this->render('cap/todo.html.twig', [
            'defi' => $defi,
            'creator' => $creator,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/cast/{id}", name="cast", methods={"GET"})
     */
    public function cast(ChallengeRepository $challengeRepository,int $id): Response
    {
        $challenge = $challengeRepository->findOneBy(['id' => $id]);

        return $this->render('cap/cast.html.twig',[
            'challenge' => $challenge,
        ]);

    }
    /**
     * @Route("/done/{id}", name="done", methods={"GET"})
     */
    public function done(ChallengeRepository $challengeRepository,int $id): Response
    {
        $challenge = $challengeRepository->findOneBy(['id' => $id]);

        return $this->render('cap/done.html.twig',[
            'challenge' => $challenge,
        ]);

    }

    /**
     * @Route("/validate/{id}", name="validate", methods={"GET","POST"})
     */
    public function validate(int $id, ChallengeRepository $challengeRepository, Request $request): Response
    {
        $challenge = $challengeRepository->findOneBy(['id'=> $id]);

        $form = $this->createForm(ValidateType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){

            $challenge->setIsValid(true);
            $user = new User();
            $user = $challenge->getCatcher();
            $newScore = $user->getScore() + $challenge->getDefi()->getPoint();
            $user->setScore($newScore);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->flush() ;


            return $this->redirectToRoute('profile');

        }

        return $this->render('cap/validate.html.twig',[
            'form' => $form->createView(),
            'challenge' => $challenge,
            ]);

    }

    /**
     * @Route("/unknown/alea", name="unknown_alea")
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
     * @Route("/friend/new/{idFriend}", name="friend_new", methods={"GET", "POST"}, requirements={"id":"\d+"})
     */
    public function friendNew(Request $request, UserRepository $userRepository, string $idFriend): Response
    {
        $friend = $userRepository->findOneBy(['id' => $idFriend]);


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
     * @Route("/friend/alea/{idFriend}", name="friend_alea", methods={"GET", "POST"}, requirements={"id":"\d+"})
     */
    public function friendAlea(Request $request, UserRepository $userRepository, string $idFriend): Response
    {

        $friend = $userRepository->findOneBy(['id' => $idFriend]);

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
            'friend' => $friend,
        ]);
    }
}
