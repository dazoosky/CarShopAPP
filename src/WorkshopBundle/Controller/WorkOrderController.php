<?php

namespace WorkshopBundle\Controller;

use WorkshopBundle\Entity\WorkOrder;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * Workorder controller.
 *
 * @Route("workorder")
 */
class WorkOrderController extends Controller
{
    /**
     * Lists all workOrder entities.
     *
     * @Route("/", name="workorder_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $workOrders = $em->getRepository('WorkshopBundle:WorkOrder')->findAll();

        return $this->render('workorder/index.html.twig', array(
            'workOrders' => $workOrders,
        ));
    }

    /**
     * Finds and displays a workOrder entity.
     *
     * @Route("/{id}", name="workorder_show")
     * @Method("GET")
     */
    public function showAction(WorkOrder $workOrder)
    {

        return $this->render('workorder/show.html.twig', array(
            'workOrder' => $workOrder,
        ));
    }
}
