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
 * Class Charge
 *
 * @package Litwicki\Bundle\ChargifyBundle\Entity
 */
class Charge extends ChargifyEntity implements ChargifyEntityInterface
{
    /**
     * @Type("string")
	 * @Groups({"api"})
	 * @Expose
     */
    protected $success;

    /**
     * @Type("float")
	 * @Groups({"api"})
	 * @Expose
     */
    protected $amount;

    /**
     * @Type("string")
	 * @Groups({"api"})
	 * @Expose
     */
    protected $memo;

    /**
     * @Type("integer")
	 * @Groups({"api"})
	 * @Expose
     */
    protected $amount_in_cents;

    /**
     * @Type("integer")
	 * @Groups({"api"})
	 * @Expose
     */
    protected $ending_balance_in_cents;

    /**
     * @Type("string")
	 * @Groups({"api"})
	 * @Expose
     */
    protected $type;

    /**
     * @Type("integer")
	 * @Groups({"api"})
	 * @Expose
     */
    protected $subscription_id;

    /**
     * @Type("integer")
	 * @Groups({"api"})
	 * @Expose
     */
    protected $product_id;

    /**
     * @Type("datetime")
	 * @Groups({"api"})
	 * @Expose
     */
    protected $created_at;

    /**
     * @Type("integer")
	 * @Groups({"api"})
	 * @Expose
     */
    protected $payment_id;

    /**
     * @Type("boolean")
	 * @Groups({"api"})
	 * @Expose
     */
    protected $use_negative_balance;

    /**
     * @Type("boolean")
	 * @Groups({"api"})
	 * @Expose
     */
    protected $delay_capture;

    /**
     * @Type("boolean")
	 * @Groups({"api"})
	 * @Expose
     */
    protected $taxable;

    /**
     * @Type("string")
	 * @Groups({"api"})
	 * @Expose
     */
    protected $payment_collection_method;

    /**
     * @return mixed
     */
    public function getDelayCapture()
    {
        return $this->delay_capture;
    }

    /**
     * @param mixed $delay_capture
     */
    public function setDelayCapture($delay_capture)
    {
        $this->delay_capture = $delay_capture;
    }

    /**
     * @return mixed
     */
    public function getPaymentCollectionMethod()
    {
        return $this->payment_collection_method;
    }

    /**
     * @param mixed $payment_collection_method
     */
    public function setPaymentCollectionMethod($payment_collection_method)
    {
        $this->payment_collection_method = $payment_collection_method;
    }

    /**
     * @return mixed
     */
    public function getTaxable()
    {
        return $this->taxable;
    }

    /**
     * @param mixed $taxable
     */
    public function setTaxable($taxable)
    {
        $this->taxable = $taxable;
    }

    /**
     * @return mixed
     */
    public function getUseNegativeBalance()
    {
        return $this->use_negative_balance;
    }

    /**
     * @param mixed $use_negative_balance
     */
    public function setUseNegativeBalance($use_negative_balance)
    {
        $this->use_negative_balance = $use_negative_balance;
    }

    /**
     * @param $subscription_id
     */
    public function __construct($subscription_id)
    {
        $this->subscription_id = $subscription_id;
    }

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
     * @return mixed
     */
    public function getAmountInCents()
    {
        return $this->amount_in_cents;
    }

    /**
     * @param mixed $amount_in_cents
     */
    public function setAmountInCents($amount_in_cents)
    {
        $this->amount_in_cents = $amount_in_cents;
    }

    /**
     * @return mixed
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * @param mixed $created_at
     */
    public function setCreatedAt($created_at)
    {
        $this->created_at = $created_at;
    }

    /**
     * @return mixed
     */
    public function getEndingBalanceInCents()
    {
        return $this->ending_balance_in_cents;
    }

    /**
     * @param mixed $ending_balance_in_cents
     */
    public function setEndingBalanceInCents($ending_balance_in_cents)
    {
        $this->ending_balance_in_cents = $ending_balance_in_cents;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getMemo()
    {
        return $this->memo;
    }

    /**
     * @param mixed $memo
     */
    public function setMemo($memo)
    {
        $this->memo = $memo;
    }

    /**
     * @return mixed
     */
    public function getPaymentId()
    {
        return $this->payment_id;
    }

    /**
     * @param mixed $payment_id
     */
    public function setPaymentId($payment_id)
    {
        $this->payment_id = $payment_id;
    }

    /**
     * @return mixed
     */
    public function getProductId()
    {
        return $this->product_id;
    }

    /**
     * @param mixed $product_id
     */
    public function setProductId($product_id)
    {
        $this->product_id = $product_id;
    }

    /**
     * @return mixed
     */
    public function getSubscriptionId()
    {
        return $this->subscription_id;
    }

    /**
     * @param mixed $subscription_id
     */
    public function setSubscriptionId($subscription_id)
    {
        $this->subscription_id = $subscription_id;
    }

    /**
     * @return mixed
     */
    public function getSuccess()
    {
        return $this->success;
    }

    /**
     * @param mixed $success
     */
    public function setSuccess($success)
    {
        $this->success = $success;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param mixed $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

}