<?php

namespace AppBundle\Helper;

use AVATOR\TurbosmsBundle\Service\Turbosms as Base;
use Doctrine\ORM\EntityManager;
use SoapClient;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Translation\TranslatorInterface;

class Turbosms extends Base
{
    /**
     * @inheritdoc
     */
    public function __construct(EntityManager $em, TranslatorInterface $translator, ContainerInterface $container)
    {
        $this->em = $em;
        $this->translator = $translator;
        $this->container = $container;
        $this->debug = $this->container->getParameter("avator_turbosms.debug");
        $this->repository = $em->getRepository("AVATOR\TurbosmsBundle\Entity\TurboSmsSent");
    }
    
    /**
     * Connect to Turbosms by Soap
     *
     * @return SoapClient
     * @throws \Exception
     */
    protected function connect()
    {
        if ($this->client) {
            return $this->client;
        }


        $login = $this->container->getParameter("avator_turbosms.login");
        $password = $this->container->getParameter("avator_turbosms.password");

        $client = new SoapClient($this->wsdl);
        if (!$login || !$password) {
            throw new \Exception($this->trans('Введите имя пользователя и пароль от Turbosms.'));
        }

        $result = $client->Auth([
            'login' => $login,
            'password' => $password,
        ]);

        if ($result->AuthResult . '' != 'Вы успешно авторизировались') {
            throw new \Exception($this->trans(/** @Ignore */$result->AuthResult . ''));
        }

        $this->client = $client;

        return $this->client;
    }
}