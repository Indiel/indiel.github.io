<?php

namespace AppBundle\Helper;

use Symfony\Component\HttpFoundation\Session\SessionInterface;

class SmsSignStorage {
    const SESSION_KEY_CODE = 'smsSignCode';
    
    /**
     * @var SessionInterface
     */
    protected $session;
    
    public function __construct(SessionInterface $session)
    {
        $this->session = $session;
    }

	/**
	 * @param string $code
	 * @param string $documentId
	 */
    public function setVerificationCode($code, $documentId)
    {
        $this->session->set(self::SESSION_KEY_CODE . '_' . $documentId, $code);
    }

	/**
	 * @param string $code
	 * @param string $documentId
	 *
	 * @return bool
	 */
    public function verifyCode($code, $documentId)
    {
        $savedCode = $this->session->get(self::SESSION_KEY_CODE . '_' . $documentId);

        return !empty($savedCode) && ($savedCode == $code);
    }
}