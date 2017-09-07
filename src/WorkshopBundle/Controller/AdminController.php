<?php

namespace WorkshopBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\Request;
use WorkshopBundle\Entity\Person;
use WorkshopBundle\Entity\Vehicle;
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
     * @Route("/customersMenu", name="adminPanel_customers")
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function panelCustomersAction()
    {
        return $this->render('WorkshopBundle:Admin:panelCustomers.html.twig', array(
            // ...
        ));
    }

    /**
     * @Route("/ordersMenu", name="adminPanel_orders")
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function panelOrdersAction()
    {
        return $this->render('WorkshopBundle:Admin:panelOrders.html.twig', array(
            // ...
        ));
    }

    /**
     * @Route("/customers/all", name="adminPanel_customers_all")
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function panelCustomersAllAction() {
        $customers = $this->getDoctrine()->getRepository(Person::class)->findAllCustomers();
        return $this->render("WorkshopBundle:Admin:panelCustomersShowAll.html.twig", array('customers'=>$customers, 'who'=>'klientów', 'showIfCustomer' => false));

    }

    /**
     * @Route("/workersMenu", name="adminPanel_workers")
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function panelWorkersAction() {
        $customers = $this->getDoctrine()->getRepository(Person::class)->findAllWorkers();
        return $this->render("WorkshopBundle:Admin:panelCustomersShowAll.html.twig", array('customers'=>$customers, 'who'=>'pracowników', 'showIfCustomer' => false));

    }


    /**
     * @Route("/customers/searchBySurname", name="adminPanel_customers_findBySurnameForm")
     * @Security("has_role('ROLE_ADMIN')")
     * @Method("GET")
     */
    public function panelCustomerFindPersonBySurnameFormAction() {
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
     * @Route("/findCustomerBySurname", name="adminPanel_customers_findBySurname")
     * @Security("has_role('ROLE_ADMIN')")
     * @Method("POST")
     */
    public function panelCustomerFindPersonBySurnameAction(Request $request) {
        $surname = $request->request->get('surname');
        $customer = $this->getDoctrine()->getRepository(Person::class)->findCustomerBySurname($surname);
        return $this->render("WorkshopBundle:Admin:panelCustomersShowAll.html.twig", array('customers'=>$customer, 'who'=>'wyników', 'showIfCustomer' => false));
    }

    /**
     * @Route("/vehiclesMenu", name="adminPanel_vehicles")
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
     * @Route("/vehicles/add", name="adminPanel_vehicles_addVehicle")
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function panelCustomersAddVehicleAction() {
        return $this->render('WorkshopBundle:Admin:panelVehicles_addVehicle.html.twig', array());

    }

    /**
     * @Route("/vehicles/findByOwner", name="adminPanel_vehicles_findByOwnerForm")
     * @Security("has_role('ROLE_ADMIN')")
     * @Method("GET")
     */
    public function panelVehicleFindByOwnerFormAction() {
        return $this->render("WorkshopBundle:Admin:panelVehicles_findByOwnerForm.html.twig");
    }


    /**
     * @Route("/vehicles/findVehicleByOwner", name="adminPanel_vehicles_findByOwner")
     * @Security("has_role('ROLE_ADMIN')")
     * @Method("POST")
     */
    public function panelVehicleFindByOwnerAction(Request $request) {
        $surname = trim($request->request->get('owner'));
        $owner = $this->getDoctrine()->getRepository(Person::class)->findBySurname($surname);
        $vehicles = $this->getDoctrine()->getRepository(Vehicle::class)->findVehicleByOwner($owner);
        return $this->render("WorkshopBundle:Admin:panelVehicles_showAll.html.twig", array('vehicles'=>$vehicles));
    }

    /**
     * @Route("/vehicles/findByVin", name="adminPanel_vehicles_findByVinForm")
     * @Security("has_role('ROLE_ADMIN')")
     * @Method("GET")
     */
    public function panelVehicleFindByVinFormAction() {
        return $this->render("WorkshopBundle:Admin:panelVehicles_findByVinForm.html.twig");
    }


    /**
     * @Route("/vehicles/findByVin", name="adminPanel_vehicles_findByVin")
     * @Security("has_role('ROLE_ADMIN')")
     * @Method("POST")
     */
    public function panelVehicleFindByVinAction(Request $request) {
        $vin = $request->request->get('vin');
        $vehicles = $this->getDoctrine()->getRepository(Vehicle::class)->findVehicleByVin($vin);
        return $this->render("WorkshopBundle:Admin:panelVehicles_showAll.html.twig", array('vehicles'=>$vehicles));
    }


    /**
     * @Route("/vehicles/findByPlateno", name="adminPanel_vehicles_findByPlatenoForm")
     * @Security("has_role('ROLE_ADMIN')")
     * @Method("GET")
     */
    public function panelVehicleFindByPlatenoFormAction() {
        return $this->render("WorkshopBundle:Admin:panelVehicles_findByPlatenoForm.html.twig");
    }


    /**
     * @Route("/vehicles/findByPlateno", name="adminPanel_vehicles_findByPlateno")
     * @Security("has_role('ROLE_ADMIN')")
     * @Method("POST")
     */
    public function panelVehicleFindByPlatenoAction(Request $request) {
        $plateno = $request->request->get('plateno');
        $plateno = preg_replace('~\s~', '', $plateno);
        $vehicles = $this->getDoctrine()->getRepository(Vehicle::class)->findVehicleByPlateno($plateno);
        return $this->render("WorkshopBundle:Admin:panelVehicles_showAll.html.twig", array('vehicles'=>$vehicles));
    }

    /**
     * @Route("/users/all", name="adminPanel_users_all")
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function panelUsersAllAction() {
        return $this->redirectToRoute("person_index");

    }

}
