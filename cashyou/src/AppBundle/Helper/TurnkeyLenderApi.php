<?php
namespace AppBundle\Helper;

use AppBundle\Entity\BonusHistory;
use AppBundle\Entity\Card;
use AppBundle\Entity\CustomerBonuses;
use AppBundle\Entity\ImproveLoyalityProgramRequest;
use AppBundle\Entity\Loan;
use AppBundle\Entity\LoanApplication;
use AppBundle\Entity\LoyalityParameters;
use AppBundle\Security\User\ApiUser;
use AppBundle\Entity\User;
use GuzzleHttp\Client;
use Doctrine\Common\Cache\Cache;
use Psr\Log\LoggerInterface;
use Symfony\Component\Routing\Router;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\HttpFoundation\File\File;
use JMS\Serializer\Serializer;

class TurnkeyLenderApi
{
    const CACHE_KEY = 'TurnkeyLenderApi';

    private $client;
    private $cache;
    private $cacheEnabled;
    private $cacheLifeTime;
    private $initialSpecialProduct;
    private $initialProduct;
    private $baseProduct;
    private $tokenStorage;
    private $serializer;
    private $logger;
    private $apiLogging;
    private $router;
    private $apiToken;
    private $maxTermDays;

    /**
     * TurnkeyLenderApi constructor.
     * @param Client $client
     * @param Cache $cache
     * @param TokenStorageInterface $tokenStorage
     * @param bool $cacheEnabled
     * @param int $cacheLifeTime
     * @param $initialSpecialProduct
     * @param $initialProduct
     * @param string $baseProduct
     * @param Serializer $serializer
     * @param LoggerInterface $logger
     * @param $apiLogging
     * @param Router $router
     * @param int $maxTermDays
     */
    public function __construct(Client $client,
                                Cache $cache,
                                TokenStorageInterface $tokenStorage,
                                $cacheEnabled = true,
                                $cacheLifeTime = 300,
                                $initialSpecialProduct,
                                $initialProduct,
                                $baseProduct,
                                Serializer $serializer,
                                LoggerInterface $logger,
                                $apiLogging,
                                Router $router,
                                $maxTermDays)
    {
        $this->client = $client;
        $this->cache = $cache;
        $this->cacheEnabled = $cacheEnabled;
        $this->cacheLifeTime = $cacheLifeTime;
        $this->initialSpecialProduct = $initialSpecialProduct;
        $this->initialProduct = $initialProduct;
        $this->baseProduct = $baseProduct;
        $this->tokenStorage = $tokenStorage;
        $this->serializer = $serializer;
        $this->logger = $logger;
        $this->apiLogging = $apiLogging;
        $this->router = $router;
        $this->maxTermDays = $maxTermDays;
    }

	/**
	 * @return bool
	 */
	public function getApiLogging() {
		return $this->apiLogging;
	}

	/**
	 * @param bool $apiLogging
	 */
	public function setApiLogging( $apiLogging ) {
		$this->apiLogging = $apiLogging;
	}

    public function getToken()
    {
    	if ($this->apiToken) {
    		return $this->apiToken;
	    }

        if ($token = $this->tokenStorage->getToken()) {
            $user = $token->getUser();
            if ($user instanceof ApiUser) {
                return $user->getApiToken();
            }
        }

        return null;
    }

	/**
	 * @param string $apiToken
	 */
	public function setToken($apiToken)
    {
    	$this->apiToken = $apiToken;
    }

    public function loginCustomer($login, $password) {
        $response = $this->post('PublicApi/LoginCustomer', [
            'form_params' => [
                'login' => $login,
                'password' => $password,
            ],
        ]);

        return $response;
    }

    public function registerCustomer($login, $password)
    {
        $response = $this->post('CashYouApi/RegisterCustomer', [
            'form_params' => [
                'login' => $login,
                'password' => $password,
            ],
        ]);

        return $response;
    }

    public function forgotPassword($email)
    {
        $response = $this->post('CashYouApi/ForgotPassword', [
            'form_params' => [
                'email' => $email,
                'url' => $this->router->generate('app.password.reset.change', [], Router::ABSOLUTE_URL),
            ],
        ]);

        return $response;
    }

    public function resetPassword($userId, $code, $password)
    {
        $response = $this->post('CashYouApi/ResetPassword', [
            'form_params' => [
                'userId' => $userId,
                'code' => $code,
                'password' => $password,
            ],
        ]);

        return $response;
    }

    public function getCreditProductByName($productName, $defaultIfNotExists = false) {
        $response = $this->get('CashYouApi/GetCreditProducts', [
            'query' => [
                'creditproduct_name' => $productName,
            ],
        ]);

        if ((empty($response) || empty($response['Data'])) && $defaultIfNotExists) {
            $response = $this->get('CashYouApi/GetCreditProducts', [
                'query' => [
                    'creditproduct_name' => $this->baseProduct,
                ],
            ]);
        }

        if (!empty($response) && !empty($response['Data'])) {
            if ($response['Data'][0]['MaxTerm'] > $this->maxTermDays)
            {
                $response['Data'][0]['MaxTerm'] = $this->maxTermDays;
            }
            return $response['Data'][0];
        }

        if (function_exists('dump')) {
            dump($response);
        }

        return null;
    }

    public function specialProductAvailable()
    {
    	$loans = [];
	    $specialProductLoans = [];

    	if ($this->getToken()) {
		    $loans = $this->getCustomerLoans();

		    if (!empty($loans)) {
                $initialSpecialProduct = $this->initialSpecialProduct;
                $specialProduct = $this->initialProduct;
                $baseProduct = $this->baseProduct;

			    $specialProductLoans = array_filter($loans, function(Loan $loan) use ($specialProduct, $initialSpecialProduct, $baseProduct){
				    return (
                            (
                            $loan->getCreditProductName() == $specialProduct ||
                            $loan->getCreditProductName() == $initialSpecialProduct
                            ) &&
                            !in_array($loan->getStatus(), [
                                'Closed_Rejected',
                                'Rejected'
                            ])
				        )||
                        (
                            $loan->getCreditProductName() == $baseProduct &&
                            in_array($loan->getStatus(), [
                                'Closed_Repaid'
                            ])
                        );

			    });
		    }
	    }

        return !empty($loans) && !empty($specialProductLoans) ? false : true;
    }

    public function getDefaultProduct()
    {
        return $this->getCreditProductByName($this->getDefaultProductName(), false);
    }

    public function getDefaultProductName()
    {
        return $this->specialProductAvailable() ? $this->initialSpecialProduct : $this->baseProduct;
    }

    public function getInitialSpecialProductName()
    {
        return $this->initialSpecialProduct;
    }

    public function getNormalProductName()
    {
        return $this->specialProductAvailable() ? $this->initialProduct : $this->baseProduct;
    }

    public function getCreditProducts()
    {
        $response = $this->get('CashYouApi/GetCreditProducts');

        return (!empty($response) && isset($response['Data'])) ? $response['Data'] : null;
    }

    public function uploadDocument(File $file)
    {
        $response = $this->post('PublicApi/UploadDocument', [
            'multipart' => [
                [
                    'name' => 'document',
                    'contents' => fopen($file->getRealPath(), 'r'),
                    'filename' => md5(uniqid()).'.'.$file->guessExtension(),
                ]
            ],
        ]);

        return (!empty($response) && isset($response['Data'])) ? $response['Data'] : null;
    }

    /**
     * @return User|null
     */
    public function getCustomerDetails()
    {
        $response = $this->get('CashYouApi/GetCustomerDetails', [], true);

        return (!empty($response) && isset($response['Data'])) ?
            $this->serializer->deserialize(
                json_encode($response['Data']),
                'AppBundle\Entity\User',
                'json'
            )
            : null
        ;
    }

    /**
     * @param $token
     * @return User|null
     */
    public function getCustomerDetailsByToken($token)
    {
        $response = $this->get('CashYouApi/GetCustomerDetails', [
            'headers' => [
                'tkLender_CustomerAuthToken' => $token,
            ]
        ], true);

        return (!empty($response) && isset($response['Data'])) ?
            $this->serializer->deserialize(
                json_encode($response['Data']),
                'AppBundle\Entity\User',
                'json'
            )
            : null
            ;
    }

    public function updateCustomerDetails(User $user)
    {
        $userData = $user->apiExport();

        $response = $this->post('CashYouApi/UpdateCustomerDetails', [
            'json' => $userData,
        ]);

        return $response;
    }

    public function applyForLoan(LoanApplication $loanApplication)
    {
        $response = $this->post('CashYouApi/ApplyForLoan', [
            'form_params' => [
                'Amount' => $loanApplication->getAmount(),
                'Term' => $loanApplication->getTerm(),
                'CreditProduct' => $loanApplication->getProduct(),
            ],
        ]);

        return $response;
    }

    public function generateVerificationPurchaseRequest()
    {
        $response = $this->post('CashYouApi/GenerateVerificationPurchaseRequest');

        return (!empty($response) && isset($response['Data'])) ? $response['Data'] : null;
    }

    public function linkBankCard() {
        return $this->post('CashYouApi/LinkBankCard');
    }
    
    public function getCustomerBonuses()
    {
        $response = $this->get('CashYouApi/GetCustomerBonuses', [], true);

        if (empty($response) || !isset($response['Data'])) {
            return null;
        }

        return new CustomerBonuses(
            $response['Data']['MaxAmountDegree'],
            $response['Data']['MaxTermDegree'],
            $response['Data']['InterestRateDegree'],
            $response['Data']['BonusesTotal'],
            $response['Data']['BonusesBalance']
        );
    }
    
    public function getLoyalityParameters()
    {
        $response = $this->get('CashYouApi/GetLoyalityParameters', [], true);

        if (empty($response) || !isset($response['Data'])) {
            return null;
        }

        return new LoyalityParameters(
            $response['Data']['MaxAmount'],
            $response['Data']['MaxTerm'],
            $response['Data']['InterestRate']
        );
    }
    
    public function improveLoyalityProgram(ImproveLoyalityProgramRequest $data)
    {
        $jsonData = $data->apiExport();
        
        return $this->post('CashYouApi/ImproveLoyalityProgram', [
            'json' => $jsonData,
        ]);
    }

    /**
     * @return Loan[]|null
     */
    public function getCustomerLoans()
    {
        $response = $this->get('CashYouApi/GetCustomerLoans');

        return (!empty($response) && isset($response['Data'])) ?
            $this->serializer->deserialize(
                json_encode($response['Data']),
                'array<AppBundle\Entity\Loan>',
                'json'
            )
            : null
        ;
    }

    /**
     * @param $loanId
     * @return Loan|null
     */
    public function getCustomerLoan($loanId)
    {
        $loans = $this->getCustomerLoans();
        
        if ($loans) {
            foreach ($loans as $loan) {
                if ($loan->getId() == $loanId) {
                    return $loan;
                }
            }
        }
        
        return null;
    }

    /**
     * @return bool
     */

    public function isFirstCustomerLoan()
    {
        $loans = $this->getCustomerLoans();
        if (count($loans) == 1)
        {
            return true;
        }
        return false;
    }

    /**
     * @return Loan|null
     */
    public function getCustomerLastLoan()
    {
        $loans = $this->getCustomerLoans();
        
        uasort($loans, function(Loan $loan1, Loan $loan2){
            return $loan1->getCreationDate() < $loan2->getCreationDate();
        });
        
        return !empty($loans) ? array_shift($loans) : null;
    }

    /**
     * @return Loan[]|null
     */
    public function getCustomerLastClosedLoan()
    {
        $loans = $this->getCustomerLoans();

        $loans =  $loans ? array_values(array_filter($loans, function(Loan $loan) {
            return in_array($loan->getStatus(), [
                'Closed_Repaid'
            ]);
        })) : $loans;

        uasort($loans, function(Loan $loan1, Loan $loan2){
            return $loan1->getCreationDate() < $loan2->getCreationDate();
        });

        return !empty($loans) ? array_shift($loans) : null;
    }

    /**
     * @param Loan[] $loans
     * @return Loan[]|null
     */
    public function getCustomerActiveLoans(array $loans = null)
    {
        $loans = $loans ? $loans : $this->getCustomerLoans();
        
        return $loans ? array_values(array_filter($loans, function(Loan $loan) {
            return !$loan->isClosed();
        })) : $loans;
    }

    /**
     * @param Loan[]|null $loans
     * @return Loan[]|null
     */
    public function getCustomerLoansHistory(array $loans = null)
    {
        $loans = $loans ? $loans : $this->getCustomerLoans();
        
        return $loans ? array_values(array_filter($loans, function(Loan $loan) {
            return in_array($loan->getStatus(), [
                'Closed_Repaid',
                'Closed_WrittenOff',
                'Closed_Restructured',
            ]);
        })) : $loans;
    }

    /**
     * @param Loan[]|null $loans
     * @return bool
     */
    public function customerHasUnpaidLoans(array $loans = null)
    {
        $loans = $loans ? $loans : $this->getCustomerLoans();
        
        $activeLoans = array_values(array_filter($loans, function(Loan $loan) {
            return in_array($loan->getStatus(), [
                'Active',
                'RolloverRequested',
                'PastDue',
            ]);
        }));

        return !empty($activeLoans);
    }

    public function requestRollover($loanId, $rolloverTerm)
    {
        $response = $this->post('CashYouApi/RequestRollover', [
            'form_params' => [
                'loanId' => $loanId,
                'rolloverTerm' => $rolloverTerm,
            ],
        ]);
        
        return $response;
    }
    
    public function makePaymentUAH($loanId, $amount)
    {
        $response = $this->post('CashYouApi/MakePaymentUAH', [
            'form_params' => [
                'loanId' => $loanId,
                'amount' => str_replace('.',  ',', strval($amount)),
            ],
        ]);

        return $response;
    }
    
    public function makePaymentBonuses($loanId, $amount)
    {
        $response = $this->post('CashYouApi/MakePaymentBonuses', [
            'form_params' => [
                'loanId' => $loanId,
                'amount' => $amount,
            ],
        ]);

        return $response;
    }
    
    public function getTransactionStatus($transactionId)
    {
        return $this->get('CashYouApi/GetTransactionStatus?TransactionID='.$transactionId, [], true);
    }
    
    public function downloadAgreement($loanId)
    {
        return $this->request('get', 'CashYouApi/DownloadAgreement?LoanId='.$loanId, [], false);
    }
    
    public function signLoan($loanId, $signatureId, $code)
    {
        return $this->post('CashYouApi/SignLoan', [
            'form_params' => [
                'loanId' => $loanId,
                'signatureId' => $signatureId,
                'code' => $code,
            ],
        ]);
    }
    
    public function resendSmsCode($loanId, $signatureId)
    {
        return $this->post('CashYouApi/ResendSmsCode', [
            'form_params' => [
                'loanId' => $loanId,
                'signatureId' => $signatureId,
            ],
        ]);
    }
    
    public function getBonusExchangeRate()
    {
        $result = $this->get('CashYouApi/GetBonusExchangeRate');
        
        return isset($result['Data']['ExchangeRate']) ? floatval($result['Data']['ExchangeRate']) : null;
    }
    
    public function getBonusHistory()
    {
        $response = $this->get('CashYouApi/GetBonusHistory');

        $records = (!empty($response) && isset($response['Data'])) ?
            $this->serializer->deserialize(
                json_encode($response['Data']),
                'array<AppBundle\Entity\BonusHistoryRecord>',
                'json'
            )
            : []
        ;
        
        return new BonusHistory($records);
    }
    
    public function changeCustomerPassword($currentPassword, $newPassword)
    {
        return $this->post('PublicApi/ChangeCustomerPassword', [
            'form_params' => [
                'currentPassword' => $currentPassword,
                'newPassword' => $newPassword,
            ],
        ]);
    }

    /**
     * @return Card|null
     */
    public function getBankCardDetails()
    {
        $response = $this->get('CashYouApi/GetBankCardDetails');

        $card = (!empty($response) && isset($response['Data']['Card'])) ?
            $this->serializer->deserialize(
                json_encode($response['Data']['Card']),
                'AppBundle\Entity\Card',
                'json'
            )
            : null
        ;
        
        return $card;
    }
    
    /**
     * @param string $uri
     * @param array $options
     * @param bool $noCache
     * @return mixed|null
     */
    public function get($uri, array $options = [], $noCache = true)
    {
        if ($this->cacheEnabled && !$noCache) {
            if (false !== ($response = $this->loadFromCache($uri, $options))) {
                return $response;
            }
        }

        $response = $this->request('get', $uri, $options);

        if ($this->cache) {
            $this->saveToCache($response, $uri, $options);
        }

        return $response;
    }

    /**
     * @param string $uri
     * @param array  $options
     *
     * @return mixed|null
     */
    public function post($uri, array $options = [])
    {
        return $this->request('post', $uri, $options);
    }

    /**
     * @param string $uri
     * @param array  $options
     *
     * @return mixed|null
     */
    public function delete($uri, array $options = [])
    {
        return $this->request('delete', $uri, $options);
    }

    /**
     * @param string $uri
     * @param array  $options
     *
     * @return mixed|null
     */
    public function put($uri, array $options = [])
    {
        return $this->request('put', $uri, $options);
    }

    /**
     * @param string $method
     * @param string $uri
     * @param array $options
     * @param bool $json
     * @return mixed|null
     */
    public function request($method, $uri, array $options = [], $json = true) {
        $response = null;

        if (!isset($options['headers']['tkLender_CustomerAuthToken']) && $this->getToken()) {
            $options['headers']['tkLender_CustomerAuthToken'] = $this->getToken();
        }

        try {
            $result = $this->client->request($method, $uri, $options);

            $response = $result->getBody()->getContents();
            if ($json) {
                $response = json_decode($response, true);
            }
            
            if ($this->apiLogging) {
                $this->logger->info('API CALL', [
                    'method' => $method,
                    'uri' => $uri,
                    'options' => $options,
                    'response' => $json ? $response : 'STREAM',
                ]);
            }
        } catch (\Exception $e) {
            if ($this->apiLogging) {
                $this->logger->error('API ERROR', [
                    'method' => $method,
                    'uri' => $uri,
                    'options' => $options,
                    'error' => $e,
                ]);
            }
        }

        return $response;
    }

    /**
     * @param mixed  $data
     * @param string $uri
     * @param array  $options
     */
    protected function saveToCache($data, $uri, array $options = [])
    {
        $this->cache->save(self::CACHE_KEY.'_'.md5($uri.'_'.serialize($options)), $data, $this->cacheLifeTime);
    }

    /**
     * @param string $uri
     * @param array  $options
     *
     * @return mixed
     */
    protected function loadFromCache($uri, array $options = [])
    {
        return $this->cache->fetch(self::CACHE_KEY.'_'.md5($uri.'_'.serialize($options)));
    }
}