<?php
namespace AppBundle\Twig;

use AppBundle\Helper\TurnkeyLenderApi;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Twig_Environment;

class AppExtension extends \Twig_Extension implements \Twig_Extension_GlobalsInterface
{
    private $authenticationUtils;
    private $api;
    private $requestStack;

    public function __construct(AuthenticationUtils $authenticationUtils, TurnkeyLenderApi $api, RequestStack $requestStack)
    {
        $this->authenticationUtils = $authenticationUtils;
        $this->api = $api;
        $this->requestStack = $requestStack;
    }

    public function getGlobals()
    {
        return [
            'TKLenderApi' => [
                'defaultProduct' => $this->api->getDefaultProduct(),
                'normalProduct' => $this->api->getCreditProductByName($this->api->getNormalProductName()),
            ],
            'initialSpecialProduct' => $this->api->getInitialSpecialProductName(),
            'loginLastUsername' => $this->authenticationUtils->getLastUsername(),
            'loginError' => $this->authenticationUtils->getLastAuthenticationError(),
        ];
    }

    public function getFunctions()
    {
        return array(
            new \Twig_SimpleFunction('if_route', array($this, 'ifRoute')),
            new \Twig_SimpleFunction('is_route', array($this, 'isRoute')),
            new \Twig_SimpleFunction('slider_values', array($this, 'sliderValues')),
            new \Twig_SimpleFunction('slider_max', array($this, 'sliderMax')),
        );
    }
    
    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('class_by_comparison', array($this, 'classByComparison')),
            new \Twig_SimpleFilter('format_float', array($this, 'format_float'), array('needs_environment' => true)),
        );
    }
    
    public function sliderValues($min, $max)
    {
        $minInt = intval($min);
        $maxInt = intval($max);
        
        $values = range($minInt, $maxInt, 1);
        if ($maxInt < $max) {
            array_push($values, $max);
        }
        
        return $values;
    }

    public function sliderMax($min, $max)
    {
        $minInt = intval($min);
        $maxInt = intval($max);
        
        $values = range($minInt, $maxInt, 1);
        if ($maxInt < $max) {
            array_push($values, $max);
        }
        
        return count($values);
    }

    
    public function ifRoute($route, $text, $default = null)
    {
        return $this->isRoute($route) ? $text : $default;
    }

    public function isRoute($route)
    {
        if ($request = $this->requestStack->getCurrentRequest()) {
            return is_array($route) ? in_array($request->get('_route'), $route) : ($request->get('_route') == $route);
        }

        return false;
    }
    
    public function classByComparison($value1, $value2, $less, $equal, $next, $greater)
    {
        if ($value1 == $value2) {
            return $equal;
        } elseif (($value1 + 1) == $value2) {
            return $next;
        } elseif ($value2 < $value1) {
            return $less;
        } 
        
        return $greater;
    }
    
    public function format_float(Twig_Environment $env, $value, $decimals=2, $decimalPoint=',', $thousandSep = '') {
        return rtrim(rtrim(twig_number_format_filter($env, $value, $decimals, $decimalPoint, $thousandSep), '0'), $decimalPoint);
    }
}