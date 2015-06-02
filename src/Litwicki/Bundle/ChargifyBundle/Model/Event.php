<?php

namespace Litwicki\Bundle\ChargifyBundle\Model;

use Litwicki\Bundle\ChargifyBundle\Services\ChargifyModel;
use Litwicki\Bundle\ChargifyBundle\Services\ChargifyInterface;

class Event extends ChargifyModel implements ChargifyInterface
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
    private $id;

    /**
     * @type
     */
    private $key;

    /**
     * @type
     */
    private $message;

    /**
     * @type
     */
    private $subscription_id;

    /**
     * @type
     */
    private $event_specific_date;

    /**
     * @type
     */
    private $created_at;


    /**
     * Read/Write properties.
     */
    private $payment_success;

    /**
     * @type
     */
    private $payment_failure;

    /**
     * @type
     */
    private $signup_success;

    /**
     * @type
     */
    private $signup_failure;

    /**
     * @type
     */
    private $billing_date_change;

    /**
     * @type
     */
    private $renewal_success;

    /**
     * @type
     */
    private $renewal_failure;

    /**
     * @type
     */
    private $subscription_state_change;

    /**
     * @type
     */
    private $subscription_product_change;

    /**
     * @type
     */
    private $expiring_card;

    /**
     * @type
     */
    private $customer_update;

    /**
     * @type
     */
    private $renewal_success_recreated;

    /**
     * @type
     */
    private $renewal_failure_recreated;

    /**
     * @type
     */
    private $payment_success_recreated;

    /**
     * @type
     */
    private $payment_failure_recreated;


    /**
     * Zferral fields
     */

    /**
     * @type
     */
    private $zferral_revenue_post_success;

    /**
     * @type
     */
    private $zferral_revenue_post_failure;

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