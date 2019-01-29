<?php
/**
 * Created by PhpStorm.
 * User: r00d1k
 * Date: 8/16/18
 * Time: 1:43 AM
 */

namespace AppBundle\Helper;

use GuzzleHttp\Client;

class CashyouTrackerHelper
{
    protected $client;

    protected $token;

    public function __construct(Client $client, $token)
    {
        $this->client = $client;
        $this->token = $token;
    }

    public function track($sid, $target)
    {
        $options = [
            'auth'    => ['Bearer', $this->token],
            'headers' => ['Accept' => 'application/json'],
            'json'    => ['sid' => $sid, 'target' => $target],
        ];

        $this->client->post('', $options);
    }
}