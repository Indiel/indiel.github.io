<?php

namespace AppBundle\Entity;

trait EnumSerializeDeserialize {
    public function __call($name, $arguments)
    {
        $matches = null;
        if (preg_match('|^getEnum(.+)$|' ,$name, $matches)) {
            if (property_exists($this, lcfirst($matches[1]))) {
                if ($this->{lcfirst($matches[1])} instanceof Enum) {
                    return $this->{lcfirst($matches[1])}->getValue();
                }
                
                return $this->{lcfirst($matches[1])};
            }
        } elseif (preg_match('|^setEnum(.+)$|' ,$name, $matches)) {
            $parts = explode('_', lcfirst($matches[1]));
            if (property_exists($this, $parts[0])) {
                $class = "AppBundle\\Entity\\".$parts[1];
                $this->{$parts[0]} = empty($arguments[0]) ? null : new $class($arguments[0]);

                return null;
            }
        }

        throw new \BadMethodCallException();
    }
}