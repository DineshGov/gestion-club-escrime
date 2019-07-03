<?php

namespace App\Controller;

use App\Entity\CommentaireLecon;
use App\Form\CommentaireLeconType;
use App\Repository\CommentaireLeconRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/commentaire/lecon")
 */
class CommentaireLeconController extends AbstractController
{
    /**
     * @Route("/", name="commentaire_lecon_index", methods={"GET"})
     */
    public function index(CommentaireLeconRepository $commentaireLeconRepository): Response
    {
        return $this->render('commentaire_lecon/index.html.twig', [
            'commentaire_lecons' => $commentaireLeconRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="commentaire_lecon_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $commentaireLecon = new CommentaireLecon();
        $form = $this->createForm(CommentaireLeconType::class, $commentaireLecon);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($commentaireLecon);
            $entityManager->flush();

            return $this->redirectToRoute('commentaire_lecon_index');
        }

        return $this->render('commentaire_lecon/new.html.twig', [
            'commentaire_lecon' => $commentaireLecon,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="commentaire_lecon_show", methods={"GET"})
     */
    public function show(CommentaireLecon $commentaireLecon): Response
    {
        return $this->render('commentaire_lecon/show.html.twig', [
            'commentaire_lecon' => $commentaireLecon,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="commentaire_lecon_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, CommentaireLecon $commentaireLecon): Response
    {
        $form = $this->createForm(CommentaireLeconType::class, $commentaireLecon);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('commentaire_lecon_index', [
                'id' => $commentaireLecon->getId(),
            ]);
        }

        return $this->render('commentaire_lecon/edit.html.twig', [
            'commentaire_lecon' => $commentaireLecon,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="commentaire_lecon_delete", methods={"DELETE"})
     */
    public function delete(Request $request, CommentaireLecon $commentaireLecon): Response
    {
        if ($this->isCsrfTokenValid('delete'.$commentaireLecon->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($commentaireLecon);
            $entityManager->flush();
        }

        return $this->redirectToRoute('commentaire_lecon_index');
    }
}
