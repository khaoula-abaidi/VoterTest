<?php

namespace App\Controller;

use App\Entity\Decision;
use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Role\Role;

class UserController extends AbstractController
{
    /**
     * @return Response
     * @Route("/user", name="user")
     */
    public function index(UserRepository $repository) : Response
    {
        $users =   $repository->findAll();
        return $this->render('user/index.html.twig', [
            'users' => $users,
        ]);
    }

    /**
     * @param User $user
     * @param integer $id
     * @param UserRepository $repository
     * @return Response
     * @Route("/user/{id}", name="show_role")
     */
    public function show(User $user,$id,UserRepository $repository):Response{
        $user = $repository->find($id);
        $this->denyAccessUnlessGranted('view',$user);
        $decision = new Decision();
        $decision->setContent('ma deciision')
                 ->setIsTaken(true);
        $this->getDoctrine()->getManager()->persist($decision);
        $this->getDoctrine()->getManager()->flush();
        // $role = new Role('ROLE_ADMIN');
       // dump($role->getRole());
        return $this->render('user/show.html.twig');
    }
}
