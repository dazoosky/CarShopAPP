<?php

namespace WorkshopBundle\Controller;

use WorkshopBundle\Entity\Vehicle;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * Vehicle controller.
 *
 * @Route("vehicle")
 */
class VehicleController extends Controller
{
    /**
     * Lists all vehicle entities.
     *
     * @Route("/", name="vehicle_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $vehicles = $em->getRepository('WorkshopBundle:Vehicle')->findAll();

        return $this->render('vehicle/index.html.twig', array(
            'vehicles' => $vehicles,
        ));
    }

    /**
     * Finds and displays a vehicle entity.
     *
     * @Route("/{id}", name="vehicle_show")
     * @Method("GET")
     */
    public function showAction(Vehicle $vehicle)
    {

        return $this->render('vehicle/show.html.twig', array(
            'vehicle' => $vehicle,
        ));
    }
}
