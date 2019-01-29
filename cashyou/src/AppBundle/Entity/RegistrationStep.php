<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * RegistrationStep
 *
 * @ORM\Table(name="registration_steps")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\RegistrationStepRepository")
 */
class RegistrationStep
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=100)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="alias", type="string", length=100)
     */
    private $alias;

    /**
     * @var int
     *
     * @ORM\Column(name="prev_id", type="integer", nullable=true)
     */
    private $prevId;

    /**
     * @var int
     *
     * @ORM\Column(name="step_number", type="integer", nullable=false)
     */
    private $stepNumber;

    /**
     * @var int
     *
     * @ORM\Column(name="bonus", type="integer", nullable=true)
     */
    private $bonus;

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return RegistrationStep
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set alias
     *
     * @param string $alias
     *
     * @return RegistrationStep
     */
    public function setAlias($alias)
    {
        $this->alias = $alias;

        return $this;
    }

    /**
     * Get alias
     *
     * @return string
     */
    public function getAlias()
    {
        return $this->alias;
    }

    /**
     * Set prevId
     *
     * @param integer $prevId
     *
     * @return RegistrationStep
     */
    public function setPrevId($prevId)
    {
        $this->prevId = $prevId;

        return $this;
    }

    /**
     * Get prevId
     *
     * @return int
     */
    public function getPrevId()
    {
        return $this->prevId;
    }

    /**
     * Get number
     *
     * @return int
     */
    public function getNumber()
    {
        return $this->stepNumber;
    }

    /**
     * Get number
     *
     * @return int
     */
    public function getBonus()
    {
        return $this->bonus;
    }
}

