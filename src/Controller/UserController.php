<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    /**
     * @Route("/profile", name="profile")
     */
    public function index(): Response
    {
        return $this->render('user/index.html.twig', [
            'controller_name' => 'UserController',
        ]);
    }

    /**
     * @Route("/ranking", name="ranking")
     */
    public function ranking(UserRepository $userRepository): Response
    {
        $users = $userRepository->findAllOrderByScore();
        return $this->render('user/ranking.html.twig', [
            'users' => $users,
        ]);
    }
}
