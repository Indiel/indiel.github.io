<?php

namespace AppBundle\Helper;

use AppBundle\Entity\Tracking;
use AppBundle\Entity\TrackingStatus;
use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpFoundation\RequestStack;
use Doctrine\Common\Persistence\ObjectRepository;
use AppBundle\Repository\TrackingRepository;
use GuzzleHttp\Client;

class TrackingHelper
{
    /**
     * @var RequestStack
     */
    private $requestStack;

    /**
     * @var string
     */
    private $subId;

    /**
     * @var ObjectRepository
     */
    private $repository;

    /**
     * @var EntityManager
     */
    private $entityManager;

    /**
     * @var Client
     */
    private $keitaro;
    
    public function __construct(RequestStack $requestStack, EntityManager $entityManager, TrackingRepository $repository, Client $keitaro)
    {
        $this->requestStack = $requestStack;
        $this->entityManager = $entityManager;
        $this->repository = $repository;
        if ($requestStack->getMasterRequest()) {
            $this->subId = $requestStack->getMasterRequest()->cookies->get('subid');
        }
        $this->keitaro = $keitaro;
    }
    
    public function postBack(TrackingStatus $status, $params = array())
    {
        if (!$this->subId) {
            return;
        }
        
        $tracking = $this->repository->findOneBy([
            'subId' => $this->subId,
        ]);

        if (!$tracking) {
            $tracking = new Tracking();
            $tracking->setSubId($this->subId);
        }
        
        $tracking->setStatus($status);

        $this->entityManager->persist($tracking);
        $this->entityManager->flush();
        
        $defaults = [
            'subid' => $this->subId,
            'status' => $status->getValue(),
        ];
        
        $params = array_merge($defaults, $params);

        $this->keitaro->get('postback?' . http_build_query($params));
    }

    public function updateExpiredLeads()
    {
        $removedCount = $this->repository->clearExpired();
        $expiredLeads = $this->repository->updateExpiredLeads();

        foreach ($expiredLeads as $expiredLead) {
            $params = [
                'subid' => $expiredLead->getSubId(),
                'status' => $expiredLead->getStatus()->getValue(), //always should be "rejected"
            ];

            $this->keitaro->get('postback?' . http_build_query($params));
        }

        return [
            'removed' => $removedCount,
            'rejected' => count($expiredLeads),
        ];
    }
}