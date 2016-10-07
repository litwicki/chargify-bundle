<?php

namespace Litwicki\Bundle\ChargifyBundle\Model;

use Litwicki\Bundle\ChargifyBundle\Services\ChargifyModel;
use Litwicki\Bundle\ChargifyBundle\Services\ChargifyInterface;

/**
 * Class Statement
 *
 * @package ChargifyBundle\Model
 */
class Statement extends ChargifyModel implements ChargifyInterface
{
    /**
     * @type int
     * The unique identifier for this statement within Chargify
     */
    protected $id;

    /**
     * @type int
     *  The unique identifier of the subscription associated with the statement
     */
    protected $subscription_id;

    /**
     * @type datetime
     *  The date that the statement was opened
     */
    protected $opened_at;

    /**
     * @type datetime
     *  The date that the statement was closed
     */
    protected $closed_at;

    /**
     * @type datetime
     *  The date that the statement was settled
     */
    protected $settled_at;

    /**
     * @type string
     *  A text representation of the statement
     */
    protected $text_view;

    /**
     * @type string
     *  A simple HTML representation of the statement
     */
    protected $basic_html_view;

    /**
     * @type string
     *  A more robust HTML representation of the statement
     */
    protected $html_view;

    /**
     * @type array
     * @TODO: something with this data type.
     *  A collection of payments from future statements that pay charges on this statement
     */
    protected $future_payments;

    /**
     * @type int
     *  The subscription’s balance at the time the statement was opened
     */
    protected $starting_balance_in_cents;

    /**
     * @type int
     *  The subscription’s balance at the time the statement was closed
     */
    protected $ending_balance_in_cents;

    /**
     * @type int
     *  The total amount billed
     */
    protected $total_in_cents;

    /**
     * @type string
     *  The customer’s first name
     */
    protected $customer_first_name;

    /**
     * @type string
     *  The customer’s last name
     */
    protected $customer_last_name;

    /**
     * @type string
     *  The customer’s organization
     */
    protected $customer_organization;

    /**
     * @type string
     *  The customer’s shipping address
     */
    protected $customer_shipping_address;

    /**
     * @type string
     *  The customer’s shipping address, line 2
     */
    protected $customer_shipping_address_2;

    /**
     * @type string
     *  The customer’s shipping city
     */
    protected $customer_shipping_city;

    /**
     * @type string
     *  The customer’s shipping state
     */
    protected $customer_shipping_state;

    /**
     * @type string
     *  The customer’s shipping country
     */
    protected $customer_shipping_country;

    /**
     * @type int
     *  The customer’s shipping zip
     */
    protected $customer_shipping_zip;

    /**
     * @type string
     *  The customer’s billing address
     */
    protected $customer_billing_address;

    /**
     * @type string
     *  The customer’s billing address, line 2
     */
    protected $customer_billing_address_2;

    /**
     * @type string
     *  The customer’s billing city
     */
    protected $customer_billing_city;

    /**
     * @type string
     *  The customer’s billing state
     */
    protected $customer_billing_state;

    /**
     * @type string
     *  The customer’s billing country
     */
    protected $customer_billing_country;

    /**
     * @type int
     *  The customer’s billing zip
     */
    protected $customer_billing_zip;

    /**
     * @type array
     * @TODO: this data type
     *       A collection of the transaction objects associated with the statement
     */
    protected $transactions;

    /**
     * @type array
     * @TODO: this data type
     *       A collection of the event objects associated with the statement
     */
    protected $events;

    /**
     * @type datetime
     *  The creation date for this statement
     */
    protected $created_at;

    /**
     * @type datetime;
     */
    protected $updated_at;

    /**
     * @return string
     */
    public function getBasicHtmlView()
    {
        return $this->basic_html_view;
    }

    /**
     * @param string $basic_html_view
     */
    public function setBasicHtmlView($basic_html_view)
    {
        $this->basic_html_view = $basic_html_view;
    }

    /**
     * @return datetime
     */
    public function getClosedAt()
    {
        return $this->closed_at;
    }

    /**
     * @param datetime $closed_at
     */
    public function setClosedAt($closed_at)
    {
        $this->closed_at = $closed_at;
    }

    /**
     * @return datetime
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * @param datetime $created_at
     */
    public function setCreatedAt($created_at)
    {
        $this->created_at = $created_at;
    }

    /**
     * @return string
     */
    public function getCustomerBillingAddress()
    {
        return $this->customer_billing_address;
    }

    /**
     * @param string $customer_billing_address
     */
    public function setCustomerBillingAddress($customer_billing_address)
    {
        $this->customer_billing_address = $customer_billing_address;
    }

    /**
     * @return string
     */
    public function getCustomerBillingAddress2()
    {
        return $this->customer_billing_address_2;
    }

    /**
     * @param string $customer_billing_address_2
     */
    public function setCustomerBillingAddress2($customer_billing_address_2)
    {
        $this->customer_billing_address_2 = $customer_billing_address_2;
    }

    /**
     * @return string
     */
    public function getCustomerBillingCity()
    {
        return $this->customer_billing_city;
    }

    /**
     * @param string $customer_billing_city
     */
    public function setCustomerBillingCity($customer_billing_city)
    {
        $this->customer_billing_city = $customer_billing_city;
    }

    /**
     * @return string
     */
    public function getCustomerBillingCountry()
    {
        return $this->customer_billing_country;
    }

    /**
     * @param string $customer_billing_country
     */
    public function setCustomerBillingCountry($customer_billing_country)
    {
        $this->customer_billing_country = $customer_billing_country;
    }

    /**
     * @return string
     */
    public function getCustomerBillingState()
    {
        return $this->customer_billing_state;
    }

    /**
     * @param string $customer_billing_state
     */
    public function setCustomerBillingState($customer_billing_state)
    {
        $this->customer_billing_state = $customer_billing_state;
    }

    /**
     * @return int
     */
    public function getCustomerBillingZip()
    {
        return $this->customer_billing_zip;
    }

    /**
     * @param int $customer_billing_zip
     */
    public function setCustomerBillingZip($customer_billing_zip)
    {
        $this->customer_billing_zip = $customer_billing_zip;
    }

    /**
     * @return string
     */
    public function getCustomerFirstName()
    {
        return $this->customer_first_name;
    }

    /**
     * @param string $customer_first_name
     */
    public function setCustomerFirstName($customer_first_name)
    {
        $this->customer_first_name = $customer_first_name;
    }

    /**
     * @return string
     */
    public function getCustomerLastName()
    {
        return $this->customer_last_name;
    }

    /**
     * @param string $customer_last_name
     */
    public function setCustomerLastName($customer_last_name)
    {
        $this->customer_last_name = $customer_last_name;
    }

    /**
     * @return string
     */
    public function getCustomerOrganization()
    {
        return $this->customer_organization;
    }

    /**
     * @param string $customer_organization
     */
    public function setCustomerOrganization($customer_organization)
    {
        $this->customer_organization = $customer_organization;
    }

    /**
     * @return string
     */
    public function getCustomerShippingAddress()
    {
        return $this->customer_shipping_address;
    }

    /**
     * @param string $customer_shipping_address
     */
    public function setCustomerShippingAddress($customer_shipping_address)
    {
        $this->customer_shipping_address = $customer_shipping_address;
    }

    /**
     * @return string
     */
    public function getCustomerShippingAddress2()
    {
        return $this->customer_shipping_address_2;
    }

    /**
     * @param string $customer_shipping_address_2
     */
    public function setCustomerShippingAddress2($customer_shipping_address_2)
    {
        $this->customer_shipping_address_2 = $customer_shipping_address_2;
    }

    /**
     * @return string
     */
    public function getCustomerShippingCity()
    {
        return $this->customer_shipping_city;
    }

    /**
     * @param string $customer_shipping_city
     */
    public function setCustomerShippingCity($customer_shipping_city)
    {
        $this->customer_shipping_city = $customer_shipping_city;
    }

    /**
     * @return string
     */
    public function getCustomerShippingCountry()
    {
        return $this->customer_shipping_country;
    }

    /**
     * @param string $customer_shipping_country
     */
    public function setCustomerShippingCountry($customer_shipping_country)
    {
        $this->customer_shipping_country = $customer_shipping_country;
    }

    /**
     * @return string
     */
    public function getCustomerShippingState()
    {
        return $this->customer_shipping_state;
    }

    /**
     * @param string $customer_shipping_state
     */
    public function setCustomerShippingState($customer_shipping_state)
    {
        $this->customer_shipping_state = $customer_shipping_state;
    }

    /**
     * @return int
     */
    public function getCustomerShippingZip()
    {
        return $this->customer_shipping_zip;
    }

    /**
     * @param int $customer_shipping_zip
     */
    public function setCustomerShippingZip($customer_shipping_zip)
    {
        $this->customer_shipping_zip = $customer_shipping_zip;
    }

    /**
     * @return int
     */
    public function getEndingBalanceInCents()
    {
        return $this->ending_balance_in_cents;
    }

    /**
     * @param int $ending_balance_in_cents
     */
    public function setEndingBalanceInCents($ending_balance_in_cents)
    {
        $this->ending_balance_in_cents = $ending_balance_in_cents;
    }

    /**
     * @return array
     */
    public function getEvents()
    {
        return $this->events;
    }

    /**
     * @param array $events
     */
    public function setEvents($events)
    {
        $this->events = $events;
    }

    /**
     * @return array
     */
    public function getFuturePayments()
    {
        return $this->future_payments;
    }

    /**
     * @param array $future_payments
     */
    public function setFuturePayments($future_payments)
    {
        $this->future_payments = $future_payments;
    }

    /**
     * @return string
     */
    public function getHtmlView()
    {
        return $this->html_view;
    }

    /**
     * @param string $html_view
     */
    public function setHtmlView($html_view)
    {
        $this->html_view = $html_view;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return datetime
     */
    public function getOpenedAt()
    {
        return $this->opened_at;
    }

    /**
     * @param datetime $opened_at
     */
    public function setOpenedAt($opened_at)
    {
        $this->opened_at = $opened_at;
    }

    /**
     * @return datetime
     */
    public function getSettledAt()
    {
        return $this->settled_at;
    }

    /**
     * @param datetime $settled_at
     */
    public function setSettledAt($settled_at)
    {
        $this->settled_at = $settled_at;
    }

    /**
     * @return int
     */
    public function getStartingBalanceInCents()
    {
        return $this->starting_balance_in_cents;
    }

    /**
     * @param int $starting_balance_in_cents
     */
    public function setStartingBalanceInCents($starting_balance_in_cents)
    {
        $this->starting_balance_in_cents = $starting_balance_in_cents;
    }

    /**
     * @return int
     */
    public function getSubscriptionId()
    {
        return $this->subscription_id;
    }

    /**
     * @param int $subscription_id
     */
    public function setSubscriptionId($subscription_id)
    {
        $this->subscription_id = $subscription_id;
    }

    /**
     * @return string
     */
    public function getTextView()
    {
        return $this->text_view;
    }

    /**
     * @param string $text_view
     */
    public function setTextView($text_view)
    {
        $this->text_view = $text_view;
    }

    /**
     * @return int
     */
    public function getTotalInCents()
    {
        return $this->total_in_cents;
    }

    /**
     * @param int $total_in_cents
     */
    public function setTotalInCents($total_in_cents)
    {
        $this->total_in_cents = $total_in_cents;
    }

    /**
     * @return array
     */
    public function getTransactions()
    {
        return $this->transactions;
    }

    /**
     * @param array $transactions
     */
    public function setTransactions($transactions)
    {
        $this->transactions = $transactions;
    }

    /**
     * @return datetime
     */
    public function getUpdatedAt()
    {
        return $this->updated_at;
    }

    /**
     * @param datetime $updated_at
     */
    public function setUpdatedAt($updated_at)
    {
        $this->updated_at = $updated_at;
    }
}