<?php

namespace App\Controller;

use App\Entity\Competition;
use App\Entity\Niveau;
use App\Entity\Tireur;
use App\Form\CompetitionType;
use App\Repository\CompetitionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/competition")
 */
class CompetitionController extends AbstractController
{
    /**
     * @Route("/", name="competition_index", methods={"GET"})
     */
    public function index(CompetitionRepository $competitionRepository): Response
    {
        $idMembreConnecte = $this->get('security.token_storage')->getToken()->getUser()->getId();
        $tireurRepository = $this->getDoctrine()->getManager()->getRepository(Tireur::class)->findAll();
        foreach ($tireurRepository as $tireur){
            if($tireur->getMembre()->getId() == $idMembreConnecte){
                return $this->render('competition/index.html.twig', [
                    'tireur' => $tireur,
                    'competitions' => $competitionRepository->findAll(),
                ]);
            }
        }
        //dump($competitionRepository->findAll());die;
        return $this->render('competition/index.html.twig', [
            'competitions' => $competitionRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="competition_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $competition = new Competition();
        $form = $this->createForm(CompetitionType::class, $competition);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            //Pour chaque niveau dans $ competition
            //    Creer une competition et la mettre dans un tableau
            $competition1=$request->request->get('competition');

            foreach ($competition->getNiveau() as $niveau){

                $competition_new=new Competition();
                $competition_new->addNiveau($niveau);
                $competition_new->setNom($competition->getNom());
                $competition_new->setVille($competition->getVille());
                $competition_new->setDate($competition->getDate());
                $competition_new->setTireurs($competition->getTireurs());

                $entityManager->persist($competition_new);
            }
            $entityManager->flush();
            return $this->redirectToRoute('competition_index');
        }

        return $this->render('competition/new.html.twig', [
            'competition' => $competition,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="competition_show", methods={"GET"})
     */
    public function show(Competition $competition): Response
    {
        return $this->render('competition/show.html.twig', [
            'competition' => $competition,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="competition_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Competition $competition): Response
    {
        $form = $this->createForm(CompetitionType::class, $competition);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('competition_index', [
                'id' => $competition->getId(),
            ]);
        }

        return $this->render('competition/edit.html.twig', [
            'competition' => $competition,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="competition_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Competition $competition): Response
    {
        if ($this->isCsrfTokenValid('delete'.$competition->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($competition);
            $entityManager->flush();
        }

        return $this->redirectToRoute('competition_index');
    }

    /**
     * @Route("/{id}/tireurs", name="competition_tireurs", methods={"GET"})
     */
    public function tireurs(Request $request, Competition $competition): Response
    {
        return $this->render('competition/tireurs.html.twig', [
            'tireurs' => $competition->getTireurs(),
        ]);
    }

    /**
     * @Route("/{id}/participeCompetition/{idTireur}",name="participe_competition",methods={"GET"})
     */
    public function participeCompetition(Request $request,Competition $competition):Response {
        $idMembreConnecte = $this->get('security.token_storage')->getToken()->getUser()->getId();
        $tireurRepository = $this->getDoctrine()->getManager()->getRepository(Tireur::class)->findAll();
        $personne = null;
        $entityManager = $this->getDoctrine()->getManager();
        foreach ($tireurRepository as $tireur){
            if($tireur->getMembre()->getId() == $idMembreConnecte){
                $entityManager->persist($tireur->addCompetition($competition));
                $personne = $tireur;
            }
        }

        $entityManager->flush();

        return $this->redirectToRoute('tireur_show', [
            'id' => $personne->getId(),
        ]);
    }


}
