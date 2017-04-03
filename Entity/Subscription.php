<?php

namespace Litwicki\Bundle\ChargifyBundle\Entity;
use JMS\Serializer\Annotation\Expose;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\Groups;
use Litwicki\Bundle\ChargifyBundle\Entity\Customer;
use Litwicki\Bundle\ChargifyBundle\Entity\PaymentProfile;
use Litwicki\Bundle\ChargifyBundle\Model\Entity\ChargifyEntity;
use Litwicki\Bundle\ChargifyBundle\Model\Entity\ChargifyEntityInterface;

/**
 * Class Subscription
 *
 * @package Litwicki\Bundle\ChargifyBundle\Entity
 */
class Subscription extends ChargifyEntity implements ChargifyEntityInterface
{
    /**
     * @Type("string")
     * @Groups({"api"})
     * @Expose
     * 
     * The API Handle of the product for which you are creating a subscription.
     * Required, unless a product_id is given instead.
     */
    protected $product_handle;

    /**
     * @Type("integer")
     * @Groups({"api"})
     * @Expose
     * 
     * The Product ID of the product for which you are creating a subscription.
     * The product ID is not currently published, so we recommend using the API Handle instead.
     */
    protected $product_id;

    /**
     * @Type("integer")
     * @Groups({"api"})
     * @Expose
     * 
     * The ID of an existing customer within Chargify.
     * Required, unless a customer_reference or a set of customer_attributes is given.
     */
    protected $customer_id;

    /**
     * @Type("Litwicki\Bundle\ChargifyBundle\Entity\Customer")
     */
    protected $customer;

    /**
     * @Type("array")
     *   first_name The first name of the customer. Required when creating a customer via attributes.
     *   last_name The last name of the customer. Required when creating a customer via attributes.
     *   email The email address of the customer. Required when creating a customer via attributes.
     *   organization The organization/company of the customer. Optional.
     *   reference A customer “reference”, or unique identifier from your app, stored in Chargify. Can be used so that you may reference your customer’s within Chargify using the same unique value you use in your application. Optional.
     *   address (Optional) The customer’s shipping street address (i.e. “123 Main St.”).
     *   address_2 (Optional) Second line of the customer’s shipping address i.e. “Apt. 100”
     *   city (Optional) The customer’s shipping address city (i.e. “Boston”).
     *   state (Optional) The customer’s shipping address state (i.e. “MA”)
     *   zip (Optional) The customer’s shipping address zip code (i.e. “12345”).
     *   country (Optional) The customer shipping address country, perferably in ISO 3166-1 alpha-2 format (i.e. “US”).
     *   phone (Optional) The phone number of the customer.
     */
    protected $customer_attributes;

    /**
     * @Type("string")
     * @Groups({"api"})
     * @Expose
     * 
     * The reference value (provided by your app) of an existing customer within Chargify.
     * Required, unless a customer_id or a set of customer_attributes is given.
     */
    protected $customer_reference;

    /**
     * @Type("string")
     * @Groups({"api"})
     * @Expose
     * 
     * The ACH agreements terms.
     * Optional but recommended when creating a subscription with ACH
     */
    protected $agreement_terms;

    /**
     * @Type("boolean")
     * @Groups({"api"})
     * @Expose
     * 
     * When set to true, indicates that a changed value for product_handle
     * should schedule the product change to the next subscription renewal.
     * Optional, used only for Delayed Product Change
     */
    protected $product_change_delayed;

    /**
     * @Type("array")
     * 
     * Cannot be used when also specifying next_billing_at
     * Optional, see Calendar Billing for more details.
     */
    protected $calendar_billing;

    /**
     * @Type("string")
     * @Groups({"api"})
     * @Expose
     * 
     * A value between 1 and 28, or “end”
     */
    protected $snap_day;

    /**
     * @Type("string")
     * @Groups({"api"})
     * @Expose
     */
    protected $ref;

    /**
     * @Type("integer")
     * @Groups({"api"})
     * @Expose
     * 
     * The Payment Profile ID of an existing card or bank account, which belongs to an existing customer to use for payment for this subscription.
     * If the card, bank account, or customer does not exist already, or if you want to use a new (unstored) card or bank account for the subscription,
     * use payment_profile_attributes instead to create a new payment profile along with the subscription. (This value is available on an existing
     * subscription via the API as credit_card > id or bank_account > id)
     */
    protected $payment_profile_id;

    /**
     * @Type("string")
     * @Groups({"api"})
     * @Expose
     * 
     * Supplying the VAT number allows EU customer’s to opt-out of the Value Added Tax assuming the merchant
     * address and customer billing address are not within the same EU country.
     * Optional
     */
    protected $vat_number;

    /**
     * @Type("boolean")
     * @Groups({"api"})
     * @Expose
     * 
     * When set to true, and when next_billing_at is present, if the subscription expires,
     * the expires_at will be shifted by the same amount of time as the difference between the old and new “next billing” dates.
     * Optional, default false
     */
    protected $expiration_tracks_next_billing_change;

    /**
     * @Type("datetime")
     * @Groups({"api"})
     * @Expose
     * 
     * Set this attribute to a future date/time to sync imported subscriptions to your existing renewal schedule.
     * See the notes on “Date/Time Format” below. If you provide a next_billing_at timestamp that is in the future, no trial
     * or initial charges will be applied when you create the subscription. In fact, no payment will be captured at all.
     * The first payment will be captured, according to the prices defined by the product, near the time specified by next_billing_at.
     * If you do not provide a value for next_billing_at, any trial and/or initial charges will be assessed and charged at the time
     * of subscription creation. If the card cannot be successfully charged, the subscription will not be created. See further notes
     * in the section on Importing Subscriptions.
     * Optional
     */
    protected $next_billing_at;

    /** ==================
     *   GETTERS ONLY
     *  ==================*/

    /**
     * @Type("datetime")
     * @Groups({"api"})
     * @Expose
     * 
     * Timestamp for when the subscription began (i.e. when it came out of trial, or when it began in the case of no trial)
     * Read Only
     */
    protected $activated_at;

    /**
     * @Type("integer")
     * @Groups({"api"})
     * @Expose
     *
     * Gives the current outstanding subscription balance in the number of cents.
     */
    protected $balance_in_cents;

    /**
     * @Type("boolean")
     * @Groups({"api"})
     * @Expose
     *
     * Whether or not the subscription will (or has) canceled at the end of the period.
     */
    protected $cancel_at_end_of_period;

    /**
     * @Type("datetime")
     * @Groups({"api"})
     * @Expose
     *
     * The timestamp of the most recent cancellation
     */
    protected $canceled_at;

    /**
     * @Type("string")
     * @Groups({"api"})
     * @Expose
     *
     * Seller-provided reason for, or note about, the cancellation.
     */
    protected $cancellation_message;

    /**
     * @Type("string")
     * @Groups({"api"})
     * @Expose
     *
     * The coupon code of the coupon currently applied to the subscription
     */
    protected $coupon_code;

    /**
     * @Type("datetime")
     * @Groups({"api"})
     * @Expose
     *
     * The creation date for this subscription
     */
    protected $created_at;

    /**
     * @Type("string")
     * @Groups({"api"})
     * @Expose
     *
     * The vault that stores the payment profile with the provided vault_token.
     * May be authorizenet, trust_commerce, payment_express, beanstream, braintree1, braintree_blue, paypal, quickpay, eway, samurai, stripe, or wirecard
     */
    protected $current_vault;

    /**
     * @Type("string")
     * @Groups({"api"})
     * @Expose
     *
     * The customerProfileId for the owner of the customerPaymentProfileId provided as the vault_token
     * only for Authorize.Net CIM storage
     */
    protected $customer_vault_token;

    /**
     * @Type("integer")
     * @Groups({"api"})
     * @Expose
     *
     * An integer representing the expiration month of the card(1 – 12)
     */
    protected $expiration_month;

    /**
     * @Type("integer")
     * @Groups({"api"})
     * @Expose
     * 
     * An integer representing the 4-digit expiration year of the card(i.e. ‘2012’)
     */
    protected $expiration_year;

    /**
     * @Type("string")
     * @Groups({"api"})
     * @Expose
     * 
     * A string representation of the credit card number with all but the last 4 digits masked with X’s (i.e. ‘XXXX-XXXX-XXXX-1234’)
     */
    protected $masked_card_number;

    /**
     * @Type("string")
     * @Groups({"api"})
     * @Expose
     * 
     * The “token” provided by your vault storage for an already stored payment profile
     */
    protected $vault_token;

    /**
     * @Type("string")
     * @Groups({"api"})
     * @Expose
     * 
     * A string representation of the stored bank account number with all but the last 4 digits marked with X’s (i.e. ‘XXXXXXX1111’)
     */
    protected $masked_bank_account_number;

    /**
     * @Type("string")
     * @Groups({"api"})
     * @Expose
     * 
     * A string representation of the stored bank routing number with all but the last 4 digits marked with X’s (i.e. ‘XXXXXXX1111’)
     */
    protected $masked_bank_routing_number;

    /**
     * @Type("string")
     * @Groups({"api"})
     * @Expose
     *
     * Will be bank_account
     */
    protected $payment_type;

    /**
     * @Type("datetime")
     * @Groups({"api"})
     * @Expose
     * 
     * Timestamp relating to the start of the current (recurring) period
     */
    protected $current_period_started_at;

    /**
     * @Type("datetime")
     * @Groups({"api"})
     * @Expose
     * 
     * Timestamp relating to the end of the current (recurring) period (i.e. when the next regularly scheduled attempted charge will occur)
     */
    protected $current_period_ends_at;

    /**
     * @Type("datetime")
     * @Groups({"api"})
     * @Expose
     * 
     * Timestamp for when the subscription is currently set to cancel.
     */
    protected $delayed_cancel_at;

    /**
     * @Type("datetime")
     * @Groups({"api"})
     * @Expose
     * 
     * Timestamp giving the expiration date of this subscription (if any)
     */
    protected $expires_at;

    /**
     * @Type("datetime")
     * @Groups({"api"})
     * @Expose
     * 
     * Timestamp that indicates when capture of payment will be tried or retried.
     * This value will usually track the current_period_ends_at, but will diverge if a renewal payment fails and must be retried.
     * In that case, the current_period_ends_at will advance to the end of the next period (time doesn’t stop because a payment was missed)
     * but the next_assessment_at will be scheduled for the auto-retry time (i.e. 24 hours in the future, in some cases)
     */
    protected $next_assessment_at;

    /**
     * @Type("string")
     * @Groups({"api"})
     * @Expose
     * 
     * The type of payment collection to be used in the subscription. May be automatic, or invoice.
     */
    protected $payment_collection_method;

    /**
     * @Type("string")
     * @Groups({"api"})
     * @Expose
     * 
     * Only valid for webhook payloads The previous state for webhooks that have indicated a change in state.
     * For normal API calls, this will always be the same as the state (current state)
     */
    protected $previous_state;

    /**
     * @Type("integer")
     * @Groups({"api"})
     * @Expose
     * 
     * Added Nov 5 2013
     * The recurring amount of the product (and version) currently subscribed.
     * NOTE: this may differ from the current price of the product, if you’ve changed the price of the product
     * but haven’t moved this subscription to a newer version.
     */
    protected $product_price_in_cents;

    /**
     * @Type("string")
     * @Groups({"api"})
     * @Expose
     * 
     * Added Nov 5 2013
     * The version of the product currently subscribed.
     * NOTE: we have not exposed versions (yet) elsewhere in the API, but if you change the price of your product
     * the versions will increment and existing subscriptions will remain on prior versions (by default, to support price grandfathering).
     */
    protected $product_version_number;

    /**
     * @Type("integer")
     * @Groups({"api"})
     * @Expose
     * 
     * The ID of the transaction that generated the revenue
     */
    protected $signup_payment_id;

    /**
     * @Type("float")
     * @Groups({"api"})
     * @Expose
     * 
     * The revenue, formatted as a string of decimal separated dollars and cents, from the subscription signup ($50.00 would be formatted as 50.00)
     */
    protected $signup_revenue;

    /**
     * @Type("string")
     * @Groups({"api"})
     * @Expose
     * 
     * The current state of the subscription. Please see the documentation for Subscription States
     */
    protected $state;

    /**
     * @Type("integer")
     * @Groups({"api"})
     * @Expose
     * 
     * Gives the total revenue from the subscription in the number of cents.
     */
    protected $total_revenue_in_cents;

    /**
     * @Type("datetime")
     * @Groups({"api"})
     * @Expose
     * 
     * Timestamp for when the trial period (if any) began
     */
    protected $trial_started_at;

    /**
     * @Type("datetime")
     * @Groups({"api"})
     * @Expose
     * 
     * Timestamp for when the trial period (if any) ended
     */
    protected $trial_ended_at;

    /**
     * @Type("datetime")
     * @Groups({"api"})
     * @Expose
     * 
     * The date of last update for this subscription
     */
    protected $updated_at;

    /**
     * @Type("integer")
     * @Groups({"api"})
     * @Expose
     * 
     * If a delayed product change is scheduled, the ID of the product that the subscription will be changed to at the next renewal.
     */
    protected $next_product_id;

    /**
     * @return datetime
     */
    public function getActivatedAt()
    {
        return $this->activated_at;
    }

    /**
     * @return string
     */
    public function getAgreementTerms()
    {
        return $this->agreement_terms;
    }

    /**
     * @return mixed
     */
    public function getBalanceInCents()
    {
        return $this->balance_in_cents;
    }

    /**
     * @return mixed
     */
    public function getCalendarBilling()
    {
        return $this->calendar_billing;
    }

    /**
     * @return mixed
     */
    public function getCancelAtEndOfPeriod()
    {
        return $this->cancel_at_end_of_period;
    }

    /**
     * @return mixed
     */
    public function getCanceledAt()
    {
        return $this->canceled_at;
    }

    /**
     * @return mixed
     */
    public function getCancellationMessage()
    {
        return $this->cancellation_message;
    }

    /**
     * @return collection
     */
    public function getComponents()
    {
        return $this->components;
    }

    /**
     * @return mixed
     */
    public function getCouponCode()
    {
        return $this->coupon_code;
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
    public function getCurrentPeriodEndsAt()
    {
        return $this->current_period_ends_at;
    }

    /**
     * @return mixed
     */
    public function getCurrentPeriodStartedAt()
    {
        return $this->current_period_started_at;
    }

    /**
     * @return mixed
     */
    public function getCurrentVault()
    {
        return $this->current_vault;
    }

    /**
     * @return Customer
     */
    public function getCustomer()
    {
        return $this->customer;
    }

    /**
     * @return array
     */
    public function getCustomerAttributes()
    {
        return $this->customer_attributes;
    }

    /**
     * @return int
     */
    public function getCustomerId()
    {
        return $this->customer_id;
    }

    /**
     * @return mixed
     */
    public function getCustomerReference()
    {
        return $this->customer_reference;
    }

    /**
     * @return mixed
     */
    public function getCustomerVaultToken()
    {
        return $this->customer_vault_token;
    }

    /**
     * @return mixed
     */
    public function getDelayedCancelAt()
    {
        return $this->delayed_cancel_at;
    }

    /**
     * @return mixed
     */
    public function getExpirationMonth()
    {
        return $this->expiration_month;
    }

    /**
     * @return mixed
     */
    public function getExpirationYear()
    {
        return $this->expiration_year;
    }

    /**
     * @return mixed
     */
    public function getExpiresAt()
    {
        return $this->expires_at;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getMaskedBankAccountNumber()
    {
        return $this->masked_bank_account_number;
    }

    /**
     * @return mixed
     */
    public function getMaskedBankRoutingNumber()
    {
        return $this->masked_bank_routing_number;
    }

    /**
     * @return mixed
     */
    public function getMaskedCardNumber()
    {
        return $this->masked_card_number;
    }

    /**
     * @return mixed
     */
    public function getNextAssessmentAt()
    {
        return $this->next_assessment_at;
    }

    /**
     * @return mixed
     */
    public function getNextProductId()
    {
        return $this->next_product_id;
    }

    /**
     * @return mixed
     */
    public function getPaymentCollectionMethod()
    {
        return $this->payment_collection_method;
    }

    /**
     * @return mixed
     */
    public function getPaymentProfileAttributes()
    {
        return $this->payment_profile_attributes;
    }

    /**
     * @return int
     */
    public function getPaymentProfileId()
    {
        return $this->payment_profile_id;
    }

    /**
     * @return mixed
     */
    public function getPaymentType()
    {
        return $this->payment_type;
    }

    /**
     * @return mixed
     */
    public function getPreviousState()
    {
        return $this->previous_state;
    }

    /**
     * @return mixed
     */
    public function getProductChangeDelayed()
    {
        return $this->product_change_delayed;
    }

    /**
     * @return string
     */
    public function getProductHandle()
    {
        return $this->product_handle;
    }

    /**
     * @return int
     */
    public function getProductId()
    {
        return $this->product_id;
    }

    /**
     * @return mixed
     */
    public function getProductPriceInCents()
    {
        return $this->product_price_in_cents;
    }

    /**
     * @return mixed
     */
    public function getProductVersionNumber()
    {
        return $this->product_version_number;
    }

    /**
     * @return mixed
     */
    public function getRef()
    {
        return $this->ref;
    }

    /**
     * @return mixed
     */
    public function getSignupPaymentId()
    {
        return $this->signup_payment_id;
    }

    /**
     * @return mixed
     */
    public function getSignupRevenue()
    {
        return $this->signup_revenue;
    }

    /**
     * @return mixed
     */
    public function getSnapDay()
    {
        return $this->snap_day;
    }

    /**
     * @return mixed
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * @return mixed
     */
    public function getTotalRevenueInCents()
    {
        return $this->total_revenue_in_cents;
    }

    /**
     * @return mixed
     */
    public function getTrialEndedAt()
    {
        return $this->trial_ended_at;
    }

    /**
     * @return mixed
     */
    public function getTrialStartedAt()
    {
        return $this->trial_started_at;
    }

    /**
     * @return mixed
     */
    public function getUpdatedAt()
    {
        return $this->updated_at;
    }

    /**
     * @return mixed
     */
    public function getVaultToken()
    {
        return $this->vault_token;
    }

    /**
     * @param int $product_id
     */
    public function setProductId($product_id)
    {
        $this->product_id = $product_id;
    }

    /**
     * @param string $product_handle
     */
    public function setProductHandle($product_handle)
    {
        $this->product_handle = $product_handle;
    }

    /**
     * @param \Litwicki\Bundle\ChargifyBundle\Entity\Customer $customer
     */
    public function setCustomer(Customer $customer)
    {
        $this->customer = $customer;
    }

    /**
     * @param int $customer_id
     */
    public function setCustomerId($customer_id)
    {
        $this->customer_id = $customer_id;
    }

    /**
     * @param int $payment_profile_id
     */
    public function setPaymentProfileId($payment_profile_id)
    {
        $this->payment_profile_id = $payment_profile_id;
    }

    /**
     * @param \Litwicki\Bundle\ChargifyBundle\Entity\PaymentProfile $payment_profile
     */
    public function setPaymentProfile(PaymentProfile $payment_profile)
    {
        $this->payment_profile = $payment_profile;
    }

    /**
     * @param mixed $ref
     */
    public function setRef($ref)
    {
        $this->ref = $ref;
    }

    /**
     * @param mixed $calendar_billing
     */
    public function setCalendarBilling($calendar_billing)
    {
        $this->calendar_billing = $calendar_billing;
    }

    /**
     * @param mixed $product_change_delayed
     */
    public function setProductChangeDelayed($product_change_delayed)
    {
        $this->product_change_delayed = $product_change_delayed;
    }

    /**
     * @param mixed $payment_collection_method
     */
    public function setPaymentCollectionMethod($payment_collection_method)
    {
        $this->payment_collection_method = $payment_collection_method;
    }

    /**
     * @param mixed $coupon_code
     */
    public function setCouponCode($coupon_code)
    {
        $this->coupon_code = $coupon_code;
    }

    /**
     * @param mixed $cancellation_message
     */
    public function setCancellationMessage($cancellation_message)
    {
        $this->cancellation_message = $cancellation_message;
    }

    /**
     * @param string $agreement_terms
     */
    public function setAgreementTerms($agreement_terms)
    {
        $this->agreement_terms = $agreement_terms;
    }

    /**
     * @param mixed $customer_reference
     */
    public function setCustomerReference($customer_reference)
    {
        $this->customer_reference = $customer_reference;
    }

    /**
     * @param mixed $customer_reference
     */
    public function setCustomerAttributes($customer_attributes)
    {
        $this->customer_attributes = $customer_attributes;
    }

    /**
     * @param mixed $vat_number
     */
    public function setVatNumber($vat_number)
    {
        $this->vat_number = $vat_number;
    }

    /**
     * @param mixed $next_billing_at
     */
    public function setNextBillingAt($next_billing_at)
    {
        $this->next_billing_at = $next_billing_at;
    }

    /**
     * @param mixed $expiration_tracks_next_billing_change
     */
    public function setExpirationTracksNextBillingChange($expiration_tracks_next_billing_change)
    {
        $this->expiration_tracks_next_billing_change = $expiration_tracks_next_billing_change;
    }

}