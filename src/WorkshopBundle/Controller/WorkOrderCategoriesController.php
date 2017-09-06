<?php

namespace WorkshopBundle\Controller;

use WorkshopBundle\Entity\WorkOrderCategories;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Workordercategory controller.
 *
 * @Route("workordercategories")
 */
class WorkOrderCategoriesController extends Controller
{
    /**
     * Lists all workOrderCategory entities.
     *
     * @Route("/", name="workordercategories_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $workOrderCategories = $em->getRepository('WorkshopBundle:WorkOrderCategories')->findAll();

        return $this->render('workordercategories/index.html.twig', array(
            'workOrderCategories' => $workOrderCategories,
        ));
    }

    /**
     * Creates a new workOrderCategory entity.
     *
     * @Route("/new", name="workordercategories_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $workOrderCategory = new Workordercategory();
        $form = $this->createForm('WorkshopBundle\Form\WorkOrderCategoriesType', $workOrderCategory);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($workOrderCategory);
            $em->flush();

            return $this->redirectToRoute('workordercategories_show', array('id' => $workOrderCategory->getId()));
        }

        return $this->render('workordercategories/new.html.twig', array(
            'workOrderCategory' => $workOrderCategory,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a workOrderCategory entity.
     *
     * @Route("/{id}", name="workordercategories_show")
     * @Method("GET")
     */
    public function showAction(WorkOrderCategories $workOrderCategory)
    {
        $deleteForm = $this->createDeleteForm($workOrderCategory);

        return $this->render('workordercategories/show.html.twig', array(
            'workOrderCategory' => $workOrderCategory,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing workOrderCategory entity.
     *
     * @Route("/{id}/edit", name="workordercategories_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, WorkOrderCategories $workOrderCategory)
    {
        $deleteForm = $this->createDeleteForm($workOrderCategory);
        $editForm = $this->createForm('WorkshopBundle\Form\WorkOrderCategoriesType', $workOrderCategory);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('workordercategories_edit', array('id' => $workOrderCategory->getId()));
        }

        return $this->render('workordercategories/edit.html.twig', array(
            'workOrderCategory' => $workOrderCategory,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a workOrderCategory entity.
     *
     * @Route("/{id}", name="workordercategories_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, WorkOrderCategories $workOrderCategory)
    {
        $form = $this->createDeleteForm($workOrderCategory);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($workOrderCategory);
            $em->flush();
        }

        return $this->redirectToRoute('workordercategories_index');
    }

    /**
     * Creates a form to delete a workOrderCategory entity.
     *
     * @param WorkOrderCategories $workOrderCategory The workOrderCategory entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(WorkOrderCategories $workOrderCategory)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('workordercategories_delete', array('id' => $workOrderCategory->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
