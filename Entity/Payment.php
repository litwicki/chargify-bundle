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
use Litwicki\Common;
use Litwicki\Bundle\ChargifyBundle\Model\Entity\ChargifyEntity;
use Litwicki\Bundle\ChargifyBundle\Model\Entity\ChargifyEntityInterface;

/**
 * Class Payment
 *
 * @package Litwicki\Bundle\ChargifyBundle\Entity
 */
class Payment extends ChargifyEntity implements ChargifyEntityInterface
{

    /**
     * @type
     */
    protected $id;
    /**
     * @type
     */
    protected $amount_in_cents;
    /**
     * @type
     */
    protected $created_at;
    /**
     * @type
     */
    protected $ending_balance_in_cents;
    /**
     * @type
     */
    protected $kind;
    /**
     * @type
     */
    protected $memo;
    /**
     * @type
     */
    protected $payment_id;
    /**
     * @type
     */
    protected $product_id;
    /**
     * @type
     */
    protected $starting_balance_in_cents;
    /**
     * @type
     */
    protected $subscription_id;
    /**
     * @type
     */
    protected $success;
    /**
     * @type
     */
    protected $type;
    /**
     * @type
     */
    protected $trasnaction_type;
    /**
     * @type
     */
    protected $gateway_transaction_id;

    /**
     * Construct the Payment.
     *
     * @param $subscription_id
     */
    public function __construct($subscription_id)
    {
        $this->subscription_id = $subscription_id;
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
    public function getGatewayTransactionId()
    {
        return $this->gateway_transaction_id;
    }

    /**
     * @param mixed $gateway_transaction_id
     */
    public function setGatewayTransactionId($gateway_transaction_id)
    {
        $this->gateway_transaction_id = $gateway_transaction_id;
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
    public function getKind()
    {
        return $this->kind;
    }

    /**
     * @param mixed $kind
     */
    public function setKind($kind)
    {
        $this->kind = $kind;
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
    public function getStartingBalanceInCents()
    {
        return $this->starting_balance_in_cents;
    }

    /**
     * @param mixed $starting_balance_in_cents
     */
    public function setStartingBalanceInCents($starting_balance_in_cents)
    {
        $this->starting_balance_in_cents = $starting_balance_in_cents;
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
    public function getTrasnactionType()
    {
        return $this->trasnaction_type;
    }

    /**
     * @param mixed $trasnaction_type
     */
    public function setTrasnactionType($trasnaction_type)
    {
        $this->trasnaction_type = $trasnaction_type;
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