<?php

namespace WorkshopBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use WorkshopBundle\Entity\Person;
use Symfony\Component\HttpFoundation\Request;

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

    /**
     * Creates a new person entity.
     *
     * @Route("/new", name="person_new_customer")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $person = new Person();
        $form = $this->createForm('WorkshopBundle\Form\PersonType', $person);
        $form->remove('user');
        $form->remove('customer');
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($person);
            $em->flush();

            return $this->redirectToRoute('person_show', array('id' => $person->getId()));
        }

        return $this->render('WorkshopBundle:Customer:customer_addCustomer.html.twig', array(
            'person' => $person,
            'form' => $form->createView(),
        ));
    }

    /**
     * @Route("/orders", name="customerPanel_orders")
     * @Security("has_role('ROLE_USER')")
     */
    public function customerPanelOrdersAction()
    {
        return $this->render('WorkshopBundle:Customer:panelOrders.html.twig', array(
            // ...
        ));
    }

    /**
     * @Route("/vehicles", name="customerPanel_vehicles")
     * @Security("has_role('ROLE_USER')")
     */
    public function panelOrdersAction()
    {
        return $this->render('WorkshopBundle:Customer:panelVehicles.html.twig', array(
            // ...
        ));
    }

    /**
     * @Route("/vehicles/findMyVehicles", name="panelCustomer_myVehicles")
     * @Security("has_role('ROLE_USER')")
     * @Method("GET")
     */
    public function panelMyVehiclesAction() {
        $owner = '';
        $vehicles = $this->getDoctrine()->getRepository(Vehicle::class)->findVehicleByOwner($owner);
        return $this->render("WorkshopBundle:Admin:panelVehicles_showAll.html.twig", array('vehicles'=>$vehicles));
    }


}
