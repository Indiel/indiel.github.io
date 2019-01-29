<?php

namespace AppBundle\Helper;

use Symfony\Component\HttpFoundation\Session\SessionInterface;

class PhoneVerifyStorage {
    const SESSION_KEY_PHONES = 'verifiedPhones';
    const SESSION_KEY_CODE = 'verifyCode';
    
    /**
     * @var SessionInterface
     */
    protected $session;
    
    public function __construct(SessionInterface $session)
    {
        $this->session = $session;
    }
    
    /**
     * @param string $phone
     * @return bool
     */
    public function isVerified($phone)
    {
        $phones = $this->session->get(self::SESSION_KEY_PHONES, []);

        $phone = preg_replace('|[^\+0-9]|', '', $phone);
        
        return in_array($phone, $phones);
    }

    /**
     * @param string $phone
     * @param string $code
     */
    public function setVerificationCode($phone, $code)
    {
        $this->session->set(self::SESSION_KEY_CODE, [
            'phone' => $phone,
            'code' => $code,
        ]);
    }

    /**
     * @param string $code
     * @return bool
     */
    public function verifyCode($code)
    {
        $savedCode = $this->session->get(self::SESSION_KEY_CODE);
        if (!empty($savedCode) && $savedCode['code'] == $code) {
            $phones = $this->session->get(self::SESSION_KEY_PHONES, []);
            if (!in_array($savedCode['phone'], $phones)) {
                array_push($phones, $savedCode['phone']);
                $this->session->set(self::SESSION_KEY_PHONES, $phones);
                $this->session->remove(self::SESSION_KEY_CODE);
            }
            
            return true;
        }
        
        return false;
    }
    
    public function getVerifiedPhones()
    {
        $phones = $this->session->get(self::SESSION_KEY_PHONES, []);
        
        return $phones; 
    }
}