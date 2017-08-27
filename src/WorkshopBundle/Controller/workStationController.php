<?php

namespace WorkshopBundle\Controller;

use WorkshopBundle\Entity\workStation;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * Workstation controller.
 *
 * @Route("workstation")
 */
class workStationController extends Controller
{
    /**
     * Lists all workStation entities.
     *
     * @Route("/", name="workstation_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $workStations = $em->getRepository('WorkshopBundle:workStation')->findAll();

        return $this->render('workstation/index.html.twig', array(
            'workStations' => $workStations,
        ));
    }

    /**
     * Finds and displays a workStation entity.
     *
     * @Route("/{id}", name="workstation_show")
     * @Method("GET")
     */
    public function showAction(workStation $workStation)
    {

        return $this->render('workstation/show.html.twig', array(
            'workStation' => $workStation,
        ));
    }
}
