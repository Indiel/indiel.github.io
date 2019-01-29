<?php

namespace AppBundle\Helper;

use Symfony\Component\HttpFoundation\RequestStack;
use GuzzleHttp\Client;

class TrackingSalesdoublerHelper
{
    /**
     * @var RequestStack
     */
    private $requestStack;

    /**
     * @var string
     */
    private $clickId;

    /**
     * @var Client
     */
    private $salesdoubler;

    /**
     * @var string
     */
    private $token;
    
    public function __construct(RequestStack $requestStack, Client $salesdoubler, $token)
    {
        $this->requestStack = $requestStack;
        if ($requestStack->getMasterRequest()) {
            $this->clickId = $requestStack->getMasterRequest()->cookies->get('subid');
        }
        $this->salesdoubler = $salesdoubler;
        $this->token = $token;
    }
    
    public function postBack($loanId)
    {
        if (!$this->clickId) {
            return;
        }
        $params = [
            'trans_id' => $loanId,
            'token' => $this->token
        ];
        $url = $this->clickId . '?' . http_build_query($params);
        $this->salesdoubler->get($url);
    }

    public function getClickId()
    {
        return $this->clickId;
    }
}