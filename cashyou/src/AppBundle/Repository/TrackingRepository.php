<?php

namespace AppBundle\Repository;

use AppBundle\Entity\Tracking;
use AppBundle\Entity\TrackingStatus;
use Doctrine\ORM\EntityRepository;

class TrackingRepository extends EntityRepository
{
    public function clearExpired()
    {
        $qb = $this
            ->getEntityManager()
            ->createQueryBuilder();

        return $qb
            ->delete(Tracking::class, 't')
            ->where($qb->expr()->lt('t.created', '?1'))
            ->setParameter(1, new \DateTime('-1 month'))
            ->getQuery()
            ->execute();
    }

    /**
     * @return Tracking[]
     */
    public function updateExpiredLeads()
    {
        $qb = $this
            ->getEntityManager()
            ->createQueryBuilder();

        $trackingItems = $qb
            ->select('t')
            ->from(Tracking::class, 't')
            ->where($qb->expr()->eq('t.status', '?1'))
            ->andWhere($qb->expr()->lt('t.created', '?2'))
            ->setParameter(1, TrackingStatus::LEAD)
            ->setParameter(2, new \DateTime('-120 hour'))
            ->getQuery()
            ->execute();

        if (empty($trackingItems)) {
            return [];
        }

        $ids = array_map(function(Tracking $tracking){
            $this->getEntityManager()->detach($tracking);
            return $tracking->getId();
        }, $trackingItems);

        $qb = $this
            ->getEntityManager()
            ->createQueryBuilder();

        $qb
            ->update(Tracking::class, 't')
            ->set('t.status', '?1')
            ->where($qb->expr()->in('t.id', '?2'))
            ->setParameter(1, TrackingStatus::REJECTED)
            ->setParameter(2, $ids)
            ->getQuery()
            ->execute();

        $qb = $this
            ->getEntityManager()
            ->createQueryBuilder();

        $trackingItems = $qb
            ->select('t')
            ->from(Tracking::class, 't')
            ->where($qb->expr()->in('t.id', '?1'))
            ->setParameter(1, $ids)
            ->getQuery()
            ->execute();

        return $trackingItems;
    }
}