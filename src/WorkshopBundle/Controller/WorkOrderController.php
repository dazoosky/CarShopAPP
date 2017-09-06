<?php

namespace WorkshopBundle\Controller;

use WorkshopBundle\Entity\Vehicle;
use WorkshopBundle\Entity\WorkOrder;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;
use WorkshopBundle\WorkshopBundle;

/**
 * Workorder controller.
 *
 * @Route("admin/workorder")
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

        return $this->render('WorkshopBundle:Admin:panelOrders_showAll.html.twig', array(
            'workOrders' => $workOrders,
        ));
    }

    /**
     * Creates a new workOrder entity.
     *
     * @Route("/new", name="workorder_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $workOrder = new Workorder();
        $form = $this->createForm('WorkshopBundle\Form\WorkOrderType', $workOrder);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($workOrder);
            $em->flush();

            return $this->redirectToRoute('workorder_show', array('id' => $workOrder->getId()));
        }

        return $this->render('WorkshopBundle:Admin:panelOrders_newOrder.html.twig', array(
            'workOrder' => $workOrder,
            'form' => $form->createView(),
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
        $deleteForm = $this->createDeleteForm($workOrder);
        $workOrder->setToDo(unserialize($workOrder->getToDo()));

        return $this->render('WorkshopBundle:Admin:panelOrders_showOrder.html.twig', array(
            'workOrder' => $workOrder,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing workOrder entity.
     *
     * @Route("/{id}/edit", name="workorder_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, WorkOrder $workOrder)
    {
        $deleteForm = $this->createDeleteForm($workOrder);
        $editForm = $this->createForm('WorkshopBundle\Form\WorkOrderType', $workOrder);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('workorder_edit', array('id' => $workOrder->getId()));
        }

        return $this->render('workorder/edit.html.twig', array(
            'workOrder' => $workOrder,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a workOrder entity.
     *
     * @Route("/{id}", name="workorder_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, WorkOrder $workOrder)
    {
        $form = $this->createDeleteForm($workOrder);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($workOrder);
            $em->flush();
        }

        return $this->redirectToRoute('workorder_index');
    }

    /**
     * Creates a form to delete a workOrder entity.
     *
     * @param WorkOrder $workOrder The workOrder entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(WorkOrder $workOrder)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('workorder_delete', array('id' => $workOrder->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }

    /**
     * Creates a new workOrder entity for specific vehicle.
     *
     * @Route("/vehicle/new/{id}", name="vehicle_new_order")
     * @Method({"GET", "POST"})
     */
    public function vehicleNewOrderAction(Request $request, $id)
    {
        $workOrder = new Workorder();
        $form = $this->createForm('WorkshopBundle\Form\WorkOrderType', $workOrder);
        $form->remove('vehicleId')->remove('value')->remove('duration');
        $form->handleRequest($request);
        $todo = $this->handleCustomFields($request);
        $categories = $this->getDoctrine()->getRepository('WorkshopBundle:WorkOrderCategories')->findAll();

//        $x = $this->get('request')->request->get('1');
        if ($form->isSubmitted() && $form->isValid()) {
            $vehicle = $this->getDoctrine()->getRepository(Vehicle::class)->findById($id);
            $workOrder->setVehicleId($vehicle[0]);
            $workOrder->setToDo(serialize($todo));
            $em = $this->getDoctrine()->getManager();
            $em->persist($workOrder);
            $em->flush();

            return $this->redirectToRoute('workorder_show', array('id' => $workOrder->getId()));
        }

        return $this->render('WorkshopBundle:Admin:panelOrders_newOrder.html.twig', array(
            'workOrder' => $workOrder,
            'categories' => $categories,

            'form' => $form->createView(),
        ));
    }

    /**
     * @Route("/ordersInProgress/", name="adminPanel_orders_ordersInProgress")
     * @Method("GET")
     */
    public function findOrdersInProgressAction() {
        $em = $this->getDoctrine()->getManager();
        $status = $em->getRepository('WorkshopBundle:OrderStatus')->findById(2);
        $workOrders = $em->getRepository('WorkshopBundle:WorkOrder')->findByStatus($status);

        return $this->render('WorkshopBundle:Admin:panelOrders_showAll.html.twig', array(
            'workOrders' => $workOrders,
        ));
    }

    /**
     * @Route("/ordersNew/", name="adminPanel_orders_new")
     * @Method("GET")
     */
    public function findOrdersNewAction() {
        $em = $this->getDoctrine()->getManager();
        $status = $em->getRepository('WorkshopBundle:OrderStatus')->findById(1);
        $workOrders = $em->getRepository('WorkshopBundle:WorkOrder')->findByStatus($status);

        return $this->render('WorkshopBundle:Admin:panelOrders_showAll.html.twig', array(
            'workOrders' => $workOrders,
        ));
    }

    private function handleCustomFields(Request $request) {
        $array['Silnik']= $this->get('request')->request->get('engine');
        $array['Układ napędowy'] = $this->get('request')->request->get('drivetrain');
        $array['Hamulce'] = $this->get('request')->request->get('brakes');
        $array['Zawieszenie'] = $this->get('request')->request->get('suspension');
        $array['Układ elektryczny'] = $this->get('request')->request->get('electric');
        $array['Nadwozie'] = $this->get('request')->request->get('body');
        $array['Podwozie'] = $this->get('request')->request->get('frame');
        $array['Wnętrze'] = $this->get('request')->request->get('interior');
        $array['Koła'] = $this->get('request')->request->get('wheels');
        $ac = $this->get('request')->request->get('aircon');
        $ins = $this->get('request')->request->get('inspection');
        if ($ac == null) {
            $array['Klimatyzacja'] = 'NIE';
        }
        else {
            $array['Klimatyzacja'] = 'TAK';
        }
        if ($ins == null) {
            $array['Przegląd ogólny'] = 'NIE';
        }
        else {
            $array['Przegląd ogólny'] = 'TAK';
        }
        return $array;
    }


}
