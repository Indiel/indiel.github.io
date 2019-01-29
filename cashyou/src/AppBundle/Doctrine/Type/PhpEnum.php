<?php

namespace AppBundle\Doctrine\Type;


use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\Type;

abstract class PhpEnum extends Type
{
    protected $name;
    protected $phpType;
    protected $sqlType = 'integer';

    public function getSQLDeclaration(array $fieldDeclaration, AbstractPlatform $platform)
    {
        if ($this->sqlType == 'integer') {
            return $platform->getIntegerTypeDeclarationSQL($fieldDeclaration);
        }

        if ($this->sqlType == 'string') {
            return $platform->getVarcharTypeDeclarationSQL($fieldDeclaration);
        }

        throw new \InvalidArgumentException('Wrong sqlType. Only integer and string supported.');
    }

    public function getName()
    {
        if (!$this->name) {
            throw new \InvalidArgumentException('Type name is not specified.');
        }

        return $this->name;
    }

    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        return !is_null($value) ? $value->getValue() : null;
    }

    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        $class = $this->phpType;

        return !is_null($value) ? new $class($this->sqlType == 'integer' ? intval($value) : $value) : null;
    }
}