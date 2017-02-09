<?php

/**
 *  Api Entity written by jake.ltiwicki@gmail.com
 *  @source: https://docs.chargify.com/api-adjustments
 */

namespace Litwicki\Bundle\ChargifyBundle\Entity;

use Litwicki\Bundle\ChargifyBundle\Model\Entity\ChargifyEntity;
use Litwicki\Bundle\ChargifyBundle\Model\Entity\ChargifyEntityInterface;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Adjustment
 *
 * @package Litwicki\Bundle\ChargifyBundle\Entity
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 * @orm\Table(name="ChargifyAdjustment")
 */
class Adjustment extends ChargifyEntity implements ChargifyEntityInterface
{

    /**
     * @ORM\Column(type="integer")
     *
     */
    protected $subscription_id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $type;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $transaction_type;

    /**
     * @ORM\Column(type="integer")
     */
    protected $product_id;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    protected $created_at;

    /**
     * @ORM\Column(type="integer")
     */
    protected $payment_id;

    /**
     * @ORM\Column(type="integer")
     * (either ‘amount’ or ‘amount_in_cents’ is required) If you use this parameter,
     * you should pass a dollar amount represented as a string. For example, $10.00
     * would be represented as 10.00 and -$10.00 would be represented as -10.00.
     */
    protected $amount;

    /**
     * @ORM\Column(type="integer", nullable=false)
     * (either ‘amount’ or ‘amount_in_cents’ is required) If you use this parameter,
     * you should pass the amount represented as a number of cents, either as a
     * string or integer. For example, $10.00 would be represented as 1000 and
     * -$10.00 would be represented as -1000. If you pass a value for both ‘amount’
     * and ‘amount_in_cents’, the value in ‘amount_in_cents’ will be used and
     * ‘amount’ will be discarded.
     */
    protected $amount_in_cents;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * A helpful explanation for the adjustment. This amount will remind you
     * and your customer for the reason for the assessment of the adjustment.
     */
    protected $memo;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * (Optional) A string that toggles how the adjustment should be applied.
     * If target is passed for this param, the adjustment will automatically
     * set the subscription’s balance to the amount. If left blank, the amount
     * will be added to the current balance.
     */
    protected $adjustment_method;

    /**
     * @param $subscription_id
     */
    public function __construct($subscription_id)
    {
        $this->subscription_id = $subscription_id;
    }

    /**
     * Return the id (primary key) of the entity in question.
     *
     * @return int $id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getSubscriptionId()
    {
        return $this->subscription_id;
    }

    /**
     * @param string $adjustment_method
     */
    public function setAdjustmentMethod($adjustment_method)
    {
        $this->adjustment_method = $adjustment_method;
    }

    /**
     * @return string
     */
    public function getAdjustmentMethod()
    {
        return $this->adjustment_method;
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
     * @return object
     */
    public function getHandler()
    {
        return $this->container->get('chargify.handler.adjustment');
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
    public function getTransactionType()
    {
        return $this->transaction_type;
    }

    /**
     * @param mixed $transaction_type
     */
    public function setTransactionType($transaction_type)
    {
        $this->transaction_type = $transaction_type;
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