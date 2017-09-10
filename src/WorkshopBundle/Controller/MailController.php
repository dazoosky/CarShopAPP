<?php

namespace WorkshopBundle\Controller;

use WorkshopBundle\Entity\Mail;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Mail controller.
 *
 * @Route("mail")
 */
class MailController extends Controller
{

    /**
     * @Route("/panel", name="mail_panel")
     */
    public function panelAction() {
        return $this->render('WorkshopBundle:Admin:panelMail.html.twig');
    }



    /**
     * Lists all mail entities.
     *
     * @Route("/", name="mail_index")
     * @Method("GET")
     */


    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $mails = $em->getRepository('WorkshopBundle:Mail')->findAll();

        return $this->render('mail/index.html.twig', array(
            'mails' => $mails,
        ));
    }

    /**
     * Creates a new mail entity.
     *
     * @Route("/new", name="mail_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $mail = new Mail();
        $mail->setSender($this->container->get('security.context')->getToken()->getUser()->getEmail());
        $form = $this->createForm('WorkshopBundle\Form\MailType', $mail);
        $form->remove('sendDate');
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $msg = new \Swift_Message('Hello mail');
            $msg->setFrom($user = $this->container->get('security.context')->getToken()->getUser()->getEmail());
            $msg->setTo($mail->getReciever());
            $msg->setContentType('html');
            $msg->setBody($this->renderView('WorkshopBundle/Email/email.html.twig',
                    array('context' => $mail->getText())),'text/html');
            $this->get('mailer')->send($msg);
            $date = new \DateTime();
            $mail->setSendDate($date);
            $em = $this->getDoctrine()->getManager();
            $em->persist($mail);
            $em->flush();

            return $this->redirectToRoute('mail_show', array('id' => $mail->getId()));
        }

        return $this->render('WorkshopBundle:Admin:panelMail_new.html.twig', array(
            'mail' => $mail,
            'form' => $form->createView(),
        ));
    }

    /**
     * Creates a new mail entity.
     *
     * @Route("/new/{receiver}", name="mail_newWithReciever")
     * @Method({"GET", "POST"})
     */
    public function newWithReceiverAction(Request $request, $receiver)
    {
        $mail = new Mail();
        if (!filter_var($receiver, FILTER_VALIDATE_EMAIL)) {
            return $this->redirectToRoute('mail_new');
        }
        $mail->setReciever($receiver);
        $mail->setSender($this->container->get('security.context')->getToken()->getUser()->getEmail());
        $form = $this->createForm('WorkshopBundle\Form\MailType', $mail);
        $form->remove('sendDate');
        $form->handleRequest($request);



        if ($form->isSubmitted() && $form->isValid()) {
            $msg = new \Swift_Message('Hello mail');
            $msg->setContentType('html');
            $msg->setBody($this->renderView('WorkshopBundle/Email/email.html.twig',
                array('context' => $mail->getText())),'text/html');
            $this->get('mailer')->send($msg);
            $mail->setSendDate(new \DateTime());
            $em = $this->getDoctrine()->getManager();
            $em->persist($mail);
            $em->flush();

            return $this->redirectToRoute('mail_show', array('id' => $mail->getId()));
        }


        return $this->render('WorkshopBundle:Admin:panelMail_newWithReceiver.html.twig', array(
            'mail' => $mail,
            'form' => $form->createView(),
        ));
    }


    /**
     * Finds and displays a mail entity.
     *
     * @Route("/{id}", name="mail_show")
     * @Method("GET")
     */
    public function showAction(Mail $mail)
    {
        $deleteForm = $this->createDeleteForm($mail);

        return $this->render('mail/show.html.twig', array(
            'mail' => $mail,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing mail entity.
     *
     * @Route("/{id}/edit", name="mail_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Mail $mail)
    {
        $deleteForm = $this->createDeleteForm($mail);
        $editForm = $this->createForm('WorkshopBundle\Form\MailType', $mail);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('mail_edit', array('id' => $mail->getId()));
        }

        return $this->render('mail/edit.html.twig', array(
            'mail' => $mail,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a mail entity.
     *
     * @Route("/{id}", name="mail_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Mail $mail)
    {
        $form = $this->createDeleteForm($mail);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($mail);
            $em->flush();
        }

        return $this->redirectToRoute('mail_index');
    }

    /**
     * Creates a form to delete a mail entity.
     *
     * @param Mail $mail The mail entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Mail $mail)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('mail_delete', array('id' => $mail->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
