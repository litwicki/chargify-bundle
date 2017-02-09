<?php

namespace Litwicki\Bundle\ChargifyBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use Litwicki\Common;
use Litwicki\Bundle\ChargifyBundle\Model\Entity\ChargifyEntity;
use Litwicki\Bundle\ChargifyBundle\Model\Entity\ChargifyInterface;

/**
 * Class Event
 *
 * @package Litwicki\Bundle\ChargifyBundle\Entity
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 * @orm\Table(name="ChargifyEvent")
 */
class Event extends ChargifyEntity implements ChargifyInterface
{

    /**
     * All Event objects are READ ONLY, so we have deliberately not allowed setters,
     * and have also made all properties private so nobody mistakenly attempts to
     * create a new Event and do something with it.
     * @see: https://docs.chargify.com/api-events
     */

    /**
     * Read only properties
     */
    protected $id;

    /**
     * @type
     */
    protected $key;

    /**
     * @type
     */
    protected $message;

    /**
     * @type
     */
    protected $subscription_id;

    /**
     * @type
     */
    protected $event_specific_date;

    /**
     * @type
     */
    protected $created_at;


    /**
     * Read/Write properties.
     */
    protected $payment_success;

    /**
     * @type
     */
    protected $payment_failure;

    /**
     * @type
     */
    protected $signup_success;

    /**
     * @type
     */
    protected $signup_failure;

    /**
     * @type
     */
    protected $billing_date_change;

    /**
     * @type
     */
    protected $renewal_success;

    /**
     * @type
     */
    protected $renewal_failure;

    /**
     * @type
     */
    protected $subscription_state_change;

    /**
     * @type
     */
    protected $subscription_product_change;

    /**
     * @type
     */
    protected $expiring_card;

    /**
     * @type
     */
    protected $customer_update;

    /**
     * @type
     */
    protected $renewal_success_recreated;

    /**
     * @type
     */
    protected $renewal_failure_recreated;

    /**
     * @type
     */
    protected $payment_success_recreated;

    /**
     * @type
     */
    protected $payment_failure_recreated;


    /**
     * Zferral fields
     */

    /**
     * @type
     */
    protected $zferral_revenue_post_success;

    /**
     * @type
     */
    protected $zferral_revenue_post_failure;

    /**
     * @return mixed
     */
    public function getBillingDateChange()
    {
        return $this->billing_date_change;
    }

    /**
     * @return mixed
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * @return mixed
     */
    public function getCustomerUpdate()
    {
        return $this->customer_update;
    }

    /**
     * @return mixed
     */
    public function getEventSpecificDate()
    {
        return $this->event_specific_date;
    }

    /**
     * @return mixed
     */
    public function getExpiringCard()
    {
        return $this->expiring_card;
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
    public function getKey()
    {
        return $this->key;
    }

    /**
     * @return mixed
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @return mixed
     */
    public function getPaymentFailure()
    {
        return $this->payment_failure;
    }

    /**
     * @return mixed
     */
    public function getPaymentFailureRecreated()
    {
        return $this->payment_failure_recreated;
    }

    /**
     * @return mixed
     */
    public function getPaymentSuccess()
    {
        return $this->payment_success;
    }

    /**
     * @return mixed
     */
    public function getPaymentSuccessRecreated()
    {
        return $this->payment_success_recreated;
    }

    /**
     * @return mixed
     */
    public function getRenewalFailure()
    {
        return $this->renewal_failure;
    }

    /**
     * @return mixed
     */
    public function getRenewalFailureRecreated()
    {
        return $this->renewal_failure_recreated;
    }

    /**
     * @return mixed
     */
    public function getRenewalSuccess()
    {
        return $this->renewal_success;
    }

    /**
     * @return mixed
     */
    public function getRenewalSuccessRecreated()
    {
        return $this->renewal_success_recreated;
    }

    /**
     * @return mixed
     */
    public function getSignupFailure()
    {
        return $this->signup_failure;
    }

    /**
     * @return mixed
     */
    public function getSignupSuccess()
    {
        return $this->signup_success;
    }

    /**
     * @return mixed
     */
    public function getSubscriptionId()
    {
        return $this->subscription_id;
    }

    /**
     * @return mixed
     */
    public function getSubscriptionProductChange()
    {
        return $this->subscription_product_change;
    }

    /**
     * @return mixed
     */
    public function getSubscriptionStateChange()
    {
        return $this->subscription_state_change;
    }

    /**
     * @return mixed
     */
    public function getZferralRevenuePostFailure()
    {
        return $this->zferral_revenue_post_failure;
    }

    /**
     * @return mixed
     */
    public function getZferralRevenuePostSuccess()
    {
        return $this->zferral_revenue_post_success;
    }

}