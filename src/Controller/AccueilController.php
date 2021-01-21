<?php

namespace App\Controller;

use App\Entity\Mission;
use App\Form\AjouterMissionType;
use App\Repository\UserRepository;
use App\Repository\MissionRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AccueilController extends AbstractController
{
    /**
     * @Route("/", name="app_gsb_accueil")
     */
    public function index(): Response
    {
        // On refuse l'accès à l'utilisateur s'il n'est pas authentifié
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        // On récupère l'utilisateur 
        $user = $this->getUser();

        // On renvoie à la vue la page à afficher ainsi que les paramètres (utilisateur pour son nom, prénom et missions à afficher)
        return $this->render('accueil/index.html.twig', [
            'user' => $user
        ]);
    }

    /**
     * @Route("/add", name="app_gsb_add_mission", methods={"GET", "POST"})
     */
    public function add(UserRepository $userRepository, Request $request, EntityManagerInterface $manager): Response
    {
        // On refuse l'accès à l'utilisateur s'il n'est pas authentifié
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        // On récupère l'utilisateur 
        $user = $this->getUser();

        // Création de l'objet Mission
        $mission = new Mission();

        // On crée le formulaire avec le modèle de formulaire de la table / classe Mission
        $form = $this->createForm(AjouterMissionType::class, $mission);

        // Dès la soumission du formulaire, on lit les données renvoyées par celui ci
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $manager->persist($mission);
            $manager->flush();

            return $this->redirectToRoute('app_gsb_accueil');
        }

        return $this->render('accueil/add.html.twig', [
            'user' => $user,
            'formMission' => $form->createView()
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_gsb_edit", methods={"GET", "PUT"})
     */
<<<<<<< HEAD
    public function edit(UserRepository $userRepository, Request $request, EntityManagerInterface $manager, MissionRepository $missionRepository, $id): Response
=======
    public function add(Request $request, EntityManagerInterface $manager): Response
>>>>>>> ff58a5b4938c97d8794842fe59296b6e49746258
    {
        // On refuse l'accès à l'utilisateur s'il n'est pas authentifié
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        // On récupère l'utilisateur 
        $user = $this->getUser();
        $mission = $missionRepository->find($id);

<<<<<<< HEAD
        // On crée le formulaire avec le modèle de formulaire de la table / classe Mission avec la méthode HTTP Put
        $form = $this->createForm(AjouterMissionType::class, $mission, [
            'method' => 'PUT'
        ]);
=======
        // Création de l'objet Mission
        $mission = new Mission();
        // $mission->setUser($user);

        // On crée le formulaire avec le modèle de formulaire de la table / classe Mission
        $form = $this->createForm(AjouterMissionType::class, $mission);
>>>>>>> ff58a5b4938c97d8794842fe59296b6e49746258

        // Dès la soumission du formulaire, on lit les données renvoyées par celui ci
        $form->handleRequest($request);

<<<<<<< HEAD
        if ($form->isSubmitted() && $form->isValid()) {
            // On envoit la requête à la table
=======
        if ($form->isSubmitted() && $form->isValid()){

            $manager->persist($mission);
>>>>>>> ff58a5b4938c97d8794842fe59296b6e49746258
            $manager->flush();

            // On redirige l'utilisateur à la page d'accueil une fois la mission modifiée
            return $this->redirectToRoute('app_gsb_accueil');
        }

        return $this->render('accueil/edit.html.twig', [
            'user' => $user,
            'mission' => $mission,
            'formMission' => $form->createView()
        ]);
    }

    /**
     * @Route("/{id}", name="app_gsb_detail_mission", methods="GET")
     */
    public function detail(Mission $mission) : Response
    {
        return $this->render("accueil/detail.html.twig", [
            'mission' => $mission
        ]);
    }
}
