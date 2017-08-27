<?php

namespace WorkshopBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

/**
 * Class AdminController
 * @Route("/admin")
 */
class AdminController extends Controller
{
    /**
     * @Route("/", name="adminPanel")
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function panelAction()
    {
        return $this->render('WorkshopBundle:Admin:panel.html.twig', array(
            // ...
        ));
    }

}
