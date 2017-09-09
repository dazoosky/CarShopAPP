<?php

namespace WorkshopBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * WorkOrderRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class WorkOrderRepository extends EntityRepository
{
    public function findOrderByStatus($status)
    {
        return $this->getEntityManager()
            ->createQuery(
                'SELECT p FROM WorkshopBundle:workorder p WHERE p.status = :status')->setParameter('status', $status)
            ->getResult();
    }

    public function findOrderByVehicle($vehicle)
    {
        return $this->getEntityManager()
            ->createQuery(
                'SELECT p FROM WorkshopBundle:workorder p WHERE p.vehicleId = :vehicle')->setParameter('vehicle', $vehicle)
            ->getResult();
    }

}
