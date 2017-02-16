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
 * Class Invoice
 *
 * @package Litwicki\Bundle\ChargifyBundle\Entity
 */
class Invoice extends ChargifyEntity implements ChargifyEntityInterface
{

    /**
     * @Type("integer")
	 * @Groups({"api"})
	 * @Expose
     * The subscription unique id within Chargify
     */
    protected $subscription_id;

    /**
     * @Type("integer")
	 * @Groups({"api"})
	 * @Expose
     * The statement unique id within Chargify
     */
    protected $statement_id;

    /**
     * @Type("integer")
	 * @Groups({"api"})
	 * @Expose
     * The site unique id within Chargify
     */
    protected $site_id;

    /**
     * @Type("string")
	 * @Groups({"api"})
	 * @Expose
     * The current state of the subscription associated with this invoice.
     * Please see the documentation for Subscription States
     * @see: https://docs.chargify.com/subscription-states
     */
    protected $state;

    /**
     * @Type("float")
	 * @Groups({"api"})
	 * @Expose
     * Gives the current invoice amount in the number of cents (ie. the sum of charges)
     */
    protected $total_amount_in_cents;

    /**
     * @Type("datetime")
	 * @Groups({"api"})
	 * @Expose
     * The date/time when the invoice was paid in full
     */
    protected $paid_at;

    /**
     * @Type("datetime")
	 * @Groups({"api"})
	 * @Expose
     * The creation date/time for this invoice
     */
    protected $created_at;

    /**
     * @Type("datetime")
	 * @Groups({"api"})
	 * @Expose
     * The date/time of last update for this invoice
     */
    protected $updated_at;

    /**
     * @Type("integer")
	 * @Groups({"api"})
	 * @Expose
     * Gives the current outstanding invoice balance in the number of cents
     */
    protected $amount_due_in_cents;

    /**
     * @Type("integer")
	 * @Groups({"api"})
	 * @Expose
     * The unique (to this site) identifier for this invoice
     */
    protected $number;

    /**
     * @return mixed
     */
    public function getAmountDueInCents()
    {
        return $this->amount_due_in_cents;
    }

    /**
     * @param mixed $amount_due_in_cents
     */
    public function setAmountDueInCents($amount_due_in_cents)
    {
        $this->amount_due_in_cents = $amount_due_in_cents;
    }

    /**
     * @return mixed
     */
    public function getCharges()
    {
        return $this->charges;
    }

    /**
     * @param mixed $charges
     */
    public function setCharges($charges)
    {
        $this->charges = $charges;
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
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * @param mixed $number
     */
    public function setNumber($number)
    {
        $this->number = $number;
    }

    /**
     * @return mixed
     */
    public function getPaidAt()
    {
        return $this->paid_at;
    }

    /**
     * @param mixed $paid_at
     */
    public function setPaidAt($paid_at)
    {
        $this->paid_at = $paid_at;
    }

    /**
     * @return mixed
     */
    public function getPaymentsAndCredits()
    {
        return $this->payments_and_credits;
    }

    /**
     * @param mixed $payments_and_credits
     */
    public function setPaymentsAndCredits($payments_and_credits)
    {
        $this->payments_and_credits = $payments_and_credits;
    }

    /**
     * @return mixed
     */
    public function getSiteId()
    {
        return $this->site_id;
    }

    /**
     * @param mixed $site_id
     */
    public function setSiteId($site_id)
    {
        $this->site_id = $site_id;
    }

    /**
     * @return mixed
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * @param mixed $state
     */
    public function setState($state)
    {
        $this->state = $state;
    }

    /**
     * @return mixed
     */
    public function getStatementId()
    {
        return $this->statement_id;
    }

    /**
     * @param mixed $statement_id
     */
    public function setStatementId($statement_id)
    {
        $this->statement_id = $statement_id;
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
    public function getTotalAmountInCents()
    {
        return $this->total_amount_in_cents;
    }

    /**
     * @param mixed $total_amount_in_cents
     */
    public function setTotalAmountInCents($total_amount_in_cents)
    {
        $this->total_amount_in_cents = $total_amount_in_cents;
    }

    /**
     * @return mixed
     */
    public function getUpdatedAt()
    {
        return $this->updated_at;
    }

    /**
     * @param mixed $updated_at
     */
    public function setUpdatedAt($updated_at)
    {
        $this->updated_at = $updated_at;
    }
    
}