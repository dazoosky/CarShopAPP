<?php

namespace WorkshopBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;


class DefaultController extends Controller
{
    /**
    * @Route("/", name="index")
    * @Security("has_role('ROLE_ADMIN')")
    */
    public function adminIndexAction() {
        return $this->redirectToRoute('adminPanel');
    }



    /**
     * @Route("/")
     *
     */
    public function indexAction()
    {
        return $this->render('WorkshopBundle:Default:index.html.twig');
    }
}
