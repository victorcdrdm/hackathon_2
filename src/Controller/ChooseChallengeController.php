<?php

namespace App\Controller;

use App\Entity\User;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ChooseChallengeController extends AbstractController
{
    /**
     * @Route("/choose/challenge/{id}", name="choose_challenge", methods={"GET"}, requirements={"id":"\d+"})
     */
    public function choose(User $user, Request $request): Response
    {
        if(!$user) {
            throw $this->createNotFoundException(
                'Pas de profil avec ce numéro' . $user->getId()
            );
        }


        return $this->render('choose_challenge/index.html.twig', [
            'friend' => $user,
        ]);
    }
}
