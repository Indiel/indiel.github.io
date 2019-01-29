<?php
namespace AppBundle\Security\User;

use Doctrine\Common\Cache\CacheProvider;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;

class ApiUserProvider implements UserProviderInterface
{
    private $cache;
    private $secret;

    public function __construct(CacheProvider $cache, $secret)
    {
        $this->cache = $cache;
        $this->secret = $secret;
    }

    public function loadUserByUsername($username)
    {
        $user = $this->cache->fetch( md5($username . $this->secret) );

        if ($user instanceof ApiUser) {
            return $user;
        }

        throw  new UsernameNotFoundException();
    }

    public function refreshUser(UserInterface $user)
    {
        if (!$user instanceof ApiUser) {
            throw new UnsupportedUserException(
                sprintf('Instances of "%s" are not supported.', get_class($user))
            );
        }

        return $this->loadUserByUsername($user->getUsername());
    }

    public function supportsClass($class)
    {
        return ApiUser::class === $class;
    }
}