<?php

namespace App\Controller;

use function dump;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    /**
     * @Route("/login", name="login")
     */
    public function login(Request $request, AuthenticationUtils $authenticationUtils) {
        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();
        //

        $form = $this->get('form.factory')
            ->createNamedBuilder(null)
            ->add('_username', null, ['label' => 'Email'])
            ->add('_password', \Symfony\Component\Form\Extension\Core\Type\PasswordType::class, ['label' => 'Mot de passe'])
            ->add('ok', \Symfony\Component\Form\Extension\Core\Type\SubmitType::class, ['label' => 'Ok', 'attr' => ['class' => 'btn-primary btn-block']])
            ->getForm();

        if($form->isSubmitted() && $form->isValid()){
            dump($form->getData());
        }

        return $this->render('security/login.html.twig', [
            'mainNavLogin' => true, 'title' => 'Connexion',
            //
            'form' => $form->createView(),
            'last_username' => $lastUsername,
            'error' => $error,
        ]);
    }

    /**
     * @Route("/")
     */
    public function redirectToLogin(Request $request) {
        return $this->redirectToRoute('login');
    }

    /**
     * Redirect users after login based on the granted ROLE
     * @Route("/login/redirect", name="_login_redirect")
     */
    public function loginRedirectAction(Request $request) {
        if($this->isGranted('ROLE_ADMIN'))
        {
            return $this->redirectToRoute('admin_home');
        }
        else if($this->isGranted('ROLE_MAITRE_ARME'))
        {
            return $this->redirectToRoute('maitre_arme_home');
        }
        else if($this->isGranted('ROLE_TIREUR'))
        {
            return $this->redirectToRoute('tireur_home');
        }
        else if($this->isGranted('ROLE_ARBITRE'))
        {
            return $this->redirectToRoute('arbitre_index');
        }
        else
        {
            return $this->redirectToRoute('login');
        }
    }
}