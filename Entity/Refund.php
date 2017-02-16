<?php

namespace Litwicki\Bundle\ChargifyBundle\Entity;
use JMS\Serializer\Annotation as Serializer;
use JMS\Serializer\Annotation\Accessor;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\VirtualProperty;
use JMS\Serializer\Annotation\Groups;
use JMS\Serializer\Annotation\MaxDepth;
use JMS\Serializer\Annotation\SerializedName;
use Litwicki\Common\Common;
use Litwicki\Bundle\ChargifyBundle\Model\Entity\ChargifyEntity;
use Litwicki\Bundle\ChargifyBundle\Model\Entity\ChargifyEntityInterface;

/**
 * Class Refund
 *
 * @package Litwicki\Bundle\ChargifyBundle\Entity
 */
class Refund extends ChargifyEntity implements ChargifyEntityInterface
{
    /**
     * @Type("boolean")
	 * @Groups({"api"})
	 * @Expose
     * Either true or false, depending on the success of the refund.
     */
    protected $success;

    /**
     * @Type("integer")
	 * @Groups({"api"})
	 * @Expose
     * (either ‘amount’ or ‘amount_in_cents’ is required)
     * If you use this parameter, you should pass the amount
     * represented as a number of cents, either as a string or integer.
     * For example, $10.00 would be represented as 1000.
     * If you pass a value for both ‘amount’ and ‘amount_in_cents’,
     * the value in ‘amount_in_cents’ will be used and ‘amount’ will be discarded.
     */
    protected $amount_in_cents;

    /**
     * @Type("string")
	 * @Groups({"api"})
	 * @Expose
     * (required) A helpful explanation for the refund.
     * This amount will remind you and your customer for the reason for the refund.
     */
    protected $memo;

    /**
     * @Type("integer")
	 * @Groups({"api"})
	 * @Expose
     *  (required) The id of the Payment that the credit will be applied to
     */
    protected $payment_id;

    /**
     * @Type("float")
	 * @Groups({"api"})
	 * @Expose
     *  (either ‘amount’ or ‘amount_in_cents’ is required)
     * If you use this parameter, you should pass a dollar amount represented as a string.
     * For example, $10.00 would be represented as 10.00.
     */
    protected $amount;

    /**
     * @return mixed
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * @param mixed $amount
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;
    }

    /**
     * @return int
     */
    public function getAmountInCents()
    {
        return $this->amount_in_cents;
    }

    /**
     * @param int $amount_in_cents
     */
    public function setAmountInCents($amount_in_cents)
    {
        $this->amount_in_cents = $amount_in_cents;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getMemo()
    {
        return $this->memo;
    }

    /**
     * @param string $memo
     */
    public function setMemo($memo)
    {
        $this->memo = $memo;
    }

    /**
     * @return int
     */
    public function getPaymentId()
    {
        return $this->payment_id;
    }

    /**
     * @param int $payment_id
     */
    public function setPaymentId($payment_id)
    {
        $this->payment_id = $payment_id;
    }

    /**
     * @return boolean
     */
    public function isSuccess()
    {
        return $this->success;
    }

    /**
     * @param boolean $success
     */
    public function setSuccess($success)
    {
        $this->success = $success;
    }



}