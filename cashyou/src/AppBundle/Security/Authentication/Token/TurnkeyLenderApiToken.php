<?php
namespace AppBundle\Security\Authentication\Token;

use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;

class TurnkeyLenderApiToken extends UsernamePasswordToken
{
    /**
     * @var string
     */
    private $apiToken;

    public function __construct($user, $credentials, $providerKey, $apiToken, array $roles)
    {
        parent::__construct($user, $credentials, $providerKey, $roles);

        $this->apiToken = $apiToken;
    }

    /**
     * @return string
     */
    public function getApiToken()
    {
        return $this->apiToken;
    }

    /**
     * {@inheritdoc}
     */
    public function serialize()
    {
        return serialize(array($this->apiToken, parent::serialize()));
    }

    /**
     * {@inheritdoc}
     */
    public function unserialize($serialized)
    {
        list($this->apiToken, $parentStr) = unserialize($serialized);
        parent::unserialize($parentStr);
    }
}