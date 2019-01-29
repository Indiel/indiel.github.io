<?php

namespace AppBundle\Translation;

use Symfony\Bundle\FrameworkBundle\Translation\Translator as BaseTranslator;
use Symfony\Component\HttpFoundation\RequestStack;

class Translator extends BaseTranslator
{
    /**
     * @var string
     */
    protected $environment;

    /**
     * @var RequestStack
     */
    protected $requestStack;
    
    public function trans($id, array $parameters = array(), $domain = null, $locale = null)
    {
        $check_translation = $this->requestStack->getMasterRequest()->query->has('check_translation');
        if ($this->environment == 'dev' && $check_translation) {
            return '';
        }
        
        return parent::trans($id, $parameters, $domain, $locale);
    }
    
    public function transChoice($id, $number, array $parameters = array(), $domain = null, $locale = null)
    {
        $check_translation = $this->requestStack->getMasterRequest()->query->has('check_translation');
        if ($this->environment == 'dev' && $check_translation) {
            return '';
        }
        
        return parent::transChoice($id, $number, $parameters, $domain, $locale);
    }

    /**
     * @return string
     */
    public function getEnvironment()
    {
        return $this->environment;
    }

    /**
     * @param string $environment
     */
    public function setEnvironment($environment)
    {
        $this->environment = $environment;
    }

    /**
     * @return RequestStack
     */
    public function getRequestStack()
    {
        return $this->requestStack;
    }

    /**
     * @param RequestStack $requestStack
     */
    public function setRequestStack($requestStack)
    {
        $this->requestStack = $requestStack;
    }
}