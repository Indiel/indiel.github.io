<?php
namespace AppBundle\Security\User;

use Symfony\Component\Security\Core\Role\Role;
use Symfony\Component\Security\Core\User\UserInterface;

class ApiUser implements UserInterface
{
    private $username;
    private $apiToken;

    public function __construct($username, $apiToken)
    {
        $this->username = $username;
        $this->apiToken = $apiToken;
    }

    /**
     * @inheritdoc
     */
    public function getRoles()
    {
        return [new Role('ROLE_API_USER')];
    }

    /**
     * @inheritdoc
     */
    public function getPassword()
    {
        return null;
    }

    /**
     * @inheritdoc
     */
    public function getSalt()
    {
        return null;
    }

    /**
     * @inheritdoc
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @inheritdoc
     */
    public function eraseCredentials()
    {
    }

    /**
     * @return string
     */
    public function getApiToken()
    {
        return $this->apiToken;
    }
}