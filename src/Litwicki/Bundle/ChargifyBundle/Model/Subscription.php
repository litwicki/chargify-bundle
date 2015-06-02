<?php

namespace Litwicki\Bundle\ChargifyBundle\Model;

use Litwicki\Bundle\ChargifyBundle\Services\ChargifyModel;
use Litwicki\Bundle\ChargifyBundle\Services\ChargifyInterface;

class Subscription extends ChargifyModel implements ChargifyInterface
{

    product_handle The API Handle of the product for which you are creating a subscription. Required, unless a product_id is given instead.
    product_id The Product ID of the product for which you are creating a subscription. The product ID is not currently published, so we recommend using the API Handle instead.
    customer_id The ID of an existing customer within Chargify. Required, unless a customer_reference or a set of customer_attributes is given.
    customer_reference The reference value (provided by your app) of an existing customer within Chargify. Required, unless a customer_id or a set of customer_attributes is given.
    customer_attributes
        first_name The first name of the customer. Required when creating a customer via attributes.
        last_name The last name of the customer. Required when creating a customer via attributes.
        email The email address of the customer. Required when creating a customer via attributes.
        organization The organization/company of the customer. Optional.
        reference A customer “reference”, or unique identifier from your app, stored in Chargify. Can be used so that you may reference your customer’s within Chargify using the same unique value you use in your application. Optional.
        address (Optional) The customer’s shipping street address (i.e. “123 Main St.”).
        address_2 (Optional) Second line of the customer’s shipping address i.e. “Apt. 100”
        city (Optional) The customer’s shipping address city (i.e. “Boston”).
        state (Optional) The customer’s shipping address state (i.e. “MA”)
        zip (Optional) The customer’s shipping address zip code (i.e. “12345”).
        country (Optional) The customer shipping address country, perferably in ISO 3166-1 alpha-2 format (i.e. “US”).
        phone (Optional) The phone number of the customer.
    payment_profile_id The Payment Profile ID of an existing card or bank account, which belongs to an existing customer to use for payment for this subscription. If the card, bank account, or customer does not exist already, or if you want to use a new (unstored) card or bank account for the subscription, use payment_profile_attributes instead to create a new payment profile along with the subscription. (This value is available on an existing subscription via the API as credit_card > id or bank_account > id)
    payment_profile_attributes (this may also be referred to as credit_card_attributes or bank_account_attributes)
        first_name (Optional) First name on card or bank account. If omitted, the first_name from customer attributes will be used.
        last_name (Optional) Last name on card or bank account. If omitted, the last_name from customer attributes will be used.
        full_number The full credit card number (string representation, i.e. “5424000000000015”)
        expiration_month (Optional when performing a Subscription Import via `vault_token`, required otherwise) The 1- or 2-digit credit card expiration month, as an integer or string, i.e. “5”
        expiration_year (Optional when performing a Subscription Import via `vault_token`, required otherwise) The 4-digit credit card expiration year, as an integer or string, i.e. “2012”
        cvv (Optional, may be required by your gateway settings) The 3- or 4-digit Card Verification Value. This value is merely passed through to the payment gateway.
        billing_address (Optional, may be required by your product configuration or gateway settings) The credit card or bank account billing street address (i.e. “123 Main St.”). This value is merely passed through to the payment gateway.
        billing_address_2 (Optional) Second line of the customer’s billing address i.e. “Apt. 100”
        billing_city (Optional, may be required by your product configuration or gateway settings) The credit card or bank account billing address city (i.e. “Boston”). This value is merely passed through to the payment gateway.
        billing_state (Optional, may be required by your product configuration or gateway settings) The credit card or bank account billing address state (i.e. “MA”). This value is merely passed through to the payment gateway.
        billing_zip (Optional, may be required by your product configuration or gateway settings) The credit card or bank account billing address zip code (i.e. “12345”). This value is merely passed through to the payment gateway.
        billing_country (Optional, may be required by your product configuration or gateway settings) The credit card or bank account billing address country, preferably in ISO 3166-1 alpha-2 format (i.e. “US”). This value is merely passed through to the payment gateway. Some gateways require country codes in a specific format. Please check your gateway’s documentation. If creating an ACH subscription, only US is supported at this time.
        vault_token (Optional, used only for Subscription Import) The “token” provided by your vault storage for an already stored payment profile
        customer_vault_token (Optional, used only for Subscription Import) (only for Authorize.Net CIM storage) The customerProfileId for the owner of the customerPaymentProfileId provided as the vault_token
        current_vault (Optional, used only for Subscription Import) The vault that stores the payment profile with the provided vault_token. May be authorizenet, trust_commerce, payment_express, beanstream, braintree1, braintree_blue, paypal, quickpay, eway, samurai, stripe, or wirecard
        last_four (Optional, used only for Subscription Import) If you have the last 4 digits of the credit card number, you may supply them here so that we may create a masked card number (i.e. ‘XXXX-XXXX-XXXX-1234’) for display in the UI
        card_type (Optional, used only for Subscription Import) If you know the card type (i.e. Visa, MC, etc) you may supply it here so that we may display the card type in the UI. May be visa, master, discover, american_express, diners_club, jcb, switch, solo, dankort, maestro, forbrugsforeningen, or laser
    bank_name (Required when creating a subscription with ACH) The name of the bank where the customer’s account resides
        bank_routing_number (Required when creating a subscription with ACH) The routing number of the bank
        bank_account_number (Required when creating a subscription with ACH) The customer’s bank account number
        bank_account_type (Required when creating a subscription with ACH) Either checking or savings
        bank_account_holder_type (Required when creating a subscription with ACH) Either personal or business
        cancellation_message (Optional) Can be used when canceling a subscription (via the HTTP DELETE method) to make a note about the reason for cancellation.
        next_billing_at (Optional) Set this attribute to a future date/time to sync imported subscriptions to your existing renewal schedule. See the notes on “Date/Time Format” below. If you provide a next_billing_at timestamp that is in the future, no trial or initial charges will be applied when you create the subscription. In fact, no payment will be captured at all. The first payment will be captured, according to the prices defined by the product, near the time specified by next_billing_at. If you do not provide a value for next_billing_at, any trial and/or initial charges will be assessed and charged at the time of subscription creation. If the card cannot be successfully charged, the subscription will not be created. See further notes in the section on Importing Subscriptions.
        expiration_tracks_next_billing_change (Optional, default false) When set to true, and when next_billing_at is present, if the subscription expires, the expires_at will be shifted by the same amount of time as the difference between the old and new “next billing” dates.
        vat_number (Optional) Supplying the VAT number allows EU customer’s to opt-out of the Value Added Tax assuming the merchant address and customer billing address are not within the same EU country.
        coupon_code (Optional) The coupon code of the coupon to apply (See the coupon docs)
        payment_collection_method (Optional) The type of payment collection to be used in the subscription. May be automatic, or invoice.
    agreement_terms (Optional but recommended when creating a subscription with ACH) The ACH agreements terms.
    product_change_delayed (Optional, used only for Delayed Product Change) When set to true, indicates that a changed value for product_handle should schedule the product change to the next subscription renewal.
    calendar_billing (optional, see Calendar Billing for more details). Cannot be used when also specifying next_billing_at
    snap_day A value between 1 and 28, or “end”
    ref A valid referral code. (optional, see Referrals for more details).
    components (Optional) An array of component ids and quantities to be added to the subscription. See API Quantity Component Allocations for more information.

Subscription Output Attributes

    The following attributes are returned on a subscription read/list operation.

    activated_at (Read Only) Timestamp for when the subscription began (i.e. when it came out of trial, or when it began in the case of no trial)
    balance_in_cents Gives the current outstanding subscription balance in the number of cents.
    cancel_at_end_of_period Whether or not the subscription will (or has) canceled at the end of the period.
    canceled_at The timestamp of the most recent cancellation
    cancellation_message Seller-provided reason for, or note about, the cancellation.
    coupon_code The coupon code of the coupon currently applied to the subscription
    created_at The creation date for this subscription
    credit_card Nested credit card attributes, if payment profile is a credit_card
        billing_address The current billing street address for the card
        billing_address_2 The current billing street address, second line, for the card
        billing_city The current billing address city for the card
        billing_state The current billing address state for the card
        billing_zip The current billing address zip code for the card
        billing_country The current billing address country for the card
        card_type The type of card used (bogus, visa, master, discover, american_express, diners_club, jcb, switch, solo, dankort, maestro, forbrugsforeningen, or laser)
    current_vault The vault that stores the payment profile with the provided vault_token. May be authorizenet, trust_commerce, payment_express, beanstream, braintree1, braintree_blue, paypal, quickpay, eway, samurai, stripe, or wirecard
    customer_id The Chargify-assigned id for the customer record to which the card belongs
    customer_vault_token (only for Authorize.Net CIM storage): the customerProfileId for the owner of the customerPaymentProfileId provided as the vault_token
    expiration_month An integer representing the expiration month of the card(1 – 12)
    expiration_year An integer representing the 4-digit expiration year of the card(i.e. ‘2012’)
    id The Chargify-assigned ID of the stored card. This value can be used as an input to payment_profile_id when creating a subscription, in order to re-use a stored payment profile for the same customer
    first_name The first name of the card holder
    last_name The last name of the card holder
    masked_card_number A string representation of the credit card number with all but the last 4 digits masked with X’s (i.e. ‘XXXX-XXXX-XXXX-1234’)
    vault_token The “token” provided by your vault storage for an already stored payment profile
    bank_account Nested bank account attributes, if payment profile is a bank_account
        bank_account_holder_type Either business or personal
        bank_account_type Either checking or savings
        bank_name The bank where the account resides
        billing_address The current billing street address for the bank account
        billing_address_2 The current billing street address, second line, for the bank account
        billing_city The current billing address city for the bank account
        billing_state The current billing address state for the bank account
        billing_zip The current billing address zip code for the bank account
        billing_country The current billing address country for the bank account
        current_vault The vault that stores the payment profile with the provided vault_token. As of this time, will only be authorizenet
    customer_id The Chargify-assigned id for the customer record to which the bank account belongs
    customer_vault_token (only for Authorize.Net CIM storage): the customerProfileId for the owner of the customerPaymentProfileId provided as the vault_token
    first_name The first name of the bank account holder
    last_name The last name of the bank account holder
    id The Chargify-assigned ID of the stored bank account. This value can be used as an input to payment_profile_id when creating a subscription, in order to re-use a stored payment profile for the same customer
    masked_bank_account_number A string representation of the stored bank account number with all but the last 4 digits marked with X’s (i.e. ‘XXXXXXX1111’)
    masked_bank_routing_number A string representation of the stored bank routing number with all but the last 4 digits marked with X’s (i.e. ‘XXXXXXX1111’)
    payment_type Will be bank_account
    vault_token The “token” provided by your vault storage for an already stored payment profile
    current_period_started_at Timestamp relating to the start of the current (recurring) period
    current_period_ends_at Timestamp relating to the end of the current (recurring) period (i.e. when the next regularly scheduled attempted charge will occur)
    customer For customer attributes, see Customers API
    delayed_cancel_at Timestamp for when the subscription is currently set to cancel.
    expires_at Timestamp giving the expiration date of this subscription (if any)
    id The subscription unique id within Chargify.
    next_assessment_at Timestamp that indicates when capture of payment will be tried or retried. This value will usually track the current_period_ends_at, but will diverge if a renewal payment fails and must be retried. In that case, the current_period_ends_at will advance to the end of the next period (time doesn’t stop because a payment was missed) but the next_assessment_at will be scheduled for the auto-retry time (i.e. 24 hours in the future, in some cases)
    payment_collection_method The type of payment collection to be used in the subscription. May be automatic, or invoice.
    previous_state Only valid for webhook payloads The previous state for webhooks that have indicated a change in state. For normal API calls, this will always be the same as the state (current state)
    product For product attributes, see Products API
    product_price_in_cents (Added Nov 5 2013) The recurring amount of the product (and version) currently subscribed. NOTE: this may differ from the current price of the product, if you’ve changed the price of the product but haven’t moved this subscription to a newer version.
    product_version_number (Added Nov 5 2013) The version of the product currently subscribed. NOTE: we have not exposed versions (yet) elsewhere in the API, but if you change the price of your product the versions will increment and existing subscriptions will remain on prior versions (by default, to support price grandfathering).
    signup_payment_id The ID of the transaction that generated the revenue
    signup_revenue The revenue, formatted as a string of decimal separated dollars and cents, from the subscription signup ($50.00 would be formatted as 50.00)
    state The current state of the subscription. Please see the documentation for Subscription States
    total_revenue_in_cents Gives the total revenue from the subscription in the number of cents.
    trial_started_at Timestamp for when the trial period (if any) began
    trial_ended_at Timestamp for when the trial period (if any) ended
    updated_at The date of last update for this subscription
    next_product_id If a delayed product change is scheduled, the ID of the product that the subscription will be changed to at the next renewal.

}