<?php

namespace WorkshopBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\Request;
use WorkshopBundle\Entity\Person;
use WorkshopBundle\Repository\PersonRepository;

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

    /**
     * @Route("/customers", name="adminPanel_customers")
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function panelCustomersAction()
    {
        return $this->render('WorkshopBundle:Admin:panelCustomers.html.twig', array(
            // ...
        ));
    }
    /**
     * @Route("/customers/all", name="adminPanel_customers_all")
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function panelCustomersAllAction() {
        return $this->redirectToRoute("person_index");

    }

    /**
     * @Route("/customers/searchBySurname", name="adminPanel_customers_findBySurnameForm")
     * @Security("has_role('ROLE_ADMIN')")
     * @Method("GET")
     */
    public function panelCustomersSearchBySurnameFormAction() {
        return $this->render("WorkshopBundle:Admin:panelCustomers_findBySurnameForm.html.twig");
    }

    /**
     * @Route("/customers/addCustomer", name="adminPanel_customers_addCustomer")
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function panelCustomersAddCustomerAction() {
        return $this->render('WorkshopBundle:Admin:panelCustomers.html.twig', array());

    }

    /**
     * @Route("/findBySurname", name="adminPanel_customers_findBySurname")
     * @Security("has_role('ROLE_ADMIN')")
     * @Method("POST")
     */
    public function panelCustomerFindPersonBySurnameFormAction(Request $request) {
        $surname = $request->request->get('surname');
        $customer = $this->getDoctrine()->getRepository(Person::class)->findCustomerBySurname($surname);
        return $this->render("WorkshopBundle:Admin:panelCustomers_findBySurname.html.twig", array('cust'=>$customer));
    }

    /**
     * @Route("/vehicles", name="adminPanel_vehicles")
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function panelVehiclesAction()
    {
        return $this->render('WorkshopBundle:Admin:panelVehicles.html.twig', array(
            // ...
        ));
    }


    /**
     * @Route("/vehicles/all", name="adminPanel_vehicles_all")
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function panelVehiclesAllAction() {
        return $this->redirectToRoute("vehicle_index");
    }

    /**
     * @Route("/customers/addCustomer", name="adminPanel_customers_addVehicle")
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function panelCustomersAddVehicleAction() {
        return $this->render('WorkshopBundle:Admin:panelVehicles_addVehicles.html.twig', array());

    }

}
