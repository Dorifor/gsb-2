<?php

namespace App\Controller;

use App\Entity\Mission;
use App\Entity\User;
use App\Entity\Ville;
use App\Form\AjouterUtilisateurType;
use App\Repository\UserRepository;
use App\Repository\VilleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    /**
     * @Route("/admin/", name="app_gsb_admin_accueil")
     */
    public function accueil(): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        return $this->render('admin/index.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }

    /**
     * @Route("/admin/users/", name="app_gsb_admin_users")
     */
    public function users(UserRepository $userRepository): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        $users = $userRepository->findAll();

        return $this->render('admin/users.html.twig', [
            'users' => $users,
        ]);
    }

    /**
     * @Route("/admin/users/add", name="app_gsb_admin_add_user", methods={"GET", "POST"})
     */
    public function addUser(Request $request, EntityManagerInterface $manager): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        $user = new User();

        $form = $this->createForm(AjouterUtilisateurType::class, $user);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $manager->persist($user);
            $manager->flush();
            return $this->redirectToRoute('app_gsb_admin_users');
        }

        return $this->render('admin/add_user.html.twig', [
            'formUtilisateur' => $form->createView(),
        ]);
    }

    /** 
     * @Route("/admin/ville_search", name="app_gsb_admin_ville_search", defaults={"_format" = "json"}, methods={"GET"})
    */
    public function searchVille(Request $request, VilleRepository $villeRepository): Response
    {
        $q = $request->query->get('term');
        $villes = $villeRepository->findLike($q);

        return $this->render('json/villes.json.twig', ['villes' => $villes]);
    }

    /**
     * @Route("admin/ville_get/{id}", name="app_gsb_admin_ville_get", defaults={"_format" = "json"}, methods={"GET"})
     */
    public function getVille($id = null, VilleRepository $villeRepository): Response
    {
        $ville = $villeRepository->find($id);

        return $this->json($ville->getNom());
    }
}
