<?php


namespace AppBundle\Security\Authentication\Provider;

use AppBundle\Security\Authentication\Token\TurnkeyLenderApiToken;
use AppBundle\Security\User\ApiUser;
use Doctrine\Common\Cache\CacheProvider;
use Symfony\Component\Security\Core\Authentication\Provider\AuthenticationProviderInterface;
use Symfony\Component\Security\Core\Encoder\EncoderFactoryInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Core\Exception\BadCredentialsException;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use AppBundle\Helper\TurnkeyLenderApi;

class ApiProvider implements AuthenticationProviderInterface
{
    private $hideUserNotFoundExceptions;
    private $providerKey;
    private $encoderFactory;
    private $userProvider;
    private $api;
    private $cache;
    private $secret;

    /**
     * Constructor.
     *
     * @param UserProviderInterface $userProvider An UserProviderInterface instance
     * @param string $providerKey The provider key
     * @param EncoderFactoryInterface $encoderFactory An EncoderFactoryInterface instance
     * @param bool $hideUserNotFoundExceptions Whether to hide user not found exception or not
     * @param TurnkeyLenderApi $api
     * @param CacheProvider $cache
     * @param string $secret
     */
    public function __construct(UserProviderInterface $userProvider, $providerKey, EncoderFactoryInterface $encoderFactory, $hideUserNotFoundExceptions = true, TurnkeyLenderApi $api, CacheProvider $cache, $secret)
    {
        if (empty($providerKey)) {
            throw new \InvalidArgumentException('$providerKey must not be empty.');
        }

        $this->providerKey = $providerKey;
        $this->hideUserNotFoundExceptions = $hideUserNotFoundExceptions;

        $this->encoderFactory = $encoderFactory;
        $this->userProvider = $userProvider;

        $this->api = $api;
        $this->cache = $cache;
        $this->secret = $secret;
    }

    /**
     * {@inheritdoc}
     */
    public function authenticate(TokenInterface $token)
    {
        if (!$this->supports($token)) {
            return;
        }

        $user = null;

        try {
            if ($response = $this->api->loginCustomer($token->getUser(), $token->getCredentials())) {
                if (empty($response) || empty($response['Success']) || empty($response['CustomerAuthToken'])) {
                    throw new BadCredentialsException('Bad credentials.', 0);
                }

                $user = new ApiUser($token->getUser(), $response['CustomerAuthToken']);
            }
        } catch (BadCredentialsException $e) {
            if ($this->hideUserNotFoundExceptions) {
                throw new BadCredentialsException('Bad credentials.', 0, $e);
            }

            throw $e;
        }

        $this->cache->save( md5($user->getUsername() . $this->secret),  $user );

        $authenticatedToken = new TurnkeyLenderApiToken($user, $token->getCredentials(), $this->providerKey, $response['CustomerAuthToken'], $user->getRoles());
        $authenticatedToken->setAttributes($token->getAttributes());

        return $authenticatedToken;
    }

    /**
     * {@inheritdoc}
     */
    public function supports(TokenInterface $token)
    {
        return $token instanceof UsernamePasswordToken && $this->providerKey === $token->getProviderKey();
    }
}