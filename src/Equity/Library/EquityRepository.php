<?php
namespace Samerior\MobileMoney\Equity\Library;

/**
 * Class EquityRepository
 * @package Samerior\MobileMoney\Equity\Library
 */
class EquityRepository
{
    /**
     * The Equity API Endpoint.
     *
     * @var string
     */
    public $endpoint;
    /**
     * The callback URL to be queried on transaction completion.
     *
     * @var string
     */
    public $callbackUrl;
    /**
     * The callback method to be used.
     *
     * @var string
     */
    public $callbackMethod;

    /**
     * Set the system to use demo timestamp and password.
     *
     * @var bool
     */
    public $demo;

    /**
     * @var string
     */
    public $consumerKey;
    /**
     * @var string
     */
    public $consumerSecret;
    /**
     * @var string
     */
    public $authBasic;
    /**
     * @var string The username
     */
    public $username;
    /**
     * @var string Password
     */
    public $password;

    /**
     * Transactor constructor.
     *
     */
    public function __construct()
    {
        $this->boot();
    }

    /**
     * Boot up the instance.
     */
    protected function boot()
    {
        $this->configure();
    }

    /**
     * Configure the instance and pick configurations from the config file.
     */
    protected function configure()
    {
        $this->setupBroker();
//        $this->setupGateway();
        $this->setNumberGenerator();
    }

    /**
     * Set up the API Broker endpoint and callback
     */
    protected function setupBroker()
    {
        $this->endpoint = (object)[
            'identity' =>config('payments.equity.endpoint-identity'),
            'transaction' => config('payments.equity.endpoint-transaction'),
        ];
        $this->callbackUrl = config('payments.equity.callback_url');
        $this->callbackMethod = config('payments.equity.callback_method');
        $this->consumerSecret = config('payments.equity.consumer_secret');
        $this->consumerKey = config('payments.equity.consumer_key');
        $this->username = config('payments.equity.username');
        $this->password = config('payments.equity.password');
        $this->authBasic = base64_encode($this->consumerKey . ':' . $this->consumerSecret);
        $this->demo = config('payments.equity.demo');
    }


    protected function setupGateway()
    {
        $this->paybillNumber = config('payments.equity.consumer_secret');
        $this->passkey = config('payments.equity.consumer_key');
        $this->demo = config('payments.equity.mode');
    }

    protected function setNumberGenerator()
    {
        $this->transactionGenerator = config('payments.equity.transaction_id_handler');
    }
}
