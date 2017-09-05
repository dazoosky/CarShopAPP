<?php

namespace WorkshopBundle\Controller;

use WorkshopBundle\Entity\WorkOrder;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

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

        return $this->render('workorder/show.html.twig', array(
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
}
