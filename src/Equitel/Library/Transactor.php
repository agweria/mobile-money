<?php

namespace Samerior\MobileMoney\Equitel\Library;

use Carbon\Carbon;
use DOMDocument;
use GuzzleHttp\Client;
use Ixudra\Curl\Facades\Curl;
use Samerior\MobileMoney\Exceptions\EquityException;

/**
 * Class Transactor
 * @package Samerior\MobileMoney\Equitel\Library
 */
class Transactor
{
    protected $bearer;
    /**
     * The hashed password.
     *
     * @var string
     */
    protected $password;
    /**
     * The transaction timestamp.
     *
     * @var int
     */
    protected $timestamp;
    /**
     * The transaction reference id
     *
     * @var int
     */
    protected $referenceId;
    /**
     * The amount to be deducted
     *
     * @var int
     */
    protected $amount;
    /**
     * The Mobile Subscriber number to be billed.
     * Must be in format 2547XXXXXXXX.
     *
     * @var int
     */
    protected $number;
    /**
     * The keys and data to fill in the request body.
     *
     * @var array
     */
    protected $keys;
    /**
     * The request to be sent to the endpoint
     *
     * @var string
     */
    protected $request;
    /**
     * The generated transaction number by the Transactable implementer.
     *
     * @var string
     */
    protected $transactionNumber;
    /**
     * The Guzzle Client used to make the request to the endpoint.
     *
     * @var Client
     */
    private $client;
    /**
     * @var EquitelRepository
     */
    private $repository;

    /**
     * Transactor constructor.
     * @param EquitelRepository $repository
     */
    public function __construct(EquitelRepository $repository)
    {
        $this->client = new Client([
            'verify' => false,
            'timeout' => 60,
            'allow_redirects' => false,
            'expect' => false,
        ]);
        $this->repository = $repository;
    }

    /**
     * Process the transaction request.
     *
     * @param $amount
     * @param $number
     * @param $referenceId
     *
     * @return mixed|\Psr\Http\Message\ResponseInterface
     */
    public function process($amount, $number, $referenceId)
    {
        $this->amount = $amount;
        $this->number = $number;
        $this->referenceId = $referenceId;
        $this->initialize();
        return $this->handle();
    }

    /**
     * Initialize the transaction.
     */
    protected function initialize()
    {
        $this->setTimestamp();
        $this->getTransactionNumber();
        $this->setBearer();
//        $this->setupKeys();
    }

    /**
     * @throws EquityException
     */
    private function setBearer()
    {
        $response = Curl::to($this->repository->endpoint->identity . '/token')
            ->withHeader('Authorization: Basic ' . $this->repository->authBasic)->returnResponseObject()
            ->withData([
                'username' => $this->repository->username,
                'password' => $this->repository->password,
                'grant_type' => 'password'])
            ->post();
        $data = json_decode($response->content);
        if (!empty($data->access_token)) {
            $this->bearer = $data->access_token;
        } else {
            throw  new EquityException("Authentication Failed");
        }
    }

    /**
     * Validate and execute the transaction.
     * @todo Check Payment Status
     * @return mixed|\Psr\Http\Message\ResponseInterface
     */
    protected function handle()
    {
        $result = $this->createPayment();
        $status = $this->checkPaymentStatus($result->content);
        return (object)['result' => $result->content, 'status' => json_decode($status->content), 'reference' => $this->transactionNumber];
    }

    public function checkPaymentStatus($result)
    {
        $ref = $result->transactionRef;
        $url = $this->repository->endpoint->transaction . '/payments/' . $ref;
        return Curl::to($url)
            ->withHeader('Authorization: Bearer ' . $this->bearer)
            ->returnResponseObject()->get();
    }

    /**
     * Create Payment Payload
     */
    private function createPayment()
    {
        $url = $this->repository->endpoint->transaction . '/payments';
        return Curl::to($url)
            ->withHeader('Authorization: Bearer ' . $this->bearer)
            ->returnResponseObject()
            ->withData([
                'customer' => [
                    'mobileNumber' => '254763555289'
                ],
                'transaction' => [
                    "amount" => "50000",
                    "description" => "Payment",
                    "type" => "StkRequest Payment",
                    "auditNumber" => $this->transactionNumber,
                ]
            ])
            ->asJson()
            ->post();
    }

    /**
     * Set the transaction timestamp.
     */
    private function setTimestamp()
    {
        if ($this->repository->demo) {
            $this->timestamp = '20160510161908';
            return $this->timestamp;
        }
        $this->timestamp = Carbon::now()->format('YmdHis');
        return $this->timestamp;
    }

    /**
     * Override the config pay bill number and pass key.
     *
     * @param $payBillNumber
     * @param $payBillPassKey
     *
     * @return $this
     */
    public function setPayBill($payBillNumber, $payBillPassKey)
    {
        $this->repository->paybillNumber = $payBillNumber;
        $this->repository->passkey = $payBillPassKey;
        return $this;
    }


    /**
     * Map the document fields with the transaction details.
     * @throws \Exception
     */
    protected function setupKeys()
    {
        $this->keys = [
            // 'VA_PAYBILL' => $this->repository->paybillNumber,
            'VA_PASSWORD' => $this->password,
            'VA_TIMESTAMP' => $this->timestamp,
            'VA_TRANS_ID' => $this->getTransactionNumber(),
            'VA_REF_ID' => $this->referenceId,
            'VA_AMOUNT' => $this->amount,
            'VA_NUMBER' => $this->number,
            'VA_CALL_URL' => $this->repository->callbackUrl,
            'VA_CALL_METHOD' => $this->repository->callbackMethod,
        ];
    }

    /**
     * Get the transaction number from the  implementer.
     *
     * @return string
     */
    private function getTransactionNumber(): string
    {
        $this->transactionNumber = $this->generateTransactionNumber();
        return $this->transactionNumber;
    }

    /**
     * @return string
     */
    private function generateTransactionNumber(): string
    {
        $characters = '0123456789';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < 10; $i++) {
            $randomString .= $characters[random_int(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    /**
     * Validate the required fields
     */
    private function validateKeys()
    {
        Validator::validate($this->keys);
    }


    /**
     * Execute the request.
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    private function send()
    {
        $response = $this->client->request('POST', $this->repository->endpoint, [
            'body' => $this->request
        ]);
        $this->validateResponse($response);
        return $response;
    }

    /**
     * Validate the response is a success, throw error if not.
     *
     * @param Response $response
     *
     * @throws TransactionException
     * @throws EquityException
     */
    private function validateResponse($response)
    {
        $message = $response->getBody()->getContents();
        $response->getBody()->rewind();
        $doc = new DOMDocument();
        $doc->loadXML($message);
        $responseCode = $doc->getElementsByTagName('RETURN_CODE')->item(0)->nodeValue;
        if ($responseCode != '00') {
            $responseDescription = $doc
                ->getElementsByTagName('DESCRIPTION')
                ->item(0)
                ->nodeValue;
            throw new EquityException('Failure - ' . $responseDescription);
        }
    }
}
