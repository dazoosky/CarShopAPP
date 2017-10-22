<?php

namespace WorkshopBundle\Controller;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use WorkshopBundle\Entity\Photo;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Photo controller.
 *
 * @Route("photo")
 */
class PhotoController extends Controller
{
    /**
     * Lists all photo entities.
     *
     * @Route("/", name="photo_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $photos = $em->getRepository('WorkshopBundle:Photo')->findAll();

        return $this->render('photo/index.html.twig', array(
            'photos' => $photos,
        ));
    }

    /**
     * Creates a new photo entity.
     *
     * @Route("/new/{workOrderId}", name="photo_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request, $workOrderId = 0)
    {
        $photo = new Photo();
        $form = $this->createForm('WorkshopBundle\Form\PhotoType', $photo);
//        $form = $this->createForm(PhotoType::class, $photo);
        $form->remove('author');
        $form->remove('workOrder');
        $form->handleRequest($request);
        $em = $this->getDoctrine()->getManager();
        $workOrder = $em->getRepository('WorkshopBundle:WorkOrder')->findOneById($workOrderId);
        if ($form->isSubmitted() && $form->isValid()) {
            $user = $this->container->get('security.context')->getToken()->getUser();
            $photo->setAuthor($user);
            $photo->setWorkorder($workOrder);

            $file = $photo->getName();
            $fileName = md5(uniqid()).'.'.$file->guessExtension();
            $file->move(
                $this->getParameter('photos_directory'),
                $fileName
            );
            $photo->setName($fileName);

            $em = $this->getDoctrine()->getManager();
            $em->persist($photo);
            $em->flush();
            $this->addFlash(
                'notice',
                'Zdjęcie dodane!'
            );
            return $this->redirectToRoute('workorder_show', array('id' => $workOrder->getId()));
        }

        return $this->render('WorkshopBundle:Admin:addPhotoForm.html.twig', array(
            'photo' => $photo,
            'form' => $form->createView(),
            'workOrder' => $workOrder,
        ));
    }

    /**
     * Finds and displays a photo entity.
     *
     * @Route("/{id}", name="photo_show")
     * @Method("GET")
     */
    public function showAction(Photo $photo)
    {
        $deleteForm = $this->createDeleteForm($photo);

        return $this->render('WorkshopBundle:Admin:photoShow.html.twig', array(
            'photo' => $photo,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing photo entity.
     *
     * @Route("/{id}/edit", name="photo_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Photo $photo)
    {
        $deleteForm = $this->createDeleteForm($photo);
        $editForm = $this->createForm('WorkshopBundle\Form\PhotoType', $photo);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('photo_edit', array('id' => $photo->getId()));
        }

        return $this->render('photo/edit.html.twig', array(
            'photo' => $photo,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a photo entity.
     *
     * @Route("/{id}", name="photo_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Photo $photo)
    {
        $form = $this->createDeleteForm($photo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($photo);
            $em->flush();
        }

        return $this->redirectToRoute('photo_index');
    }

    /**
     * Creates a form to delete a photo entity.
     *
     * @param Photo $photo The photo entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Photo $photo)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('photo_delete', array('id' => $photo->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            // ...
            ->add('name', FileType::class, array('label' => 'Dodaj zdjęcie'))
            // ...
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Photo::class,
        ));
    }
}
