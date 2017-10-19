<?php
namespace WorkshopBundle\Controller;

use WorkshopBundle\Entity\Photo;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\Annotations\Post;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations\Get;



class ApiController extends FOSRestController {


    /**
     * @Get("workorders/all")
     * @return Response
     */
    public function getWorkordersAction() {

        $em = $this->getDoctrine()->getManager();
        $workOrders = $em->getRepository('WorkshopBundle:WorkOrder')->findAll();
        if ($workOrders === []) {
            $view = $this->view("There are no work orders to show", 200)->setFormat('json');
            return $this->handleView($view);
        }
        $array = self::createWorkOrdersArrayAsList($workOrders);

        $view = $this->view($array,200)->setFormat('json');
        return $this->handleView($view);

    }

    /**
     * @Get("workorders/wip")
     * @return Response
     */
    public function getWorkordersinprogressAction() {
        $em = $this->getDoctrine()->getManager();
        $workOrders = $em->getRepository('WorkshopBundle:WorkOrder')->findOrderByStatus(2);
        if ($workOrders === []) {
            $view = $this->view("There are no work orders to show", 200)->setFormat('json');
            return $this->handleView($view);
        }
        $array = self::createWorkOrdersArrayAsList($workOrders);

        $view = $this->view($array,200)->setFormat('json');
        return $this->handleView($view);
    }

    /**
     * @Get("workorders/{id}")
     * @param $id
     * @return Response
     */
    public function getWorkorderdetailsAction($id) {
        $em = $this->getDoctrine()->getManager();
        $workOrders = $em->getRepository('WorkshopBundle:WorkOrder')->findById($id);
        if ($workOrders === []) {
            $view = $this->view("There are no work orders to show", 200)->setFormat('json');
            return $this->handleView($view);
        }
        $array = self::createWorkOrdersArrayWithDetails($workOrders);

        $view = $this->view($array,200)->setFormat('json');
        return $this->handleView($view);
    }

//    public function get

    //Method to get detailed list of workorders
    static public function createWorkOrdersArrayWithDetails($workOrders) {
        $array = [];
        foreach($workOrders as $workOrder) {
            foreach($workOrder->getPhotos() as $photo) {
                $photos[] = $photo->getName();
            }
            $vehicle = $workOrder->getVehicleId()->getIntoAboutVehicle();
            $owner = $workOrder->getVehicleId()->getOwner()->getInfoAbout();
            $item = [
                'workorderId' => $workOrder->getId(),
                'photos' => $photos,
                'vehicle' => $vehicle,
                'owner' => $owner,
            ];
            $array[] = $item;
        }
        return $array;
    }

    //Method to get simple list of workorders
    static public function createWorkOrdersArrayAsList($workOrders) {
        $array = [];
        foreach($workOrders as $workOrder) {

            $item = [
                'workorderId' => $workOrder->getId(),
                'vehicle' => $workOrder->getVehicleId()->getMakeModelYear(),
                'plateNo' => $workOrder->getVehicleId()->getPlateNo(),
                'status' => $workOrder->getStatus(),
            ];
            $array[] = $item;
        }
        return $array;
    }


    /**
     * @Post("workorder/addPhoto")
     * @param Request $request
     * @return Response
     */
    public function putPhotoAction(Request $request)
    {
        $photo = new Photo();
        $form = $this->createForm('WorkshopBundle\Form\PhotoType', $photo);
        $form->handleRequest($request);
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $user = $em->getRepository('WorkshopBundle:User')->findOneById(13);
            $photo->setAuthor($user);
            $photo->setWorkorder($workOrder);

            $file = $photo->getName();
            $fileName = md5(uniqid()).'.'.$file->guessExtension();
            $file->move(
                $this->getParameter('photos_directory'),
                $fileName
            );

            $response = new Response();
            $response->setStatusCode($statusCode);

            // set the `Location` header only when creating new resources
            if (201 === $statusCode) {
                $response->headers->set('Location',
                    $this->generateUrl(
                        'acme_demo_user_get', array('id' => $user->getId()),
                        true // absolute
                    )
                );
            }

            return $response;
        }
        $view = $this->view("Not workin", 400)->setFormat('json');
        return $this->handleView($view);
    }




}