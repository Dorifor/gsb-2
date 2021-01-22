<?php

namespace App\Controller;

use App\Entity\Mission;
use App\Repository\MissionRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ComptableController extends AbstractController
{
    #[Route('/comptable', name: 'app_gsb_comptable_accueil')]
    public function index(MissionRepository $missionRepository): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        // $missions = $missionRepository->findBy(['etat' => 0]);
        $missions = $missionRepository->findAll();
        return $this->render('comptable/index.html.twig', [
            'user' => $this->getUser(),
            'missions' => $missions
        ]);
    }

    /**
     * @Route("/comptable/{id}/show", name="app_gsb_comptable_afficher", requirements={"id"="\d+"})
     */
    public function show(Mission $mission): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $user = $this->getUser();
        return $this->render('comptable/show.html.twig', [
            'mission' => $mission,
            'user' => $user
        ]);
    }

    /**
     * @Route("/comptable/{id}/validate", name="app_gsb_comptable_valider", requirements={"id"="\d+"}, methods={"GET", "PUT"})
     */
    public function validate(MissionRepository $missionRepository, $id, Request $request, EntityManagerInterface $manager): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        $mission = $missionRepository->find($id);
        $mission->setEtat(1);
        $manager->persist($mission);
        $manager->flush();

        return $this->redirectToRoute('app_gsb_comptable_accueil');
    }
}
