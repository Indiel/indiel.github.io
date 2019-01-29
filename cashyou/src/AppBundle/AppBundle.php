<?php

namespace AppBundle;

use AppBundle\DependencyInjection\Compiler\TranslatorPass;
use Symfony\Component\HttpKernel\Bundle\Bundle;
use AppBundle\DependencyInjection\Security\Factory\ApiLoginFactory;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class AppBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        $extension = $container->getExtension('security');
        $extension->addSecurityListenerFactory(new ApiLoginFactory());

        $container->addCompilerPass(new TranslatorPass());
    }
}
