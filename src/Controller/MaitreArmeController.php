<?php

namespace App\Controller;

use App\Entity\MaitreArme;
use App\Form\MaitreArmeType;
use App\Repository\MaitreArmeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * @Route("/maitre_arme")
 */
class MaitreArmeController extends AbstractController
{
    /**
     * @Route("/", name="maitre_arme_index", methods={"GET"})
     */
    public function index(MaitreArmeRepository $maitreArmeRepository): Response
    {
        return $this->render('maitre_arme/index.html.twig', [
            'maitre_armes' => $maitreArmeRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="maitre_arme_new", methods={"GET","POST"})
     */
    public function new(Request $request, UserPasswordEncoderInterface $passwordEncoder): Response
    {
        $maitreArme = new MaitreArme();
        $form = $this->createForm(MaitreArmeType::class, $maitreArme);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $password = $passwordEncoder->encodePassword($maitreArme->getMembre(), $maitreArme->getMembre()->getRawPassword());
            //$password = $passwordEncoder->encodePassword($membre, $membre->getPassword());
            $maitreArme->getMembre()->setPassword($password);
            $maitreArme->getMembre()->addRole("ROLE_MAITRE_ARME");
            // 4) save the User!
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($maitreArme->getMembre());
            $entityManager->flush();

            $entityManager->persist($maitreArme);
            $entityManager->flush();

            return $this->redirectToRoute('maitre_arme_index');
        }

        return $this->render('maitre_arme/new.html.twig', [
            'maitre_arme' => $maitreArme,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="maitre_arme_show", methods={"GET"})
     */
    public function show(MaitreArme $maitreArme): Response
    {
        return $this->render('maitre_arme/show.html.twig', [
            'maitre_arme' => $maitreArme,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="maitre_arme_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, MaitreArme $maitreArme): Response
    {
        $form = $this->createForm(MaitreArmeType::class, $maitreArme);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('maitre_arme_index', [
                'id' => $maitreArme->getId(),
            ]);
        }

        return $this->render('maitre_arme/edit.html.twig', [
            'maitre_arme' => $maitreArme,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="maitre_arme_delete", methods={"DELETE"})
     */
    public function delete(Request $request, MaitreArme $maitreArme): Response
    {
        if ($this->isCsrfTokenValid('delete'.$maitreArme->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($maitreArme);
            $entityManager->flush();
        }

        return $this->redirectToRoute('maitre_arme_index');
    }
}
