<?php

namespace App\Controller;

use App\Entity\Presence;
use App\Form\PresenceType;
use App\Repository\PresenceRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/presence")
 */
class PresenceController extends AbstractController
{
    /**
     * @Route("/", name="presence_index", methods={"GET"})
     */
    public function index(PresenceRepository $presenceRepository): Response
    {
        return $this->render('presence/index.html.twig', [
            'presences' => $presenceRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="presence_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $presence = new Presence();
        $form = $this->createForm(PresenceType::class, $presence);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($presence);
            $entityManager->flush();

            return $this->redirectToRoute('presence_index');
        }

        return $this->render('presence/new.html.twig', [
            'presence' => $presence,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="presence_show", methods={"GET"})
     */
    public function show(Presence $presence): Response
    {
        return $this->render('presence/show.html.twig', [
            'presence' => $presence,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="presence_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Presence $presence): Response
    {
        $form = $this->createForm(PresenceType::class, $presence);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('presence_index', [
                'id' => $presence->getId(),
            ]);
        }

        return $this->render('presence/edit.html.twig', [
            'presence' => $presence,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="presence_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Presence $presence): Response
    {
        if ($this->isCsrfTokenValid('delete'.$presence->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($presence);
            $entityManager->flush();
        }

        return $this->redirectToRoute('presence_index');
    }
}
