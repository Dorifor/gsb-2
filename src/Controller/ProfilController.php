<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProfilController extends AbstractController
{
    /**
     * @Route("/user/{id}", name="app_gsb_profil")
     */
    public function index(UserRepository $repository, $id): Response
    {
        $user = $repository->find($id);

        return $this->render('profil/index.html.twig', [
            'user' => $user,
        ]);
    }
}
