<?php

namespace App\Controller;

use App\Form\SearchFriendFormType;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FriendController extends AbstractController
{
    /**
     * @Route("/friend", name="friend")
     */
    public function index(Request $request, UserRepository $userRepository): Response
    {
        $form = $this->createForm(SearchFriendFormType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $search = $form->getData()['search'];
            $friends = $userRepository->findLikeUsername($search);
        } else {
            $friends = $userRepository->findAll();
        }

        return $this->render('friend/index.html.twig', [
            'friends' => $friends,
            'form' => $form->createView(),
        ]);
    }
}
