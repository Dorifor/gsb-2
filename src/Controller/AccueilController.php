<?php

namespace App\Controller;

use App\Entity\Mission;
use App\Form\AjouterMissionType;
use App\Repository\UserRepository;
use App\Repository\MissionRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

class AccueilController extends AbstractController
{
    /**
     * @Route("/visiteur", name="app_gsb_visiteur_accueil")
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
     * @Route("visiteur/add", name="app_gsb_add_mission", methods={"GET", "POST"})
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

            $justificationFile = $form->get('just_heb')->getData();

            if ($justificationFile) {
                $originalFilename = pathinfo($justificationFile->getClientOriginalName(), PATHINFO_FILENAME);
                // this is needed to safely include the file name as part of the URL
                $newFilename = 'justif-' . uniqid() . '.' . $justificationFile->guessExtension();

                // Move the file to the directory where brochures are stored
                $justificationFile->move(
                    $this->getParameter('justification_directory'),
                    $newFilename
                );

                // updates the 'brochureFilename' property to store the PDF file name
                // instead of its contents
                $mission->setJustHeb($newFilename);
            }

            $mission->setUser($user);
            $mission->setEtat(0);
            $manager->persist($mission);
            $manager->flush();

            return $this->redirectToRoute('app_gsb_visiteur_accueil');
        }

        return $this->render('accueil/add.html.twig', [
            'user' => $user,
            'formMission' => $form->createView()
        ]);
    }

    /**
     * @Route("visiteur/{id}/edit", name="app_gsb_edit", methods={"GET", "PUT"}, requirements={"id"="\d+"})
     */
    public function edit(Request $request, EntityManagerInterface $manager, MissionRepository $missionRepository, $id): Response
    {
        // On refuse l'accès à l'utilisateur s'il n'est pas authentifié
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        // On récupère l'utilisateur 
        $user = $this->getUser();
        $mission = $missionRepository->find($id);

        // On crée le formulaire avec le modèle de formulaire de la table / classe Mission avec la méthode HTTP Put
        $form = $this->createForm(AjouterMissionType::class, $mission, [
            'method' => 'PUT'
        ]);

        // Dès la soumission du formulaire, on lit les données renvoyées par celui ci
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $justificationFile = $form->get('just_heb')->getData();

            if ($justificationFile) {
                // this is needed to safely include the file name as part of the URL
                $newFilename = 'justif-' . uniqid() . '.' . $justificationFile->guessExtension();

                // Move the file to the directory where brochures are stored
                $justificationFile->move(
                    $this->getParameter('justification_directory'),
                    $newFilename
                );

                // updates the 'brochureFilename' property to store the PDF file name
                // instead of its contents
                $mission->setJustHeb($newFilename);
            }

            $mission->setUser($user);

            // On envoit la requête à la table
            $manager->flush();

            // On redirige l'utilisateur à la page d'accueil une fois la mission modifiée
            return $this->redirectToRoute('app_gsb_visiteur_accueil');
        }

        return $this->render('accueil/edit.html.twig', [
            'user' => $user,
            'mission' => $mission,
            'formMission' => $form->createView()
        ]);
    }
}
