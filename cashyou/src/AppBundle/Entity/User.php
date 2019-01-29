<?php
namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use JMS\Serializer\Annotation as Serializer;
use AppBundle\Validator\Constraints\PhoneVerify;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="users")
 */
class User implements ApiExportableInterface
{
    use ApiExportable;
    use EnumSerializeDeserialize;

    /**
     * @var int
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(type="string", length=255, unique=true, nullable=true)
     */
    private $login;

	/**
	 * @var string
	 * @ORM\Column(type="string", length=255, unique=true, nullable=true)
	 */
	private $apiToken;

	/**
     * @var string
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Serializer\Type("string")
     * @Serializer\SerializedName("FirstName")
     */
    private $firstName;

    /**
     * @var string
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Serializer\Type("string")
     * @Serializer\SerializedName("LastName")
     */
    private $lastName;

    /**
     * @var string
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Serializer\Type("string")
     * @Serializer\SerializedName("MiddleName")
     */
    private $middleName;

    /**
     * @var Gender
     * @ORM\Column(type="gender", nullable=true)
     * @Serializer\Type("int")
     * @Serializer\SerializedName("Gender")
     * @Serializer\Accessor(getter="getEnumGender", setter="setEnumGender_Gender")
     */
    private $gender;

    /**
     * @var \DateTime
     * @ORM\Column(type="datetimetz", nullable=true)
     * @Serializer\Type("DateTime<'Y-m-d\TH:i:s.uT'>")
     * @Serializer\SerializedName("BirthDate")
     */
    private $birthDate;

    /**
     * @var string
     * @ORM\Column(type="string", length=32, nullable=true)
     * @Serializer\Type("string")
     * @Serializer\SerializedName("Phone")
     * @PhoneVerify(groups={"Registration"})
     */
    private $phone;

    /**
     * @var string
     * @ORM\Column(type="string", length=32, nullable=true)
     * @Serializer\Type("string")
     * @Serializer\SerializedName("WorkPhone")
     */
    private $workPhone;

    /**
     * @var string
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank()
     * @Assert\Email()
     * @Serializer\Type("string")
     * @Serializer\SerializedName("Email")
     */
    private $email;

    /**
     * @var SecretQuestion
     * @ORM\Column(type="secret_question", nullable=true)
     * @Serializer\Type("int")
     * @Serializer\SerializedName("SecretQuestion")
     * @Serializer\Accessor(getter="getEnumSecretQuestion", setter="setEnumSecretQuestion_SecretQuestion")
     */
    private $secretQuestion;

    /**
     * @var string
     * @ORM\Column(type="string", length=1000, nullable=true)
     * @Serializer\Type("string")
     * @Serializer\SerializedName("SecretAnswer")
     */
    private $secretAnswer;

    /**
     * @var string
     * @Assert\NotBlank(groups={"Registration"})
     * @Assert\Length(min="6")
     */
    private $password;

    /**
     * @var MaritalStatus
     * @ORM\Column(type="marital_status", nullable=true)
     * @Serializer\Type("int")
     * @Serializer\SerializedName("MaritalStatus")
     * @Serializer\Accessor(getter="getEnumMaritalStatus", setter="setEnumMaritalStatus_MaritalStatus")
     */
    private $maritalStatus;

    /**
     * @var NumberOfDependents
     * @ORM\Column(type="number_of_dependents", nullable=true)
     * @Serializer\Type("int")
     * @Serializer\SerializedName("NumberOfDependents")
     * @Serializer\Accessor(getter="getEnumNumberOfDependents", setter="setEnumNumberOfDependents_NumberOfDependents")
     */
    private $numberOfDependents;

    /**
     * @var Education
     * @ORM\Column(type="education", nullable=true)
     * @Serializer\Type("int")
     * @Serializer\SerializedName("Education")
     * @Serializer\Accessor(getter="getEnumEducation", setter="setEnumEducation_Education")
     */
    private $education;

    /**
     * @var YesNo
     * @ORM\Column(type="yesno", nullable=true)
     * @Serializer\Type("int")
     * @Serializer\SerializedName("Citizenship")
     * @Serializer\Accessor(getter="getEnumCitizenship", setter="setEnumCitizenship_YesNo")
     */
    private $citizenship;

    /**
     * @var YesNo
     * @ORM\Column(type="yesno", nullable=true)
     * @Serializer\Type("int")
     * @Serializer\SerializedName("IsPassportNewType")
     * @Serializer\Accessor(getter="getEnumIsPassportNewType", setter="setEnumIsPassportNewType_YesNo")
     */
    private $isPassportNewType;

    /**
     * @var string
     * @ORM\Column(type="string", length=10, nullable=true)
     * @Serializer\Type("string")
     * @Serializer\SerializedName("Passport")
     */
    private $passport;

    /**
     * @var \DateTime
     * @ORM\Column(type="datetimetz", nullable=true)
     * @Serializer\Type("DateTime<'Y-m-d\TH:i:s.uT'>")
     * @Serializer\SerializedName("PassportRegistration")
     */
    private $passportRegistration;

    /**
     * @var string
     * @ORM\Column(type="string", length=1000, nullable=true)
     * @Serializer\Type("string")
     * @Serializer\SerializedName("PassportIssuedBy")
     */
    private $passportIssuedBy;

    /**
     * @var \DateTime
     * @ORM\Column(type="datetimetz", nullable=true)
     * @Serializer\Type("DateTime")
     * @Serializer\SerializedName("PassportValidDate")
     */
    private $passportValidDate;

    /**
     * @var string
     * @ORM\Column(type="string", length=15, nullable=true)
     * @Serializer\Type("string")
     * @Serializer\SerializedName("PassportRecordNumber")
     */
    private $passportRecordNumber;

    /**
     * @var string
     * @ORM\Column(type="string", length=10, nullable=true)
     * @Serializer\Type("string")
     * @Serializer\SerializedName("SocialSecurityNumber")
     */
    private $socialSecurityNumber;

    /**
     * @var RealEstate
     * @ORM\Column(type="real_estate", nullable=true)
     * @Serializer\Type("int")
     * @Serializer\SerializedName("RealEstate")
     * @Serializer\Accessor(getter="getEnumRealEstate", setter="setEnumRealEstate_RealEstate")
     */
    private $realEstate;

    /**
     * @var Address
     * @ORM\Embedded(class="Address", columnPrefix="address_")
     * @Serializer\Type("AppBundle\Entity\Address")
     * @Serializer\SerializedName("Address")
     */
    private $address;

    /**
     * @var Address
     * @ORM\Embedded(class="Address", columnPrefix="second_address_")
     * @Serializer\Type("AppBundle\Entity\Address")
     * @Serializer\SerializedName("SecondAddress")
     */
    private $secondAddress;

    /**
     * @var IncomeType
     * @ORM\Column(type="income_type", nullable=true)
     * @Serializer\Type("int")
     * @Serializer\SerializedName("IncomeType")
     * @Serializer\Accessor(getter="getEnumIncomeType", setter="setEnumIncomeType_IncomeType")
     */
    private $incomeType;

    /**
     * @var MonthlyIncome
     * @ORM\Column(type="monthly_income", nullable=true)
     * @Serializer\Type("int")
     * @Serializer\SerializedName("MonthlyIncome")
     * @Serializer\Accessor(getter="getEnumMonthlyIncome", setter="setEnumMonthlyIncome_MonthlyIncome")
     */
    private $monthlyIncome;

    /**
     * @var string
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Serializer\Type("string")
     * @Serializer\SerializedName("CompanyName")
     */
    private $companyName;

    /**
     * @var Position
     * @ORM\Column(type="position", nullable=true)
     * @Serializer\Type("int")
     * @Serializer\SerializedName("Position")
     * @Serializer\Accessor(getter="getEnumPosition", setter="setEnumPosition_Position")
     */
    private $position;

    /**
     * @var BusinessType
     * @ORM\Column(type="business_type", nullable=true)
     * @Serializer\Type("int")
     * @Serializer\SerializedName("BusinessType")
     * @Serializer\Accessor(getter="getEnumBusinessType", setter="setEnumBusinessType_BusinessType")
     */
    private $businessType;

    /**
     * @var WorkingExperience
     * @ORM\Column(type="working_experience", nullable=true)
     * @Serializer\Type("int")
     * @Serializer\SerializedName("LastExperience")
     * @Serializer\Accessor(getter="getEnumLastExperience", setter="setEnumLastExperience_WorkingExperience")
     */
    private $lastExperience;

    /**
     * @var WorkingExperience
     * @ORM\Column(type="working_experience", nullable=true)
     * @Serializer\Type("int")
     * @Serializer\SerializedName("TotalExperience")
     * @Serializer\Accessor(getter="getEnumTotalExperience", setter="setEnumTotalExperience_WorkingExperience")
     */
    private $totalExperience;

    /**
     * @var YesNo
     * @ORM\Column(type="yesno", nullable=true)
     * @Serializer\Type("int")
     * @Serializer\SerializedName("CarOwner")
     * @Serializer\Accessor(getter="getEnumCarOwner", setter="setEnumCarOwner_YesNo")
     */
    private $carOwner;

    /**
     * @var YesNo
     * @ORM\Column(type="yesno", nullable=true)
     * @Serializer\Type("int")
     * @Serializer\SerializedName("RealEstateOwner")
     * @Serializer\Accessor(getter="getEnumRealEstateOwner", setter="setEnumRealEstateOwner_YesNo")
     */
    private $realEstateOwner;

    /**
     * @var array
     * @ORM\Column(type="json_array", nullable=true)
     * @Serializer\Type("array")
     * @Serializer\SerializedName("DocPassport1")
     */
    private $docPassport1;

    /**
     * @var array
     * @ORM\Column(type="json_array", nullable=true)
     * @Serializer\Type("array")
     * @Serializer\SerializedName("DocPassport2")
     */
    private $docPassport2;

    /**
     * @var array
     * @ORM\Column(type="json_array", nullable=true)
     * @Serializer\Type("array")
     * @Serializer\SerializedName("DocPassport3")
     */
    private $docPassport3;

    /**
     * @var array
     * @ORM\Column(type="json_array", nullable=true)
     * @Serializer\Type("array")
     * @Serializer\SerializedName("DocIpn")
     */
    private $docIpn;

    /**
     * @var array
     * @ORM\Column(type="json_array", nullable=true)
     * @Serializer\Type("array")
     * @Serializer\SerializedName("Docs")
     */
    private $docs;

    /**
     * @var ArrayCollection|Loan[]
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Loan", mappedBy="user", cascade={"all"}, orphanRemoval=true)
     */
    private $loans;

    /**
     * @var int
     * @ORM\Column(type="integer")     
     */
    private $current_step;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return ArrayCollection|Loan[]
     */
    public function getLoans()
    {
        return $this->loans;
    }

    /**
     * @return string
     */
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * @param string $login
     */
    public function setLogin($login)
    {
        $this->login = $login;
    }
    
    /**
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @param string $firstName
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    }

    /**
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @param string $lastName
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
    }

    /**
     * @return string
     */
    public function getMiddleName()
    {
        return $this->middleName;
    }

    /**
     * @param string $middleName
     */
    public function setMiddleName($middleName)
    {
        $this->middleName = $middleName;
    }

    /**
     * @return Gender
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * @param $gender
     */
    public function setGender($gender = null)
    {
        $this->gender = $gender instanceof Gender ? $gender : new Gender($gender);
    }

    /**
     * @return \DateTime
     */
    public function getBirthDate()
    {
        return $this->birthDate;
    }

    /**
     * @param \DateTime $birthDate
     */
    public function setBirthDate(\DateTime $birthDate = null)
    {
        $this->birthDate = $birthDate;
    }

    /**
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @param string $phone
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;
    }

    /**
     * @return string
     */
    public function getWorkPhone()
    {
        return $this->workPhone;
    }

    /**
     * @param string $workPhone
     */
    public function setWorkPhone($workPhone)
    {
        $this->workPhone = $workPhone;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return SecretQuestion
     */
    public function getSecretQuestion()
    {
        return $this->secretQuestion;
    }

    /**
     * @param SecretQuestion $secretQuestion
     */
    public function setSecretQuestion(SecretQuestion $secretQuestion = null)
    {
        $this->secretQuestion = $secretQuestion;
    }

    /**
     * @return string
     */
    public function getSecretAnswer()
    {
        return $this->secretAnswer;
    }

    /**
     * @param string $secretAnswer
     */
    public function setSecretAnswer($secretAnswer)
    {
        $this->secretAnswer = $secretAnswer;
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @return MaritalStatus
     */
    public function getMaritalStatus()
    {
        return $this->maritalStatus;
    }

    /**
     * @param MaritalStatus $maritalStatus
     */
    public function setMaritalStatus(MaritalStatus $maritalStatus = null)
    {
        $this->maritalStatus = $maritalStatus;
    }

    /**
     * @return NumberOfDependents
     */
    public function getNumberOfDependents()
    {
        return $this->numberOfDependents;
    }

    /**
     * @param NumberOfDependents $numberOfDependents
     */
    public function setNumberOfDependents(NumberOfDependents $numberOfDependents = null)
    {
        $this->numberOfDependents = $numberOfDependents;
    }

    /**
     * @return Education
     */
    public function getEducation()
    {
        return $this->education;
    }

    /**
     * @param Education $education
     */
    public function setEducation(Education $education = null)
    {
        $this->education = $education;
    }

    /**
     * @return YesNo
     */
    public function getCitizenship()
    {
        return $this->citizenship;
    }

    /**
     * @param YesNo $citizenship
     */
    public function setCitizenship(YesNo $citizenship = null)
    {
        $this->citizenship = $citizenship;
    }

    /**
     * @return YesNo
     */
    public function getIsPassportNewType()
    {
        return $this->isPassportNewType;
    }

    /**
     * @param YesNo $isPassportNewType
     */
    public function setIsPassportNewType(YesNo $isPassportNewType = null)
    {
        $this->isPassportNewType = $isPassportNewType;
    }

    /**
     * @return string
     */
    public function getPassport()
    {
        return ($this->isPassportNewType instanceof YesNo && $this->isPassportNewType->equals(new YesNo(YesNo::YES))) ? null : $this->passport;
    }

    /**
     * @param string $passport
     */
    public function setPassport($passport)
    {
        if (!($this->isPassportNewType instanceof YesNo) || !$this->isPassportNewType->equals(new YesNo(YesNo::YES))) {
            $this->passport = $passport;
        }
    }

    /**
     * @return string
     */
    public function getDocumentNumber()
    {
        return ($this->isPassportNewType instanceof YesNo && $this->isPassportNewType->equals(new YesNo(YesNo::YES))) ? $this->passport : null;
    }

    /**
     * @param string $passport
     */
    public function setDocumentNumber($passport)
    {
        if ($this->isPassportNewType instanceof YesNo && $this->isPassportNewType->equals(new YesNo(YesNo::YES))) {
            $this->passport = $passport;
        }
    }

    /**
     * @return \DateTime
     */
    public function getPassportRegistration()
    {
        return $this->passportRegistration;
    }

    /**
     * @param \DateTime $passportRegistration
     */
    public function setPassportRegistration(\DateTime $passportRegistration = null)
    {
        $this->passportRegistration = $passportRegistration;
    }

    /**
     * @return string
     */
    public function getPassportIssuedBy()
    {
        return ($this->isPassportNewType instanceof YesNo && $this->isPassportNewType->equals(new YesNo(YesNo::YES))) ? null : $this->passportIssuedBy;
    }

    /**
     * @param string $passportIssuedBy
     */
    public function setPassportIssuedBy($passportIssuedBy)
    {
        if (!($this->isPassportNewType instanceof YesNo) || !$this->isPassportNewType->equals(new YesNo(YesNo::YES))) {
            $this->passportIssuedBy = $passportIssuedBy;
        }
    }

    /**
     * @return string
     */
    public function getPassportIssuedByNumber()
    {
        return ($this->isPassportNewType instanceof YesNo && $this->isPassportNewType->equals(new YesNo(YesNo::YES))) ? $this->passportIssuedBy : null;
    }

    /**
     * @param string $passportIssuedBy
     */
    public function setPassportIssuedByNumber($passportIssuedBy)
    {
        if ($this->isPassportNewType instanceof YesNo && $this->isPassportNewType->equals(new YesNo(YesNo::YES))) {
            $this->passportIssuedBy = $passportIssuedBy;
        }
    }

    /**
     * @return \DateTime
     */
    public function getPassportValidDate()
    {
        return $this->passportValidDate;
    }

    /**
     * @param \DateTime $passportValidDate
     */
    public function setPassportValidDate(\DateTime $passportValidDate = null)
    {
        $this->passportValidDate = $passportValidDate;
    }

    /**
     * @return string
     */
    public function getPassportRecordNumber()
    {
        return $this->passportRecordNumber;
    }

    /**
     * @param string $passportRecordNumber
     */
    public function setPassportRecordNumber($passportRecordNumber)
    {
        $this->passportRecordNumber = $passportRecordNumber;
    }

    /**
     * @return string
     */
    public function getSocialSecurityNumber()
    {
        return $this->socialSecurityNumber;
    }

    /**
     * @param string $socialSecurityNumber
     */
    public function setSocialSecurityNumber($socialSecurityNumber)
    {
        $this->socialSecurityNumber = $socialSecurityNumber;
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
     * @return Address
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param Address $address
     */
    public function setAddress(Address $address = null)
    {
        $this->address = $address;
    }

    /**
     * @return Address
     */
    public function getSecondAddress()
    {
        return $this->secondAddress;
    }

    /**
     * @param Address $secondAddress
     */
    public function setSecondAddress(Address $secondAddress = null)
    {
        $this->secondAddress = $secondAddress;
    }

    /**
     * @return IncomeType
     */
    public function getIncomeType()
    {
        return $this->incomeType;
    }

    /**
     * @param IncomeType $incomeType
     */
    public function setIncomeType(IncomeType $incomeType = null)
    {
        $this->incomeType = $incomeType;
    }

    /**
     * @return MonthlyIncome
     */
    public function getMonthlyIncome()
    {
        return $this->monthlyIncome;
    }

    /**
     * @param MonthlyIncome $monthlyIncome
     */
    public function setMonthlyIncome(MonthlyIncome $monthlyIncome = null)
    {
        $this->monthlyIncome = $monthlyIncome;
    }

    /**
     * @return string
     */
    public function getCompanyName()
    {
        return $this->companyName;
    }

    /**
     * @param string $companyName
     */
    public function setCompanyName($companyName)
    {
        $this->companyName = $companyName;
    }

    /**
     * @return Position
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * @param Position $position
     */
    public function setPosition(Position $position = null)
    {
        $this->position = $position;
    }

    /**
     * @return BusinessType
     */
    public function getBusinessType()
    {
        return $this->businessType;
    }

    /**
     * @param BusinessType $businessType
     */
    public function setBusinessType(BusinessType $businessType = null)
    {
        $this->businessType = $businessType;
    }

    /**
     * @return WorkingExperience
     */
    public function getLastExperience()
    {
        return $this->lastExperience;
    }

    /**
     * @param WorkingExperience $lastExperience
     */
    public function setLastExperience(WorkingExperience $lastExperience = null)
    {
        $this->lastExperience = $lastExperience;
    }

    /**
     * @return WorkingExperience
     */
    public function getTotalExperience()
    {
        return $this->totalExperience;
    }

    /**
     * @param WorkingExperience $totalExperience
     */
    public function setTotalExperience(WorkingExperience $totalExperience = null)
    {
        $this->totalExperience = $totalExperience;
    }

    /**
     * @return YesNo
     */
    public function getCarOwner()
    {
        return $this->carOwner;
    }

    /**
     * @param YesNo $carOwner
     */
    public function setCarOwner(YesNo $carOwner = null)
    {
        $this->carOwner = $carOwner;
    }

    /**
     * @return YesNo
     */
    public function getRealEstateOwner()
    {
        return $this->realEstateOwner;
    }

    /**
     * @param YesNo $realEstateOwner
     */
    public function setRealEstateOwner(YesNo $realEstateOwner = null)
    {
        $this->realEstateOwner = $realEstateOwner;
    }

    /**
     * @return array
     */
    public function getDocPassport1()
    {
        return $this->docPassport1;
    }

    /**
     * @param array $docPassport1
     */
    public function setDocPassport1($docPassport1)
    {
        $this->docPassport1 = $docPassport1;
    }

    /**
     * @return string|false
     */
    public function getDocPassport1Json()
    {
        return $this->documentsToJson($this->docPassport1);
    }

    /**
     * @param string $json
     */
    public function setDocPassport1Json($json)
    {
        $this->docPassport1 = $this->documentsFromJson($json);
    }

    /**
     * @return array
     */
    public function getDocPassport2()
    {
        return $this->docPassport2;
    }

    /**
     * @param array $docPassport2
     */
    public function setDocPassport2($docPassport2)
    {
        $this->docPassport2 = $docPassport2;
    }

    /**
     * @return string|false
     */
    public function getDocPassport2Json()
    {
        return $this->documentsToJson($this->docPassport2);
    }

    /**
     * @param string $json
     */
    public function setDocPassport2Json($json)
    {
        $this->docPassport2 = $this->documentsFromJson($json);
    }

    /**
     * @return array
     */
    public function getDocPassport3()
    {
        return $this->docPassport3;
    }

    /**
     * @param array $docPassport3
     */
    public function setDocPassport3($docPassport3)
    {
        $this->docPassport3 = $docPassport3;
    }

    /**
     * @return string|false
     */
    public function getDocPassport3Json()
    {
        return $this->documentsToJson($this->docPassport3);
    }

    /**
     * @param string $json
     */
    public function setDocPassport3Json($json)
    {
        $this->docPassport3 = $this->documentsFromJson($json);
    }

    /**
     * @return array
     */
    public function getDocIpn()
    {
        return $this->docIpn;
    }

    /**
     * @param array $docIpn
     */
    public function setDocIpn($docIpn)
    {
        $this->docIpn = $docIpn;
    }

    /**
     * @return string|false
     */
    public function getDocIpnJson()
    {
        return $this->documentsToJson($this->docIpn);
    }

    /**
     * @param string $json
     */
    public function setDocIpnJson($json)
    {
        $this->docIpn = $this->documentsFromJson($json);
    }

    /**
     * @return array
     */
    public function getDocs()
    {
        return $this->docs;
    }

    /**
     * @param array $docs
     */
    public function setDocs($docs)
    {
        $this->docs = $docs;
    }

    /**
     * @param string $json
     */
    public function setDocsJson($json)
    {
        $this->docs = $this->documentsFromJson($json);
    }

    /**
     * @return string|false
     */
    public function getDocsJson()
    {
        return $this->documentsToJson($this->docs);
    }

    /**
     * @param string $json
     * @return array
     */
    protected function documentsFromJson($json)
    {
        return json_decode($json, true);
    }

    /**
     * @param array $documents
     * @return string
     */
    protected function documentsToJson($documents)
    {
        return json_encode($documents);
    }

	/**
	 * @return string
	 */
	public function getApiToken() {
		return $this->apiToken;
	}

	/**
	 * @param string $apiToken
	 */
	public function setApiToken( $apiToken ) {
		$this->apiToken = $apiToken;
	}
    
    public function hasBlankRequiredFields()
    {
        if (empty($this->address)){
            return true;
        }
        
        $requiredFields = [
            $this->firstName,
            $this->lastName,
            $this->middleName,
            $this->gender,
            $this->email,
            $this->secretQuestion,
            $this->secretAnswer,
            $this->maritalStatus,
            $this->numberOfDependents,
            $this->education,
            $this->citizenship,
            $this->passport,
            $this->passportIssuedBy,
            $this->passportRegistration,
            $this->socialSecurityNumber,
            $this->address->getStreet(),
            $this->address->getState(),
            $this->address->getTypeOfSettlement(),
            $this->address->getCity(),
            $this->address->getHouse(),
            $this->address->getZipCode(),
            $this->address->getRealEstate(),
            $this->address->isResidentialMatchesRegistration(),
            $this->incomeType,
            $this->monthlyIncome,
            $this->lastExperience,
            $this->totalExperience,
            $this->carOwner,
            $this->realEstateOwner,
        ];
        
        if ($this->isPassportNewType && $this->isPassportNewType->equals(new YesNo(YesNO::YES))) {
            $requiredFields[] = $this->passportValidDate;
            $requiredFields[] = $this->passportRecordNumber;
        }

        if ($this->incomeType->getValue() != IncomeType::UNEMPLOYED) {
            $requiredFields[] = $this->businessType;
            $requiredFields[] = $this->companyName;
            $requiredFields[] = $this->position;
            $requiredFields[] = $this->workPhone;
        }

        $blankFields = array_filter($requiredFields, function($value) {
            return empty($value);
        });
        
        return count($blankFields) ? true : false;
    }

    /**
     * @return int
     */
    public function getCurrentStep()
    {
        return $this->current_step;
    }

    public function setCurrentStep($current_step)
    {
        $this->current_step = $current_step;
    }
}