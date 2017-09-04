<?php

namespace WorkshopBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * Class AdminController
 * @Route("/customer")
 */
class CustomerController extends Controller {

    /**
     * @Route("/customerPanel", name="customerPanel")
     * @Security("has_role('ROLE_CUSTOMER')")
     */
    public function customerPanelAction()
    {
        return $this->render('WorkshopBundle:Customer:customer_panel.html.twig', array(
            // ...
        ));
    }

}
