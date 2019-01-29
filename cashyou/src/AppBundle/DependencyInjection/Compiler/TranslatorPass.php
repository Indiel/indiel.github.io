<?php

namespace AppBundle\DependencyInjection\Compiler;

use AppBundle\Translation\Translator;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\DependencyInjection\Parameter;

class TranslatorPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        if (!$container->hasDefinition('translator.default')) {
            return;
        }

        $definition = $container->getDefinition('translator.default');
        $definition->setClass(Translator::class);

        $definition->addMethodCall('setEnvironment', array(new Parameter('kernel.environment')));
        $definition->addMethodCall('setRequestStack', array(new Reference('request_stack')));
    }
}