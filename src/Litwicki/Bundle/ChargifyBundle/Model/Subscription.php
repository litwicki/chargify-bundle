<?php

namespace Litwicki\Bundle\ChargifyBundle\Model;

use Litwicki\Bundle\ChargifyBundle\Model\Customer;
use Litwicki\Bundle\ChargifyBundle\Model\PaymentProfile;

use Litwicki\Bundle\ChargifyBundle\Services\ChargifyModel;
use Litwicki\Bundle\ChargifyBundle\Services\ChargifyInterface;

use Symfony\Component\Serializer;

class Subscription extends ChargifyModel implements ChargifyInterface
{

    /**
     * @type int
     */
    protected $id;

    /**
     * @type string
     * The API Handle of the product for which you are creating a subscription.
     * Required, unless a product_id is given instead.
     */
    protected $product_handle;

    /**
     * @type int
     * The Product ID of the product for which you are creating a subscription.
     * The product ID is not currently published, so we recommend using the API Handle instead.
     */
    protected $product_id;

    /**
     * @type int
     * The ID of an existing customer within Chargify.
     * Required, unless a customer_reference or a set of customer_attributes is given.
     */
    protected $customer_id;

    /**
     * @type \Litwicki\Bundle\ChargifyBundle\Model\Customer
     */
    protected $customer;

    /**
     * @type array
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
     * @type
     * The reference value (provided by your app) of an existing customer within Chargify.
     * Required, unless a customer_id or a set of customer_attributes is given.
     */
    protected $customer_reference;

    /**
     * @type string
     * (Optional but recommended when creating a subscription with ACH) The ACH agreements terms.
     */
    protected $agreement_terms;

    /**
     * @type
     * (Optional, used only for Delayed Product Change) When set to true, indicates that a changed value for product_handle
     * should schedule the product change to the next subscription renewal.
     */
    protected $product_change_delayed;

    /**
     * @type
     * (optional, see Calendar Billing for more details). Cannot be used when also specifying next_billing_at
     */
    protected $calendar_billing;

    /**
     * @type
     * A value between 1 and 28, or “end”
     */
    protected $snap_day;
    protected $ref;

    /**
     * @type int
     * The Payment Profile ID of an existing card or bank account, which belongs to an existing customer to use for payment for this subscription.
     * If the card, bank account, or customer does not exist already, or if you want to use a new (unstored) card or bank account for the subscription,
     * use payment_profile_attributes instead to create a new payment profile along with the subscription. (This value is available on an existing
     * subscription via the API as credit_card > id or bank_account > id)
     */
    protected $payment_profile_id;

    /**
     * @type \Litwicki\Bundle\ChargifyBundle\Model\PaymentProfile
     */
    protected $payment_profile;

    /**
     * @type mixed
     * payment_profile_attributes (this may also be referred to as credit_card_attributes or bank_account_attributes)
     * first_name (Optional) First name on card or bank account. If omitted, the first_name from customer attributes will be used.
     * last_name (Optional) Last name on card or bank account. If omitted, the last_name from customer attributes will be used.
     * full_number The full credit card number (string representation, i.e. “5424000000000015”)
     * expiration_month (Optional when performing a Subscription Import via `vault_token`, required otherwise) The 1- or 2-digit credit card expiration month, as an integer or string, i.e. “5”
     * expiration_year (Optional when performing a Subscription Import via `vault_token`, required otherwise) The 4-digit credit card expiration year, as an integer or string, i.e. “2012”
     * cvv (Optional, may be required by your gateway settings) The 3- or 4-digit Card Verification Value. This value is merely passed through to the payment gateway.
     * billing_address (Optional, may be required by your product configuration or gateway settings) The credit card or bank account billing street address (i.e. “123 Main St.”). This value is merely passed through to the payment gateway.
     * billing_address_2 (Optional) Second line of the customer’s billing address i.e. “Apt. 100”
     * billing_city (Optional, may be required by your product configuration or gateway settings) The credit card or bank account billing address city (i.e. “Boston”). This value is merely passed through to the payment gateway.
     * billing_state (Optional, may be required by your product configuration or gateway settings) The credit card or bank account billing address state (i.e. “MA”). This value is merely passed through to the payment gateway.
     * billing_zip (Optional, may be required by your product configuration or gateway settings) The credit card or bank account billing address zip code (i.e. “12345”). This value is merely passed through to the payment gateway.
     * billing_country (Optional, may be required by your product configuration or gateway settings) The credit card or bank account billing address country, preferably in ISO 3166-1 alpha-2 format (i.e. “US”). This value is merely passed through to the payment gateway. Some gateways require country codes in a specific format. Please check your gateway’s documentation. If creating an ACH subscription, only US is supported at this time.
     * vault_token (Optional, used only for Subscription Import) The “token” provided by your vault storage for an already stored payment profile
     * customer_vault_token (Optional, used only for Subscription Import) (only for Authorize.Net CIM storage) The customerProfileId for the owner of the customerPaymentProfileId provided as the vault_token
     * current_vault (Optional, used only for Subscription Import) The vault that stores the payment profile with the provided vault_token. May be authorizenet, trust_commerce, payment_express, beanstream, braintree1, braintree_blue, paypal, quickpay, eway, samurai, stripe, or wirecard
     * last_four (Optional, used only for Subscription Import) If you have the last 4 digits of the credit card number, you may supply them here so that we may create a masked card number (i.e. ‘XXXX-XXXX-XXXX-1234’) for display in the UI
     * card_type (Optional, used only for Subscription Import) If you know the card type (i.e. Visa, MC, etc) you may supply it here so that we may display the card type in the UI. May be visa, master, discover, american_express, diners_club, jcb, switch, solo, dankort, maestro, forbrugsforeningen, or laser
     * bank_name (Required when creating a subscription with ACH) The name of the bank where the customer’s account resides
     * bank_routing_number (Required when creating a subscription with ACH) The routing number of the bank
     * bank_account_number (Required when creating a subscription with ACH) The customer’s bank account number
     * bank_account_type (Required when creating a subscription with ACH) Either checking or savings
     * bank_account_holder_type (Required when creating a subscription with ACH) Either personal or business
     */
    protected $payment_profile_attributes;

    /**
     * @type collection
     * (Optional) An array of component ids and quantities to be added to the subscription. See API Quantity Component Allocations for more information.
     */
    protected $components;

    /**
     * @type
     * (Optional) Supplying the VAT number allows EU customer’s to opt-out of the Value Added Tax assuming the merchant
     * address and customer billing address are not within the same EU country.
     */
    protected $vat_number;

    /**
     * @type
     * (Optional, default false) When set to true, and when next_billing_at is present, if the subscription expires,
     * the expires_at will be shifted by the same amount of time as the difference between the old and new “next billing” dates.
     */
    protected $expiration_tracks_next_billing_change;

    /**
     * @type
     * (Optional) Set this attribute to a future date/time to sync imported subscriptions to your existing renewal schedule.
     * See the notes on “Date/Time Format” below. If you provide a next_billing_at timestamp that is in the future, no trial
     * or initial charges will be applied when you create the subscription. In fact, no payment will be captured at all.
     * The first payment will be captured, according to the prices defined by the product, near the time specified by next_billing_at.
     * If you do not provide a value for next_billing_at, any trial and/or initial charges will be assessed and charged at the time
     * of subscription creation. If the card cannot be successfully charged, the subscription will not be created. See further notes
     * in the section on Importing Subscriptions.
     */
    protected $next_billing_at;

    /** ==================
     *   GETTERS ONLY
     *  ==================*/

    /**
     * @type datetime
     * (Read Only) Timestamp for when the subscription began (i.e. when it came out of trial, or when it began in the case of no trial)
     */
    protected $activated_at;

    /**
     * @type
     *  Gives the current outstanding subscription balance in the number of cents.
     */
    protected $balance_in_cents;

    /**
     * @type
     * Whether or not the subscription will (or has) canceled at the end of the period.
     */
    protected $cancel_at_end_of_period;

    /**
     * @type
     * The timestamp of the most recent cancellation
     */
    protected $canceled_at;

    /**
     * @type
     * Seller-provided reason for, or note about, the cancellation.
     */
    protected $cancellation_message;

    /**
     * @type
     * The coupon code of the coupon currently applied to the subscription
     */
    protected $coupon_code;

    /**
     * @type
     *  The creation date for this subscription
     */
    protected $created_at;

    /**
     * @type
     *  The vault that stores the payment profile with the provided vault_token.
     * May be authorizenet, trust_commerce, payment_express, beanstream, braintree1, braintree_blue, paypal, quickpay, eway, samurai, stripe, or wirecard
     */
    protected $current_vault;

    /**
     * @type
     *  (only for Authorize.Net CIM storage): the customerProfileId for the owner of the customerPaymentProfileId provided as the vault_token
     */
    protected $customer_vault_token;

    /**
     * @type
     *  An integer representing the expiration month of the card(1 – 12)
     */
    protected $expiration_month;

    /**
     * @type
     *  An integer representing the 4-digit expiration year of the card(i.e. ‘2012’)
     */
    protected $expiration_year;

    /**
     * @type
     *  A string representation of the credit card number with all but the last 4 digits masked with X’s (i.e. ‘XXXX-XXXX-XXXX-1234’)
     */
    protected $masked_card_number;

    /**
     * @type
     *  The “token” provided by your vault storage for an already stored payment profile
     */
    protected $vault_token;

    /**
     * @type
     *  A string representation of the stored bank account number with all but the last 4 digits marked with X’s (i.e. ‘XXXXXXX1111’)
     */
    protected $masked_bank_account_number;

    /**
     * @type
     *  A string representation of the stored bank routing number with all but the last 4 digits marked with X’s (i.e. ‘XXXXXXX1111’)
     */
    protected $masked_bank_routing_number;

    /**
     * @type
     * Will be bank_account
     */
    protected $payment_type;

    /**
     * @type
     *  Timestamp relating to the start of the current (recurring) period
     */
    protected $current_period_started_at;

    /**
     * @type
     *  Timestamp relating to the end of the current (recurring) period (i.e. when the next regularly scheduled attempted charge will occur)
     */
    protected $current_period_ends_at;

    /**
     * @type
     *  Timestamp for when the subscription is currently set to cancel.
     */
    protected $delayed_cancel_at;

    /**
     * @type
     *  Timestamp giving the expiration date of this subscription (if any)
     */
    protected $expires_at;

    /**
     * @type
     *  Timestamp that indicates when capture of payment will be tried or retried.
     * This value will usually track the current_period_ends_at, but will diverge if a renewal payment fails and must be retried.
     * In that case, the current_period_ends_at will advance to the end of the next period (time doesn’t stop because a payment was missed)
     * but the next_assessment_at will be scheduled for the auto-retry time (i.e. 24 hours in the future, in some cases)
     */
    protected $next_assessment_at;

    /**
     * @type
     *  The type of payment collection to be used in the subscription. May be automatic, or invoice.
     */
    protected $payment_collection_method;

    /**
     * @type
     *  Only valid for webhook payloads The previous state for webhooks that have indicated a change in state.
     * For normal API calls, this will always be the same as the state (current state)
     */
    protected $previous_state;

    /**
     * @type
     * (Added Nov 5 2013) The recurring amount of the product (and version) currently subscribed.
     * NOTE: this may differ from the current price of the product, if you’ve changed the price of the product
     * but haven’t moved this subscription to a newer version.
     */
    protected $product_price_in_cents;

    /**
     * @type
     * (Added Nov 5 2013) The version of the product currently subscribed.
     * NOTE: we have not exposed versions (yet) elsewhere in the API, but if you change the price of your product
     * the versions will increment and existing subscriptions will remain on prior versions (by default, to support price grandfathering).
     */
    protected $product_version_number;

    /**
     * @type
     *  The ID of the transaction that generated the revenue
     */
    protected $signup_payment_id;

    /**
     * @type
     *  The revenue, formatted as a string of decimal separated dollars and cents, from the subscription signup ($50.00 would be formatted as 50.00)
     */
    protected $signup_revenue;

    /**
     * @type
     *  The current state of the subscription. Please see the documentation for Subscription States
     */
    protected $state;

    /**
     * @type
     *  Gives the total revenue from the subscription in the number of cents.
     */
    protected $total_revenue_in_cents;

    /**
     * @type
     *  Timestamp for when the trial period (if any) began
     */
    protected $trial_started_at;

    /**
     * @type
     *  Timestamp for when the trial period (if any) ended
     */
    protected $trial_ended_at;

    /**
     * @type
     *  The date of last update for this subscription
     */
    protected $updated_at;

    /**
     * @type
     *  If a delayed product change is scheduled, the ID of the product that the subscription will be changed to at the next renewal.
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
     * @param \Litwicki\Bundle\ChargifyBundle\Model\Customer $customer
     */
    public function setCustomer(Customer $customer)
    {

        $this->customer = $customer;

        /**
         * Convert the Customer object to the customer_attributes array.
         * Unless this is an existing object, then simply pass $customer_id
         */
        if($customer->getId()) {
            $this->customer_id = $customer->getId();
        }
        else {
            $serializer = new Serializer();
            $json = $serializer->serialize($customer, 'json');
            $this->customer_attributes = json_decode($json, true);
        }

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
     * @param \Litwicki\Bundle\ChargifyBundle\Model\PaymentProfile $payment_profile
     */
    public function setPaymentProfile(PaymentProfile $payment_profile)
    {
        /**
         * Convert the PaymentProfile to the payment_profile_attributes array.
         * Unless this is an existing object, then simply pass $payment_profile_id
         */
        $this->payment_profile = $payment_profile;

        /**
         * Convert the Customer object to the customer_attributes array.
         * Unless this is an existing object, then simply pass $customer_id
         */
        if($payment_profile->getId()) {
            $this->payment_profile_id = $payment_profile->getId();
        }
        else {
            $serializer = new Serializer();
            $json = $serializer->serialize($payment_profile, 'json');
            $this->payment_profile_attributes = json_decode($json, true);
        }
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