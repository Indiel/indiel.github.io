<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Embeddable
 */
class RolloverUser {
	/**
	 * @var string
	 * @ORM\Column(type="string", length=255)
	 */
	private $login;

	/**
	 * @var string
	 * @ORM\Column(type="string", length=255, nullable=true)
	 */
	private $firstName;

	/**
	 * @var string
	 * @ORM\Column(type="string", length=255, nullable=true)
	 */
	private $lastName;

	/**
	 * @var string
	 * @ORM\Column(type="string", length=255, nullable=true)
	 */
	private $middleName;

	/**
	 * @var Gender
	 * @ORM\Column(type="gender", nullable=true)
	 */
	private $gender;

	/**
	 * @var \DateTime
	 * @ORM\Column(type="datetimetz", nullable=true)
	 */
	private $birthDate;

	/**
	 * @var string
	 * @ORM\Column(type="string", length=32, nullable=true)
	 */
	private $phone;

	/**
	 * @var string
	 * @ORM\Column(type="string", length=32, nullable=true)
	 */
	private $workPhone;

	/**
	 * @var string
	 * @ORM\Column(type="string", length=255)
	 */
	private $email;

	/**
	 * @var MaritalStatus
	 * @ORM\Column(type="marital_status", nullable=true)
	 */
	private $maritalStatus;

	/**
	 * @var NumberOfDependents
	 * @ORM\Column(type="number_of_dependents", nullable=true)
	 */
	private $numberOfDependents;

	/**
	 * @var Education
	 * @ORM\Column(type="education", nullable=true)
	 */
	private $education;

	/**
	 * @var YesNo
	 * @ORM\Column(type="yesno", nullable=true)
	 */
	private $citizenship;

	/**
	 * @var YesNo
	 * @ORM\Column(type="yesno", nullable=true)
	 */
	private $isPassportNewType;

	/**
	 * @var string
	 * @ORM\Column(type="string", length=10, nullable=true)
	 */
	private $passport;

	/**
	 * @var \DateTime
	 * @ORM\Column(type="datetimetz", nullable=true)
	 */
	private $passportRegistration;

	/**
	 * @var string
	 * @ORM\Column(type="string", length=1000, nullable=true)
	 */
	private $passportIssuedBy;

	/**
	 * @var \DateTime
	 * @ORM\Column(type="datetimetz", nullable=true)
	 */
	private $passportValidDate;

	/**
	 * @var string
	 * @ORM\Column(type="string", length=15, nullable=true)
	 */
	private $passportRecordNumber;

	/**
	 * @var string
	 * @ORM\Column(type="string", length=10, nullable=true)
	 */
	private $socialSecurityNumber;

	/**
	 * @var RealEstate
	 * @ORM\Column(type="real_estate", nullable=true)
	 */
	private $realEstate;

	/**
	 * @var IncomeType
	 * @ORM\Column(type="income_type", nullable=true)
	 */
	private $incomeType;

	/**
	 * @var MonthlyIncome
	 * @ORM\Column(type="monthly_income", nullable=true)
	 */
	private $monthlyIncome;

	/**
	 * @var string
	 * @ORM\Column(type="string", length=255, nullable=true)
	 */
	private $companyName;

	/**
	 * @var Position
	 * @ORM\Column(type="position", nullable=true)
	 */
	private $position;

	/**
	 * @var BusinessType
	 * @ORM\Column(type="business_type", nullable=true)
	 */
	private $businessType;

	/**
	 * @var WorkingExperience
	 * @ORM\Column(type="working_experience", nullable=true)
	 */
	private $lastExperience;

	/**
	 * @var WorkingExperience
	 * @ORM\Column(type="working_experience", nullable=true)
	 */
	private $totalExperience;

	/**
	 * @var YesNo
	 * @ORM\Column(type="yesno", nullable=true)
	 */
	private $carOwner;

	/**
	 * @var YesNo
	 * @ORM\Column(type="yesno", nullable=true)
	 */
	private $realEstateOwner;

	/**
	 * @var Address
	 */
	private $address;

	/**
	 * @var Address
	 */
	private $secondAddress;

	public function __construct(User $user) {
		$this->login = $user->getLogin();
		$this->firstName = $user->getFirstName();
		$this->lastName = $user->getLastName();
		$this->middleName = $user->getMiddleName();
		$this->gender = $user->getGender();
		$this->birthDate = $user->getBirthDate();
		$this->phone = $user->getPhone();
		$this->workPhone = $user->getWorkPhone();
		$this->email = $user->getEmail();
		$this->maritalStatus = $user->getMaritalStatus();
		$this->numberOfDependents = $user->getNumberOfDependents();
		$this->education = $user->getEducation();
		$this->citizenship = $user->getCitizenship();
		$this->isPassportNewType = $user->getIsPassportNewType();
		$this->passport = $user->getPassport();
		$this->passportRegistration = $user->getPassportRegistration();
		$this->passportIssuedBy = $user->getPassportIssuedBy();
		$this->passportValidDate = $user->getPassportValidDate();
		$this->passportRecordNumber = $user->getPassportRecordNumber();
		$this->socialSecurityNumber = $user->getSocialSecurityNumber();
		$this->realEstate = $user->getRealEstate();
		$this->incomeType = $user->getIncomeType();
		$this->monthlyIncome = $user->getMonthlyIncome();
		$this->companyName = $user->getCompanyName();
		$this->position = $user->getPosition();
		$this->businessType = $user->getBusinessType();
		$this->lastExperience = $user->getLastExperience();
		$this->totalExperience = $user->getTotalExperience();
		$this->carOwner = $user->getCarOwner();
		$this->realEstateOwner = $user->getRealEstateOwner();
		$this->address = $user->getAddress();
		$this->secondAddress = $user->getSecondAddress();
	}

	/**
	 * @return string
	 */
	public function getLogin() {
		return $this->login;
	}

	/**
	 * @return string
	 */
	public function getFirstName() {
		return $this->firstName;
	}

	/**
	 * @return string
	 */
	public function getLastName() {
		return $this->lastName;
	}

	/**
	 * @return string
	 */
	public function getMiddleName() {
		return $this->middleName;
	}

	public function getFullName() {
		return $this->lastName . ' ' . $this->firstName . ' ' . $this->middleName;
	}

	public function getShortName()
	{
		return $this->lastName . ' ' . mb_strtoupper(mb_substr($this->firstName, 0, 1, 'UTF-8'), 'UTF-8') . '. ' . mb_strtoupper(mb_substr($this->middleName, 0, 1, 'UTF-8'), 'UTF-8') . '.';
	}

	/**
	 * @return Gender
	 */
	public function getGender() {
		return $this->gender;
	}

	/**
	 * @return \DateTime
	 */
	public function getBirthDate() {
		return $this->birthDate;
	}

	/**
	 * @return string
	 */
	public function getPhone() {
		return $this->phone;
	}

	/**
	 * @return string
	 */
	public function getWorkPhone() {
		return $this->workPhone;
	}

	/**
	 * @return string
	 */
	public function getEmail() {
		return $this->email;
	}

	/**
	 * @return MaritalStatus
	 */
	public function getMaritalStatus() {
		return $this->maritalStatus;
	}

	/**
	 * @return NumberOfDependents
	 */
	public function getNumberOfDependents() {
		return $this->numberOfDependents;
	}

	/**
	 * @return Education
	 */
	public function getEducation() {
		return $this->education;
	}

	/**
	 * @return YesNo
	 */
	public function getCitizenship() {
		return $this->citizenship;
	}

	/**
	 * @return YesNo
	 */
	public function getisPassportNewType() {
		return $this->isPassportNewType;
	}

	/**
	 * @return string
	 */
	public function getPassport() {
		return $this->passport;
	}

	/**
	 * @return \DateTime
	 */
	public function getPassportRegistration() {
		return $this->passportRegistration;
	}

	/**
	 * @return string
	 */
	public function getPassportIssuedBy() {
		return $this->passportIssuedBy;
	}

	/**
	 * @return \DateTime
	 */
	public function getPassportValidDate() {
		return $this->passportValidDate;
	}

	/**
	 * @return string
	 */
	public function getPassportRecordNumber() {
		return $this->passportRecordNumber;
	}

	/**
	 * @return string
	 */
	public function getSocialSecurityNumber() {
		return $this->socialSecurityNumber;
	}

	/**
	 * @return RealEstate
	 */
	public function getRealEstate() {
		return $this->realEstate;
	}

	/**
	 * @return IncomeType
	 */
	public function getIncomeType() {
		return $this->incomeType;
	}

	/**
	 * @return MonthlyIncome
	 */
	public function getMonthlyIncome() {
		return $this->monthlyIncome;
	}

	/**
	 * @return string
	 */
	public function getCompanyName() {
		return $this->companyName;
	}

	/**
	 * @return Position
	 */
	public function getPosition() {
		return $this->position;
	}

	/**
	 * @return BusinessType
	 */
	public function getBusinessType() {
		return $this->businessType;
	}

	/**
	 * @return WorkingExperience
	 */
	public function getLastExperience() {
		return $this->lastExperience;
	}

	/**
	 * @return WorkingExperience
	 */
	public function getTotalExperience() {
		return $this->totalExperience;
	}

	/**
	 * @return YesNo
	 */
	public function getCarOwner() {
		return $this->carOwner;
	}

	/**
	 * @return YesNo
	 */
	public function getRealEstateOwner() {
		return $this->realEstateOwner;
	}

	/**
	 * @return Address
	 */
	public function getAddress() {
		return $this->address;
	}

	/**
	 * @param Address $address
	 */
	public function setAddress( $address ) {
		$this->address = $address;
	}

	/**
	 * @return Address
	 */
	public function getSecondAddress() {
		return $this->secondAddress;
	}

	/**
	 * @param Address $secondAddress
	 */
	public function setSecondAddress( $secondAddress ) {
		$this->secondAddress = $secondAddress;
	}
}