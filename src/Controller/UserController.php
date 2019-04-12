<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    /**
     * @Route("/user", name="user")
     */
    public function index(UserRepository $repository) : Response
    {
        $users =   $repository->findAll();
        return $this->render('user/index.html.twig', [
            'users' => $users,
        ]);
    }
}
