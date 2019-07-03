<?php

namespace App\Controller;

use App\Entity\CommentaireObjectif;
use App\Form\CommentaireObjectifType;
use App\Repository\CommentaireObjectifRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/commentaire/objectif")
 */
class CommentaireObjectifController extends AbstractController
{
    /**
     * @Route("/", name="commentaire_objectif_index", methods={"GET"})
     */
    public function index(CommentaireObjectifRepository $commentaireObjectifRepository): Response
    {
        return $this->render('commentaire_objectif/index.html.twig', [
            'commentaire_objectifs' => $commentaireObjectifRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="commentaire_objectif_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $commentaireObjectif = new CommentaireObjectif();
        $form = $this->createForm(CommentaireObjectifType::class, $commentaireObjectif);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($commentaireObjectif);
            $entityManager->flush();

            return $this->redirectToRoute('commentaire_objectif_index');
        }

        return $this->render('commentaire_objectif/new.html.twig', [
            'commentaire_objectif' => $commentaireObjectif,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="commentaire_objectif_show", methods={"GET"})
     */
    public function show(CommentaireObjectif $commentaireObjectif): Response
    {
        return $this->render('commentaire_objectif/show.html.twig', [
            'commentaire_objectif' => $commentaireObjectif,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="commentaire_objectif_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, CommentaireObjectif $commentaireObjectif): Response
    {
        $form = $this->createForm(CommentaireObjectifType::class, $commentaireObjectif);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('commentaire_objectif_index', [
                'id' => $commentaireObjectif->getId(),
            ]);
        }

        return $this->render('commentaire_objectif/edit.html.twig', [
            'commentaire_objectif' => $commentaireObjectif,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="commentaire_objectif_delete", methods={"DELETE"})
     */
    public function delete(Request $request, CommentaireObjectif $commentaireObjectif): Response
    {
        if ($this->isCsrfTokenValid('delete'.$commentaireObjectif->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($commentaireObjectif);
            $entityManager->flush();
        }

        return $this->redirectToRoute('commentaire_objectif_index');
    }
}
