<?php
/**
 * Created by PhpStorm.
 * User: slima
 * Date: 02/07/2019
 * Time: 22:42
 */

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class DefaultController
 * @package App\Controller
 * @Route("/")
 */
class DefaultController extends AbstractController
{
    /**
     * @Route("/home")
     */
    public function home(){
        return $this->render("/home.html.twig");
    }


}