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
 * Class Migration
 *
 * If you want a migration with proration, then you want to continue with the methods listed below.
 * However, if you just want to change the product the customer is subscribed to (with no proration)
 * then you’ll just want to update the subscription product.
 *
 * @package ChargifyBundle\Entity
 *
 * @package Litwicki\Bundle\ChargifyBundle\Entity
 */
class Migration extends ChargifyEntity implements ChargifyEntityInterface
{
    /**
     * @Type("integer")
	 * @Groups({"api"})
	 * @Expose
     * The ID or handle of the target Product.
     * A Subscription can be migrated to another product for both the current Product Family and another Product Family.
     *
     * Note: Going to another Product Family, components will not be migrated as well.
     */
    protected $product_id;

    /**
     * @Type("boolean")
	 * @Groups({"api"})
	 * @Expose
     * Boolean, default 0. If 1 is sent the customer will migrate to the new product with a trial if one is available.
     * If 0 is sent, the trial period will be ignored.
     */
    protected $product_handle;

    /**
     * @Type("boolean")
	 * @Groups({"api"})
	 * @Expose
     * Boolean, default 0. If 1 is sent initial charges will be assessed.
     * If 0 is sent initial charges will be ignored.
     */
    protected $include_trial;

    /**
     * @Type("boolean")
	 * @Groups({"api"})
	 * @Expose
     * Boolean, default 1. If 1 (or nothing) is sent, any coupons associated with the subscription will be applied to the migration.
     * If 0 is sent, coupons will not be applied.
     */
    protected $include_coupons;

    /**
     * @Type("integer")
	 * @Groups({"api"})
	 * @Expose
     *  Integer, The amount of the prorated adjustment that would be issued for the current subscription.
     */
    protected $prorated_adjustment_in_cents;

    /**
     * @Type("integer")
	 * @Groups({"api"})
	 * @Expose
     *  Integer, The amount of the charge that would be created for the new product.
     */
    protected $charge_in_cents;

    /**
     * @Type("integer")
	 * @Groups({"api"})
	 * @Expose
     * Integer, The amount of the payment due in the case of an upgrade.
     */
    protected $payment_due_in_cents;

    /**
     * @Type("integer")
	 * @Groups({"api"})
	 * @Expose
     * Integer, The amount of the credit that would be left in the case of a downgrade.
     */
    protected $credit_applied_in_cents;


    /**
     * @return int
     */
    public function getChargeInCents()
    {
        return $this->charge_in_cents;
    }

    /**
     * @param int $charge_in_cents
     */
    public function setChargeInCents($charge_in_cents)
    {
        $this->charge_in_cents = $charge_in_cents;
    }

    /**
     * @return int
     */
    public function getCreditAppliedInCents()
    {
        return $this->credit_applied_in_cents;
    }

    /**
     * @param int $credit_applied_in_cents
     */
    public function setCreditAppliedInCents($credit_applied_in_cents)
    {
        $this->credit_applied_in_cents = $credit_applied_in_cents;
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
     * @return boolean
     */
    public function isIncludeCoupons()
    {
        return $this->include_coupons;
    }

    /**
     * @param boolean $include_coupons
     */
    public function setIncludeCoupons($include_coupons)
    {
        $this->include_coupons = $include_coupons;
    }

    /**
     * @return boolean
     */
    public function isIncludeTrial()
    {
        return $this->include_trial;
    }

    /**
     * @param boolean $include_trial
     */
    public function setIncludeTrial($include_trial)
    {
        $this->include_trial = $include_trial;
    }

    /**
     * @return int
     */
    public function getPaymentDueInCents()
    {
        return $this->payment_due_in_cents;
    }

    /**
     * @param int $payment_due_in_cents
     */
    public function setPaymentDueInCents($payment_due_in_cents)
    {
        $this->payment_due_in_cents = $payment_due_in_cents;
    }

    /**
     * @return boolean
     */
    public function isProductHandle()
    {
        return $this->product_handle;
    }

    /**
     * @param boolean $product_handle
     */
    public function setProductHandle($product_handle)
    {
        $this->product_handle = $product_handle;
    }

    /**
     * @return int
     */
    public function getProductId()
    {
        return $this->product_id;
    }

    /**
     * @param int $product_id
     */
    public function setProductId($product_id)
    {
        $this->product_id = $product_id;
    }

    /**
     * @return int
     */
    public function getProratedAdjustmentInCents()
    {
        return $this->prorated_adjustment_in_cents;
    }

    /**
     * @param int $prorated_adjustment_in_cents
     */
    public function setProratedAdjustmentInCents($prorated_adjustment_in_cents)
    {
        $this->prorated_adjustment_in_cents = $prorated_adjustment_in_cents;
    }
}