<?php

namespace AppBundle\Entity;

use JMS\Serializer\Annotation as Serializer;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="loan_agreement_documents")
 */
class LoanAgreementDocument
{
    /**
     * @var int
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var Loan|null
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Loan", inversedBy="documentsToSign")
     * @ORM\JoinColumn(name="loan_id", referencedColumnName="id", onDelete="CASCADE")
     */
    protected $loan;

    /**
     * @var string
     * @Serializer\Type("string")
     * @Serializer\SerializedName("DocTypeId")
     * @ORM\Column(type="string", length=1000, nullable=true)
     */
    protected $docTypeId;

    /**
     * @var string
     * @Serializer\Type("string")
     * @Serializer\SerializedName("DocTypeTitle")
     * @ORM\Column(type="string", length=1000, nullable=true)
     */
    protected $docTypeTitle;

    /**
     * @var string
     * @Serializer\Type("string")
     * @Serializer\SerializedName("SignatureId")
     * @ORM\Column(type="string", length=1000, nullable=true)
     */
    protected $signatureId;

	/**
	 * @return int
	 */
	public function getId() {
		return $this->id;
	}

	/**
	 * @return Loan|null
	 */
	public function getLoan() {
		return $this->loan;
	}

	/**
	 * @param Loan|null $loan
	 */
	public function setLoan( $loan ) {
		$this->loan = $loan;
	}

    /**
     * @return string
     */
    public function getDocTypeId()
    {
        return $this->docTypeId;
    }

    /**
     * @param string $docTypeId
     */
    public function setDocTypeId($docTypeId)
    {
        $this->docTypeId = $docTypeId;
    }

    /**
     * @return string
     */
    public function getDocTypeTitle()
    {
        return $this->docTypeTitle;
    }

    /**
     * @param string $docTypeTitle
     */
    public function setDocTypeTitle($docTypeTitle)
    {
        $this->docTypeTitle = $docTypeTitle;
    }

    /**
     * @return string
     */
    public function getSignatureId()
    {
        return $this->signatureId;
    }

    /**
     * @param string $signatureId
     */
    public function setSignatureId($signatureId)
    {
        $this->signatureId = $signatureId;
    }
}