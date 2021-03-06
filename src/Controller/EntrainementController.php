<?php

namespace App\Controller;

use App\Entity\Entrainement;
use App\Entity\Presence;
use App\Entity\Tireur;
use App\Form\EntrainementType;
use App\Repository\EntrainementRepository;
use function dump;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/entrainement")
 */
class EntrainementController extends AbstractController
{
    /**
     * @Route("/", name="entrainement_index", methods={"GET"})
     */
    public function index(EntrainementRepository $entrainementRepository): Response
    {
        $idMembreConnecte = $this->get('security.token_storage')->getToken()->getUser()->getId();
        $tireurRepository = $this->getDoctrine()->getManager()->getRepository(Tireur::class)->findAll();

        foreach ($tireurRepository as $tireur){
            if($tireur->getMembre()->getId() == $idMembreConnecte){
                return $this->render('entrainement/index.html.twig', [
                    'tireur' => $tireur,
                    'entrainements' => $entrainementRepository->findAll(),
                ]);
            }
        }

        return $this->render('entrainement/index.html.twig', [
            'entrainements' => $entrainementRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="entrainement_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $entrainement = new Entrainement();
        $form = $this->createForm(EntrainementType::class, $entrainement);
        $form->handleRequest($request);
        $entityManager = $this->getDoctrine()->getManager();
        if ($form->isSubmitted() && $form->isValid()) {
            $presence = new Presence();
            $entrainement->setPresence($presence);
            $entityManager->persist($entrainement);

            $tireurRepository = $this->getDoctrine()->getManager()->getRepository(Tireur::class)->findAll();

            foreach ($tireurRepository as $tireur){
                if($tireur->getGroupe()->getId() == $entrainement->getGroupe()->getId()){
                    $tireur->addEntrainement($entrainement);
                    $entityManager->persist($tireur);
                }
            }
            $entityManager->flush();

            return $this->redirectToRoute('entrainement_index');
        }

        return $this->render('entrainement/new.html.twig', [
            'entrainement' => $entrainement,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="entrainement_show", methods={"GET"})
     */
    public function show(Entrainement $entrainement): Response
    {
        return $this->render('entrainement/show.html.twig', [
            'entrainement' => $entrainement,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="entrainement_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Entrainement $entrainement): Response
    {
        $form = $this->createForm(EntrainementType::class, $entrainement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('entrainement_index', [
                'id' => $entrainement->getId(),
            ]);
        }

        return $this->render('entrainement/edit.html.twig', [
            'entrainement' => $entrainement,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="entrainement_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Entrainement $entrainement): Response
    {
        if ($this->isCsrfTokenValid('delete'.$entrainement->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($entrainement);
            $entityManager->flush();
        }

        return $this->redirectToRoute('entrainement_index');
    }
}
