<?php

namespace App\Controller;

use App\Entity\Lecon;
use App\Form\LeconType;
use App\Repository\LeconRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/lecon")
 */
class LeconController extends AbstractController
{
    /**
     * @Route("/", name="lecon_index", methods={"GET"})
     */
    public function index(LeconRepository $leconRepository): Response
    {
        return $this->render('lecon/index.html.twig', [
            'lecons' => $leconRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="lecon_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $lecon = new Lecon();
        $form = $this->createForm(LeconType::class, $lecon);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($lecon);
            $entityManager->flush();

            return $this->redirectToRoute('lecon_index');
        }

        return $this->render('lecon/new.html.twig', [
            'lecon' => $lecon,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="lecon_show", methods={"GET"})
     */
    public function show(Lecon $lecon): Response
    {
        return $this->render('lecon/show.html.twig', [
            'lecon' => $lecon,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="lecon_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Lecon $lecon): Response
    {
        $form = $this->createForm(LeconType::class, $lecon);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('lecon_index', [
                'id' => $lecon->getId(),
            ]);
        }

        return $this->render('lecon/edit.html.twig', [
            'lecon' => $lecon,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="lecon_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Lecon $lecon): Response
    {
        if ($this->isCsrfTokenValid('delete'.$lecon->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($lecon);
            $entityManager->flush();
        }

        return $this->redirectToRoute('lecon_index');
    }
}
