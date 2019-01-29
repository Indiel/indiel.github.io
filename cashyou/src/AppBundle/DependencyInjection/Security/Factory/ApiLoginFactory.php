<?php
namespace AppBundle\DependencyInjection\Security\Factory;

use Symfony\Bundle\SecurityBundle\DependencyInjection\Security\Factory\FormLoginFactory;
use Symfony\Component\DependencyInjection\ChildDefinition;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

class ApiLoginFactory extends FormLoginFactory
{
    public function getKey()
    {
        return 'api-login';
    }

    protected function createAuthProvider(ContainerBuilder $container, $id, $config, $userProviderId)
    {
        $provider = 'app.security.authentication.provider.api.'.$id;
        $container
            ->setDefinition($provider, new ChildDefinition('app.security.authentication.provider.api'))
            ->replaceArgument(0, new Reference($userProviderId))
            ->replaceArgument(1, $id)
        ;

        return $provider;
    }
}
