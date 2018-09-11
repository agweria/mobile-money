<?php

namespace Samerior\MobileMoney\Equitel\Library;

/**
 * Class StkRequest
 * @package Samerior\MobileMoney\Equitel\Library
 */
class StkRequest
{
    /**
     * The amount to be deducted.
     *
     * @var int
     */
    protected $amount;
    /**
     * The Mobile Subscriber Number.
     *
     * @var int
     */
    protected $number;
    /**
     * The product reference identifier.
     *
     * @var int
     */
    protected $referenceId;
    /**
     * The transaction handler.
     *
     * @var Transactor
     */
    private $transactor;

    /**
     * Cashier constructor.
     *
     * @param Transactor $transactor
     */
    public function __construct(Transactor $transactor)
    {
        $this->transactor = $transactor;
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
        $this->transactor->setPayBill($payBillNumber, $payBillPassKey);
        return $this;
    }

    /**
     * Set the request amount to be deducted.
     *
     * @param int $amount
     *
     * @return $this
     * @throws \InvalidArgumentException
     */
    public function request($amount)
    {
        if (!is_numeric($amount)) {
            throw new \InvalidArgumentException('The amount must be numeric');
        }
        $this->amount = $amount;
        return $this;
    }

    private function formatPhoneNumber(&$number)
    {
        if (\strlen($number) === 10) {
            $needle = '07';
            if (starts_with($number, $needle)) {
                $pos = strpos($number, $needle);
                $number = substr_replace($number, '2547', $pos, strlen($needle));
            }
        }
    }

    /**
     * Set the Mobile Subscriber Number to deduct the amount from.
     * Must be in format 2547XXXXXXXX.
     *
     * @param int $number
     *
     * @return $this
     * @throws \InvalidArgumentException
     */
    public function from($number)
    {
        $this->formatPhoneNumber($number);
        if (!starts_with($number, '2547')) {
            throw new \InvalidArgumentException('The subscriber number must start with 2547');
        }
        $this->number = $number;
        return $this;
    }

    /**
     * Set the product reference number to bill the account.
     *
     * @param int $referenceId
     *
     * @return $this
     */
    public function usingReferenceId($referenceId)
    {
        $this->referenceId = $referenceId;
        return $this;
    }

    /**
     * Initiate the transaction
     *
     * @return mixed|\Psr\Http\Message\ResponseInterface
     */
    public function transact()
    {
        return $this->transactor->process($this->amount, $this->number, $this->referenceId);
    }

    /**
     * Get payment status
     * @return mixed
     */
    public function status()
    {
        $x = null;
        if (is_object($x)) {
            $extra = ['gateway' => $request->mode,
                'description' => 'Payment of ' . $request->to_pay . ' received. Ref ' . $x->result->transactionRef];
            $this->credit($request->user()->id, $request->to_pay, $extra);
        }
    }
}
