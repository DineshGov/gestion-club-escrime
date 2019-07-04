<?php

namespace App\Controller;

use App\Entity\Membre;
use App\Entity\Competition;
use App\Entity\Tireur;
use App\Form\TireurType;
use App\Repository\TireurRepository;
use function dump;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use function var_dump;

/**
 * @Route("/tireur")
 */
class TireurController extends AbstractController
{

    /**
     * @Route("/home", name="tireur_home")
     */
    public function home()
    {
        return $this->render("tireur/home.html.twig");
    }

    /**
     * @Route("/", name="tireur_index", methods={"GET"})
     */
    public function index(TireurRepository $tireurRepository): Response
    {
        /*$t = $this->getDoctrine()->getManager()->getRepository(Tireur::class);
        var_dump($t->findAll()[0]->getMembre());*/

        return $this->render('tireur/index.html.twig', [
            'tireurs' => $tireurRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="tireur_new", methods={"GET","POST"})
     */
    public function new(Request $request, UserPasswordEncoderInterface $passwordEncoder): Response
    {
        $tireur = new Tireur();
        $form = $this->createForm(TireurType::class, $tireur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $password = $passwordEncoder->encodePassword($tireur->getMembre(), $tireur->getMembre()->getRawPassword());
            //$password = $passwordEncoder->encodePassword($membre, $membre->getPassword());
            $tireur->getMembre()->setPassword($password);
            $tireur->getMembre()->addRole("ROLE_TIREUR");
            // 4) save the User!
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($tireur->getMembre());
            $entityManager->flush();


            //$entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($tireur);
            $entityManager->flush();

            return $this->redirectToRoute('tireur_index');
        }

        return $this->render('tireur/new.html.twig', [
            'tireur' => $tireur,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="tireur_show", methods={"GET"})
     */
    public function show(Tireur $tireur): Response
    {
        return $this->render('tireur/show.html.twig', [
            'tireur' => $tireur,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="tireur_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Tireur $tireur): Response
    {
        $form = $this->createForm(TireurType::class, $tireur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('tireur_index', [
                'id' => $tireur->getId(),
            ]);
        }

        return $this->render('tireur/edit.html.twig', [
            'tireur' => $tireur,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="tireur_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Tireur $tireur): Response
    {
        if ($this->isCsrfTokenValid('delete'.$tireur->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($tireur);
            $entityManager->flush();
        }

        return $this->redirectToRoute('tireur_index');
    }

    public function redirectToShowTireur(){
        $idMembreConnecte = $this->get('security.token_storage')->getToken()->getUser();
        $tireurRepository = $this->getDoctrine()->getManager()->getRepository(Tireur::class)->findAll();

        foreach ($tireurRepository as $tireur){
            if($tireur->getMembre()->getId() == $idMembreConnecte){
                return $this->render('tireur/show.html.twig', [
                    'tireur' => $tireur,
                ]);
            }
        }
    }

    /**
     * @Route("/index/competition",name="competition",methods={"GET"})
     */
    public function index_competition(Request $request):Response {

        $competitions =$this->getDoctrine()->getManager()->getRepository('Competition')->findAll();
        var_dump($competitions);die;
        return $this->render('tireur/index_competition.html.twig',[
            'competitions' => $competitions
        ]);
    }
}
