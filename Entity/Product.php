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
 * Class Product
 *
 * @package Litwicki\Bundle\ChargifyBundle\Entity
 */
class Product extends ChargifyEntity implements ChargifyEntityInterface
{

    /**
     * @Type("integer")
	 * @Groups({"api"})
	 * @Expose
     *  The product price, in integer cents
     */
    protected $price_in_cents;

    /**
     * @Type("string")
	 * @Groups({"api"})
	 * @Expose
     *  The product name
     */
    protected $name;

    /**
     * @Type("string")
	 * @Groups({"api"})
	 * @Expose
     *  The product API handle
     */
    protected $handle;

    /**
     * @Type("string")
	 * @Groups({"api"})
	 * @Expose
     *  The product description
     */
    protected $description;

    /**
     * @Type("string")
	 * @Groups({"api"})
	 * @Expose
     *  Nested attributes pertaining to the product family to which this product belongs
     */
    protected $product_family;

    /**
     * @Type("string")
	 * @Groups({"api"})
	 * @Expose
     *  The product family accounting code (has no bearing in Chargify, may be used within your app)
     */
    protected $accounting_code;

    /**
     * @Type("string")
	 * @Groups({"api"})
	 * @Expose
     *  A string representing the interval unit for this product, either month or day
     */
    protected $interval_unit;

    /**
     * @Type("integer")
	 * @Groups({"api"})
	 * @Expose
     * The numerical interval. i.e. an interval of ‘30’ coupled with an interval_unit of ‘day’ would mean this product would renew every 30 days
     */
    protected $interval;

    /**
     * @Type("integer")
	 * @Groups({"api"})
	 * @Expose
     *  The up front charge you have specified.
     */
    protected $initial_charge_in_cents;

    /**
     * @Type("integer")
	 * @Groups({"api"})
	 * @Expose
     *  The price of the trial period for a subscription to this product, in integer cents.
     */
    protected $trial_price_in_cents;

    /**
     * @Type("integer")
	 * @Groups({"api"})
	 * @Expose
     *  A numerical interval for the length of the trial period of a subscription to this product.
     * See the description of interval for a description of how this value is coupled with an interval unit to calculate the full interval
     */
    protected $trial_interval;

    /**
     * @Type("integer")
	 * @Groups({"api"})
	 * @Expose
     *  A string representing the trial interval unit for this product, either month or day
     */
    protected $trial_interval_unit;

    /**
     * @Type("integer")
	 * @Groups({"api"})
	 * @Expose
     *  A numerical interval for the length a subscription to this product will run before it expires.
     * See the description of interval for a description of how this value is coupled with an interval unit to calculate the full interval
     */
    protected $expiration_interval;

    /**
     * @Type("string")
	 * @Groups({"api"})
	 * @Expose
     * A string representing the trial interval unit for this product, either month or day
     */
    protected $expiration_interval_unit;

    /**
     * @Type("integer")
	 * @Groups({"api"})
	 * @Expose
     * The version of the product
     */
    protected $version_number;

    /**
     * @Type("string")
	 * @Groups({"api"})
	 * @Expose
     * The parameters string we will use in constructing your return URL. See the section on “Return URLs and Parameters” here
     */
    protected $return_params;

    /**
     * @Type("boolean")
	 * @Groups({"api"})
	 * @Expose
     */
    protected $require_credit_card;

    /**
     * @Type("boolean")
	 * @Groups({"api"})
	 * @Expose
     */
    protected $request_credit_card;

    /**
     * @Type("datetime")
	 * @Groups({"api"})
	 * @Expose
     * Timestamp indicating when this product was created
     */
    protected $created_at;

    /**
     * @Type("datetime")
	 * @Groups({"api"})
	 * @Expose
     *  Timestamp indicating when this product was last updated
     */
    protected $updated_at;

    /**
     * @Type("datetime")
	 * @Groups({"api"})
	 * @Expose
     *  Timestamp indicating when this product was archived
     */
    protected $archived_at;

    /**
     * @type array
     * @TODO: something to manage this data type
     *  An array of signup pages containing the following attributes:
     */
    protected $public_signup_pages;

    /**
     * @Type("string")
	 * @Groups({"api"})
	 * @Expose
     *  The url where the signup page can be viewed
     */
    protected $url;

    /**
     * @Type("string")
	 * @Groups({"api"})
	 * @Expose
     *  The url to which a customer will be returned after a successful signup
     */
    protected $return_url;

    /**
     * @Type("integer")
	 * @Groups({"api"})
	 * @Expose
     *  The ID of the product family to which the product belongs.
     */
    protected $product_family_id;

    /**
     * @Type("boolean")
	 * @Groups({"api"})
	 * @Expose
     */
    protected $require_billing_address;

    /**
     * @Type("boolean")
	 * @Groups({"api"})
	 * @Expose
     */
    protected $request_billing_address;

    /**
     * @Type("boolean")
	 * @Groups({"api"})
	 * @Expose
     */
    protected $taxable;

    /**
     * @Type("string")
	 * @Groups({"api"})
	 * @Expose
     *  The type of trial for this product, either no_obligation or payment_expected.
     */
    protected $trial_type;

    /**
     * @Type("string")
	 * @Groups({"api"})
	 * @Expose
     *  A true or false value (default true) indicating whether or not you want a Public Page"
     * to be automatically created for this product return_url If auto_create_signup_page is true,
     * this will set the url to which a customer will be returned after a successful signup for the auto-created signup page.
     */
    protected $auto_create_signup_page;

    /**
     * @return string
     */
    public function getAccountingCode()
    {
        return $this->accounting_code;
    }

    /**
     * @param string $accounting_code
     */
    public function setAccountingCode($accounting_code)
    {
        $this->accounting_code = $accounting_code;
    }

    /**
     * @return datetime
     */
    public function getArchivedAt()
    {
        return $this->archived_at;
    }

    /**
     * @param datetime $archived_at
     */
    public function setArchivedAt($archived_at)
    {
        $this->archived_at = $archived_at;
    }

    /**
     * @return string
     */
    public function getAutoCreateSignupPage()
    {
        return $this->auto_create_signup_page;
    }

    /**
     * @param string $auto_create_signup_page
     */
    public function setAutoCreateSignupPage($auto_create_signup_page)
    {
        $this->auto_create_signup_page = $auto_create_signup_page;
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
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return int
     */
    public function getExpirationInterval()
    {
        return $this->expiration_interval;
    }

    /**
     * @param int $expiration_interval
     */
    public function setExpirationInterval($expiration_interval)
    {
        $this->expiration_interval = $expiration_interval;
    }

    /**
     * @return string
     */
    public function getExpirationIntervalUnit()
    {
        return $this->expiration_interval_unit;
    }

    /**
     * @param string $expiration_interval_unit
     */
    public function setExpirationIntervalUnit($expiration_interval_unit)
    {
        $this->expiration_interval_unit = $expiration_interval_unit;
    }

    /**
     * @return string
     */
    public function getHandle()
    {
        return $this->handle;
    }

    /**
     * @param string $handle
     */
    public function setHandle($handle)
    {
        $this->handle = $handle;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getInitialChargeInCents()
    {
        return $this->initial_charge_in_cents;
    }

    /**
     * @param int $initial_charge_in_cents
     */
    public function setInitialChargeInCents($initial_charge_in_cents)
    {
        $this->initial_charge_in_cents = $initial_charge_in_cents;
    }

    /**
     * @return int
     */
    public function getInterval()
    {
        return $this->interval;
    }

    /**
     * @param int $interval
     */
    public function setInterval($interval)
    {
        $this->interval = $interval;
    }

    /**
     * @return string
     */
    public function getIntervalUnit()
    {
        return $this->interval_unit;
    }

    /**
     * @param string $interval_unit
     */
    public function setIntervalUnit($interval_unit)
    {
        $this->interval_unit = $interval_unit;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return int
     */
    public function getPriceInCents()
    {
        return $this->price_in_cents;
    }

    /**
     * @param int $price_in_cents
     */
    public function setPriceInCents($price_in_cents)
    {
        $this->price_in_cents = $price_in_cents;
    }

    /**
     * @return string
     */
    public function getProductFamily()
    {
        return $this->product_family;
    }

    /**
     * @param string $product_family
     */
    public function setProductFamily($product_family)
    {
        $this->product_family = $product_family;
    }

    /**
     * @return int
     */
    public function getProductFamilyId()
    {
        return $this->product_family_id;
    }

    /**
     * @param int $product_family_id
     */
    public function setProductFamilyId($product_family_id)
    {
        $this->product_family_id = $product_family_id;
    }

    /**
     * @return array
     */
    public function getPublicSignupPages()
    {
        return $this->public_signup_pages;
    }

    /**
     * @param array $public_signup_pages
     */
    public function setPublicSignupPages($public_signup_pages)
    {
        $this->public_signup_pages = $public_signup_pages;
    }

    /**
     * @return boolean
     */
    public function isRequestBillingAddress()
    {
        return $this->request_billing_address;
    }

    /**
     * @param boolean $request_billing_address
     */
    public function setRequestBillingAddress($request_billing_address)
    {
        $this->request_billing_address = $request_billing_address;
    }

    /**
     * @return boolean
     */
    public function isRequestCreditCard()
    {
        return $this->request_credit_card;
    }

    /**
     * @param boolean $request_credit_card
     */
    public function setRequestCreditCard($request_credit_card)
    {
        $this->request_credit_card = $request_credit_card;
    }

    /**
     * @return boolean
     */
    public function isRequireBillingAddress()
    {
        return $this->require_billing_address;
    }

    /**
     * @param boolean $require_billing_address
     */
    public function setRequireBillingAddress($require_billing_address)
    {
        $this->require_billing_address = $require_billing_address;
    }

    /**
     * @return boolean
     */
    public function isRequireCreditCard()
    {
        return $this->require_credit_card;
    }

    /**
     * @param boolean $require_credit_card
     */
    public function setRequireCreditCard($require_credit_card)
    {
        $this->require_credit_card = $require_credit_card;
    }

    /**
     * @return string
     */
    public function getReturnParams()
    {
        return $this->return_params;
    }

    /**
     * @param string $return_params
     */
    public function setReturnParams($return_params)
    {
        $this->return_params = $return_params;
    }

    /**
     * @return string
     */
    public function getReturnUrl()
    {
        return $this->return_url;
    }

    /**
     * @param string $return_url
     */
    public function setReturnUrl($return_url)
    {
        $this->return_url = $return_url;
    }

    /**
     * @return boolean
     */
    public function isTaxable()
    {
        return $this->taxable;
    }

    /**
     * @param boolean $taxable
     */
    public function setTaxable($taxable)
    {
        $this->taxable = $taxable;
    }

    /**
     * @return int
     */
    public function getTrialInterval()
    {
        return $this->trial_interval;
    }

    /**
     * @param int $trial_interval
     */
    public function setTrialInterval($trial_interval)
    {
        $this->trial_interval = $trial_interval;
    }

    /**
     * @return string
     */
    public function getTrialIntervalUnit()
    {
        return $this->trial_interval_unit;
    }

    /**
     * @param string $trial_interval_unit
     */
    public function setTrialIntervalUnit($trial_interval_unit)
    {
        $this->trial_interval_unit = $trial_interval_unit;
    }

    /**
     * @return int
     */
    public function getTrialPriceInCents()
    {
        return $this->trial_price_in_cents;
    }

    /**
     * @param int $trial_price_in_cents
     */
    public function setTrialPriceInCents($trial_price_in_cents)
    {
        $this->trial_price_in_cents = $trial_price_in_cents;
    }

    /**
     * @return string
     */
    public function getTrialType()
    {
        return $this->trial_type;
    }

    /**
     * @param string $trial_type
     */
    public function setTrialType($trial_type)
    {
        $this->trial_type = $trial_type;
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

    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param string $url
     */
    public function setUrl($url)
    {
        $this->url = $url;
    }

    /**
     * @return int
     */
    public function getVersionNumber()
    {
        return $this->version_number;
    }

    /**
     * @param int $version_number
     */
    public function setVersionNumber($version_number)
    {
        $this->version_number = $version_number;
    }


}