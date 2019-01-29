<?php

namespace AppBundle\Entity;

use JMS\Serializer\Annotation as Serializer;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Embeddable
 */
class Address implements ApiExportableInterface
{
    use ApiExportable;
    use EnumSerializeDeserialize;

    /**
     * @var string
     * @ORM\Column(type="string", length=1000, nullable=true)
     * @Serializer\Type("string")
     * @Serializer\SerializedName("Street")
     */
    private $street;

    /**
     * @var string
     * @ORM\Column(type="string", length=1000, nullable=true)
     * @Serializer\Type("string")
     * @Serializer\SerializedName("State")
     */
    private $state;

    /**
     * @var TypeOfSettlement
     * @ORM\Column(type="type_of_settlement", nullable=true)
     * @Serializer\Type("int")
     * @Serializer\SerializedName("TypeOfSettlement")
     * @Serializer\Accessor(getter="getEnumTypeOfSettlement", setter="setEnumTypeOfSettlement_TypeOfSettlement")
     */
    private $typeOfSettlement;

    /**
     * @var string
     * @ORM\Column(type="string", length=1000, nullable=true)
     * @Serializer\Type("string")
     * @Serializer\SerializedName("City")
     */
    private $city;

    /**
     * @var string
     * @ORM\Column(type="string", length=100, nullable=true)
     * @Serializer\Type("string")
     * @Serializer\SerializedName("House")
     */
    private $house;

    /**
     * @var string
     * @ORM\Column(type="string", length=100, nullable=true)
     * @Serializer\Type("string")
     * @Serializer\SerializedName("Building")
     */
    private $building;

    /**
     * @var string
     * @ORM\Column(type="string", length=100, nullable=true)
     * @Serializer\Type("string")
     * @Serializer\SerializedName("Apartment")
     */
    private $apartment;

    /**
     * @var string
     * @ORM\Column(type="string", length=100, nullable=true)
     * @Serializer\Type("string")
     * @Serializer\SerializedName("ZipCode")
     */
    private $zipCode;

    /**
     * @var RealEstate
     * @ORM\Column(type="real_estate", nullable=true)
     * @Serializer\Type("int")
     * @Serializer\SerializedName("RealEstate")
     * @Serializer\Accessor(getter="getEnumRealEstate", setter="setEnumRealEstate_RealEstate")
     */
    private $realEstate;

    /**
     * @var YesNo
     * @ORM\Column(type="yesno", nullable=true)
     * @Serializer\Type("int")
     * @Serializer\SerializedName("ResidentialMatchesRegistration")
     * @Serializer\Accessor(getter="getEnumResidentialMatchesRegistration", setter="setEnumResidentialMatchesRegistration_YesNo")
     */
    private $residentialMatchesRegistration;

    /**
     * @return string
     */
    public function getStreet()
    {
        return $this->street;
    }

    /**
     * @param string $street
     */
    public function setStreet($street)
    {
        $this->street = $street;
    }

    /**
     * @return string
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * @param string $state
     */
    public function setState($state)
    {
        $this->state = $state;
    }

    /**
     * @return TypeOfSettlement
     */
    public function getTypeOfSettlement()
    {
        return $this->typeOfSettlement;
    }

    /**
     * @param TypeOfSettlement $typeOfSettlement
     */
    public function setTypeOfSettlement(TypeOfSettlement $typeOfSettlement = null)
    {
        $this->typeOfSettlement = $typeOfSettlement;
    }

    /**
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @param string $city
     */
    public function setCity($city)
    {
        $this->city = $city;
    }

    /**
     * @return string
     */
    public function getHouse()
    {
        return $this->house;
    }

    /**
     * @param string $house
     */
    public function setHouse($house)
    {
        $this->house = $house;
    }

    /**
     * @return string
     */
    public function getBuilding()
    {
        return $this->building;
    }

    /**
     * @param string $building
     */
    public function setBuilding($building)
    {
        $this->building = $building;
    }

    /**
     * @return string
     */
    public function getApartment()
    {
        return $this->apartment;
    }

    /**
     * @param string $apartment
     */
    public function setApartment($apartment)
    {
        $this->apartment = $apartment;
    }

    /**
     * @return string
     */
    public function getZipCode()
    {
        return $this->zipCode;
    }

    /**
     * @param string $zipCode
     */
    public function setZipCode($zipCode)
    {
        $this->zipCode = $zipCode;
    }

    /**
     * @return RealEstate
     */
    public function getRealEstate()
    {
        return $this->realEstate;
    }

    /**
     * @param RealEstate $realEstate
     */
    public function setRealEstate(RealEstate $realEstate = null)
    {
        $this->realEstate = $realEstate;
    }

    /**
     * @return YesNo
     */
    public function isResidentialMatchesRegistration()
    {
        return $this->residentialMatchesRegistration;
    }

    /**
     * @param YesNo $residentialMatchesRegistration
     */
    public function setResidentialMatchesRegistration(YesNo $residentialMatchesRegistration = null)
    {
        $this->residentialMatchesRegistration = $residentialMatchesRegistration;
    }
}