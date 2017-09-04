<?php

namespace WorkshopBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;


class DefaultController extends Controller
{
    /**
     * @Route("/")
     *
     */
    public function indexAction()
    {
        $securityContext = $this->get('security.context');
        if ($securityContext->isGranted('ROLE_ADMIN')) {
            return $this->redirectToRoute('adminPanel');
        }
        if ($securityContext->isGranted('ROLE_CUSTOMER')) {
            return $this->redirectToRoute('customerPanel');
        }

        return $this->redirectToRoute('fos_user_security_login');
    }
}
