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
 * Class Transaction
 *
 * @package Litwicki\Bundle\ChargifyBundle\Entity
 */
class Transaction extends ChargifyEntity implements ChargifyEntityInterface
{

    /**
     * @type int
     *  The unique identifier for the Transaction
     */
    protected $id;

    /**
     * @type string
     *  The type of the transaction
     *
     * charge
     * refund
     * payment
     * credit
     * payment_authorization
     * info
     * adjustment
     */
    protected $transaction_type;

    /**
     * @type int
     *  The amount in cents of the Transaction
     */
    protected $amount_in_cents;

    /**
     * @type datetime
     *  Timestamp indicating when the Transaction was created
     */
    protected $created_at;

    /**
     * @type int
     *  The initial balance on the subscription before the Transaction has been processed
     */
    protected $starting_balance_in_cents;

    /**
     * @type int
     *  The remaining balance on the subscription after the Transaction has been processed
     */
    protected $ending_balance_in_cents;

    /**
     * @type string
     *  A note about the Transaction
     */
    protected $memo;

    /**
     * @type int
     *  The unique identifier for the associated Subscription
     */
    protected $subscription_id;

    /**
     * @type int
     * The unique identifier for the product associated with the Subscription
     */
    protected $product_id;

    /**
     * @type bool
     *  Whether or not the Transaction was successful
     */
    protected $success;

    /**
     * @type int
     * The unique identifier for the payment being explicitly refunded (in whole or in part) by this transaction.
     * Will be null for all transaction types except for “Refund”. May be null even for Refunds. For partial refunds,
     * more than one Refund transaction may reference the same payment_id.
     */
    protected $payment_id;

    /**
     * @type string
     *  The specific “subtype” for the transaction_type
     *
     * one_time: A one-time charge, captured immediately from payment source (credit card)
     * delay_capture: A one-time charge accrued to the subscription to be captured at next normal billing/renewal
     * initial: A initial/upfront/startup charge added according to the product setup settings
     * metered or metered_component: A charge from usage of a metered component
     * quantity_based_component: A charge from a quantity-based component allocation
     * on_off_component: A charge from an on/off component allocation
     * tax: A calculated tax charge
     */
    protected $kind;

    /**
     * @type int
     *  The transaction ID from the remote gateway (i.e. Authorize.Net), if one exists
     */
    protected $gateway_transaction_id;

    /**
     * @type int
     *  A gateway-specific identifier for the transaction, separate from the gateway_transaction_id:
     */
    protected $gateway_order_id;

    /**
     * @return int
     */
    public function getAmountInCents()
    {
        return $this->amount_in_cents;
    }

    /**
     * @return datetime
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * @return int
     */
    public function getEndingBalanceInCents()
    {
        return $this->ending_balance_in_cents;
    }

    /**
     * @return int
     */
    public function getGatewayOrderId()
    {
        return $this->gateway_order_id;
    }

    /**
     * @return int
     */
    public function getGatewayTransactionId()
    {
        return $this->gateway_transaction_id;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getKind()
    {
        return $this->kind;
    }

    /**
     * @return string
     */
    public function getMemo()
    {
        return $this->memo;
    }

    /**
     * @return int
     */
    public function getPaymentId()
    {
        return $this->payment_id;
    }

    /**
     * @return int
     */
    public function getProductId()
    {
        return $this->product_id;
    }

    /**
     * @return int
     */
    public function getStartingBalanceInCents()
    {
        return $this->starting_balance_in_cents;
    }

    /**
     * @return int
     */
    public function getSubscriptionId()
    {
        return $this->subscription_id;
    }

    /**
     * @return boolean
     */
    public function isSuccess()
    {
        return $this->success;
    }

    /**
     * @return string
     */
    public function getTransactionType()
    {
        return $this->transaction_type;
    }

    /**
     * @param int $amount_in_cents
     */
    public function setAmountInCents($amount_in_cents)
    {
        $this->amount_in_cents = $amount_in_cents;
    }

    /**
     * @param datetime $created_at
     */
    public function setCreatedAt($created_at)
    {
        $this->created_at = $created_at;
    }

    /**
     * @param int $ending_balance_in_cents
     */
    public function setEndingBalanceInCents($ending_balance_in_cents)
    {
        $this->ending_balance_in_cents = $ending_balance_in_cents;
    }

    /**
     * @param int $gateway_order_id
     */
    public function setGatewayOrderId($gateway_order_id)
    {
        $this->gateway_order_id = $gateway_order_id;
    }

    /**
     * @param int $gateway_transaction_id
     */
    public function setGatewayTransactionId($gateway_transaction_id)
    {
        $this->gateway_transaction_id = $gateway_transaction_id;
    }

    /**
     * @param string $kind
     */
    public function setKind($kind)
    {
        $this->kind = $kind;
    }

    /**
     * @param string $memo
     */
    public function setMemo($memo)
    {
        $this->memo = $memo;
    }

    /**
     * @param int $payment_id
     */
    public function setPaymentId($payment_id)
    {
        $this->payment_id = $payment_id;
    }

    /**
     * @param int $product_id
     */
    public function setProductId($product_id)
    {
        $this->product_id = $product_id;
    }

    /**
     * @param int $starting_balance_in_cents
     */
    public function setStartingBalanceInCents($starting_balance_in_cents)
    {
        $this->starting_balance_in_cents = $starting_balance_in_cents;
    }

    /**
     * @param int $subscription_id
     */
    public function setSubscriptionId($subscription_id)
    {
        $this->subscription_id = $subscription_id;
    }

    /**
     * @param boolean $success
     */
    public function setSuccess($success)
    {
        $this->success = $success;
    }

    /**
     * @param string $transaction_type
     */
    public function setTransactionType($transaction_type)
    {
        $this->transaction_type = $transaction_type;
    }



}
