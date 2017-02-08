<?php

namespace Litwicki\Bundle\ChargifyBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use Litwicki\Common;
use Litwicki\Bundle\ChargifyBundle\Model\Entity\ChargifyEntity;
use Litwicki\Bundle\ChargifyBundle\Model\Entity\ChargifyInterface;

/**
 * Class PaymentProfile
 *
 * @package Litwicki\Bundle\ChargifyBundle\Entity
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 * @orm\Table(name="ChargifyPaymentProfile")
 */
class PaymentProfile extends ChargifyEntity implements ChargifyInterface
{
    /**
     * @type string
     * (Optional) Default is credit_card. May be bank_account or credit_card.
     */
    protected $payment_type;

    /**
     * @type int
     *  (Required when creating a new payment profile) The Chargify customer id.
     */
    protected $customer_id;

    /**
     * @type string
     *  First name on card or bank account.
     */
    protected $first_name;

    /**
     * @type string
     *  Last name on card or bank account.
     */
    protected $last_name;

    /**
     * @type int
     *  The full credit card number (string representation, i.e. “5424000000000015”)
     */
    protected $full_number;

    /**
     * @type int
     *  The 1- or 2-digit credit card expiration month, as an integer or string, i.e. “5”
     */
    protected $expiration_month;

    /**
     * @type int
     *  The 4-digit credit card expiration year, as an integer or string, i.e. “2012”
     */
    protected $expiration_year;

    /**
     * @type int
     *  (Optional, may be required by your gateway settings) The 3- or 4-digit Card Verification Value.
     * This value is merely passed through to the payment gateway.
     */
    protected $cvv;

    /**
     * @type string
     *  (Optional, may be required by your product configuration or gateway settings)
     * The credit card or bank account billing street address (i.e. “123 Main St.”).
     * This value is merely passed through to the payment gateway.
     */
    protected $billing_address;

    /**
     * @type string
     *  (Optional) Second line of the customer’s billing address i.e. “Apt. 100”
     */
    protected $billing_address_2;

    /**
     * @type string
     *  (Optional, may be required by your product configuration or gateway settings)
     * The credit card or bank account billing address city (i.e. “Boston”).
     * This value is merely passed through to the payment gateway.
     */
    protected $billing_city;

    /**
     * @type string
     *  (Optional, may be required by your product configuration or gateway settings)
     * The credit card or bank account billing address state (i.e. “MA”).
     * This value is merely passed through to the payment gateway.
     */
    protected $billing_state;

    /**
     * @type int
     *  (Optional, may be required by your product configuration or gateway settings)
     * The credit card or bank account billing address zip code (i.e. “12345”).
     * This value is merely passed through to the payment gateway.
     */
    protected $billing_zip;

    /**
     * @type string
     *  (Optional, may be required by your product configuration or gateway settings)
     * The credit card or bank account billing address country, preferably in [ISO 3166-1 alpha-2](http://en.wikipedia.org/wiki/ISO_3166-1_alpha-2) format (i.e. “US”).
     * This value is merely passed through to the payment gateway.
     *
     * Some gateways require country codes in a specific format. Please check your gateway’s documentation.
     * If creating an ACH subscription, only US is supported at this time.
     */
    protected $billing_country;

    /**
     * @type string
     *  (Required when creating a subscription with ACH) The name of the bank where the customer’s account resides
     */
    protected $bank_name;

    /**
     * @type string
     *  (Required when creating a subscription with ACH) The routing number of the bank
     */
    protected $bank_routing_number;

    /**
     * @type string
     *  (Required when creating a subscription with ACH) The customer’s bank account number
     */
    protected $bank_account_number;

    /**
     * @type string
     *  When payment_type is bank_account, this defaults to checking and cannot be changed
     */
    protected $bank_account_type;

    /**
     * Default the payment type so Handlers can work appropriately.
     *
     * @param $customer_id
     */
    public function __construct($customer_id)
    {
        $this->customer_id = $customer_id;
    }

    /**
     * @return string
     */
    public function getBankAccountHolderType()
    {
        return $this->bank_account_holder_type;
    }

    /**
     * @param string $bank_account_holder_type
     */
    public function setBankAccountHolderType($bank_account_holder_type)
    {
        $this->bank_account_holder_type = $bank_account_holder_type;
    }

    /**
     * @return string
     */
    public function getBankAccountNumber()
    {
        return $this->bank_account_number;
    }

    /**
     * @param string $bank_account_number
     */
    public function setBankAccountNumber($bank_account_number)
    {
        $this->bank_account_number = $bank_account_number;
    }

    /**
     * @return string
     */
    public function getBankAccountType()
    {
        return $this->bank_account_type;
    }

    /**
     * @param string $bank_account_type
     */
    public function setBankAccountType($bank_account_type)
    {
        $this->bank_account_type = $bank_account_type;
    }

    /**
     * @return string
     */
    public function getBankName()
    {
        return $this->bank_name;
    }

    /**
     * @param string $bank_name
     */
    public function setBankName($bank_name)
    {
        $this->bank_name = $bank_name;
    }

    /**
     * @return string
     */
    public function getBankRoutingNumber()
    {
        return $this->bank_routing_number;
    }

    /**
     * @param string $bank_routing_number
     */
    public function setBankRoutingNumber($bank_routing_number)
    {
        $this->bank_routing_number = $bank_routing_number;
    }

    /**
     * @return string
     */
    public function getBillingAddress()
    {
        return $this->billing_address;
    }

    /**
     * @param string $billing_address
     */
    public function setBillingAddress($billing_address)
    {
        $this->billing_address = $billing_address;
    }

    /**
     * @return string
     */
    public function getBillingAddress2()
    {
        return $this->billing_address_2;
    }

    /**
     * @param string $billing_address_2
     */
    public function setBillingAddress2($billing_address_2)
    {
        $this->billing_address_2 = $billing_address_2;
    }

    /**
     * @return string
     */
    public function getBillingCity()
    {
        return $this->billing_city;
    }

    /**
     * @param string $billing_city
     */
    public function setBillingCity($billing_city)
    {
        $this->billing_city = $billing_city;
    }

    /**
     * @return string
     */
    public function getBillingCountry()
    {
        return $this->billing_country;
    }

    /**
     * @param string $billing_country
     */
    public function setBillingCountry($billing_country)
    {
        $this->billing_country = $billing_country;
    }

    /**
     * @return string
     */
    public function getBillingState()
    {
        return $this->billing_state;
    }

    /**
     * @param string $billing_state
     */
    public function setBillingState($billing_state)
    {
        $this->billing_state = $billing_state;
    }

    /**
     * @return int
     */
    public function getBillingZip()
    {
        return $this->billing_zip;
    }

    /**
     * @param int $billing_zip
     */
    public function setBillingZip($billing_zip)
    {
        $this->billing_zip = $billing_zip;
    }

    /**
     * @return int
     */
    public function getCustomerId()
    {
        return $this->customer_id;
    }

    /**
     * @param int $customer_id
     */
    public function setCustomerId($customer_id)
    {
        $this->customer_id = $customer_id;
    }

    /**
     * @return int
     */
    public function getCvv()
    {
        return $this->cvv;
    }

    /**
     * @param int $cvv
     */
    public function setCvv($cvv)
    {
        $this->cvv = $cvv;
    }

    /**
     * @return int
     */
    public function getExpirationMonth()
    {
        return $this->expiration_month;
    }

    /**
     * @param int $expiration_month
     */
    public function setExpirationMonth($expiration_month)
    {
        $this->expiration_month = $expiration_month;
    }

    /**
     * @return int
     */
    public function getExpirationYear()
    {
        return $this->expiration_year;
    }

    /**
     * @param int $expiration_year
     */
    public function setExpirationYear($expiration_year)
    {
        $this->expiration_year = $expiration_year;
    }

    /**
     * @return string
     */
    public function getFirstName()
    {
        return $this->first_name;
    }

    /**
     * @param string $first_name
     */
    public function setFirstName($first_name)
    {
        $this->first_name = $first_name;
    }

    /**
     * @return int
     */
    public function getFullNumber()
    {
        return $this->full_number;
    }

    /**
     * @param int $full_number
     */
    public function setFullNumber($full_number)
    {
        $this->full_number = $full_number;
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
     * @return string
     */
    public function getLastName()
    {
        return $this->last_name;
    }

    /**
     * @param string $last_name
     */
    public function setLastName($last_name)
    {
        $this->last_name = $last_name;
    }

    /**
     * @return string
     */
    public function getPaymentType()
    {
        return $this->payment_type;
    }

    /**
     * @param string $payment_type
     */
    public function setPaymentType($payment_type)
    {
        $this->payment_type = $payment_type;
    }

    /**
     * @type string
     *  When payment_type is bank_account, this defaults to personal and cannot be changed
     */
    protected $bank_account_holder_type;
}