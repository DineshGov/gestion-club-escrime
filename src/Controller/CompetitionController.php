<?php

namespace App\Controller;

use App\Entity\Competition;
use App\Entity\Niveau;
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
            //dump($competition);die;
            $entityManager = $this->getDoctrine()->getManager();
            $niveauRepository = $this->getDoctrine()->getManager()->getRepository(Niveau::class);
            //Pour chaque niveau dans $ competition
            //    Creer une competition et la mettre dans un tableau
            $competition1=$request->request->get('competition');

           //var_dump($competition);die;
            $nb_niveaux=sizeof($competition1['niveau']);
            $competitions=[];
            $niveaux=[];
            //$entityManager->persist($competition);
            foreach ($competition->getNiveau() as $niveau){

                $competition_new=new Competition();
                //var_dump($key);
                //var_dump($value);
                //$value=str
                //$niveau = $niveauRepository->findOneById(intval($value));
                //$array_niveaux_competition =$competition->getNiveau();
                //unset($array_niveaux_competition);
                //$test = $test->getCategorie();
                //foreach ($array_niveaux_competition as $cle => $valeurNiveau){
                  //unset($array_niveaux_competition[$cle]);
                //}
                //$competition->setNiveau($array_niveaux_competition);
                //$competition->addNiveau($niveau);
                //dump($competition);
                $competition_new->addNiveau($niveau);
                $competition_new->setNom($competition->getNom());
                $competition_new->setVille($competition->getVille());
                $competition_new->setDate($competition->getDate());
                $competition_new->setTireurs($competition->getTireurs());
                dump($competition_new);
                $entityManager->persist($competition_new);


                //dump($array_niveaux_competition);die;
                //dump($competition);die;
                //$collectionNiveauCompetition=$competition['niveau'];

                //dump($collectionNiveauCompetition);
                //array_push($niveaux,

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


}
