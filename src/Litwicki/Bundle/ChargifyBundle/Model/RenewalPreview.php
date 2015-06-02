<?php

namespace Litwicki\Bundle\ChargifyBundle\Model;

use Litwicki\Bundle\ChargifyBundle\Services\ChargifyModel;
use Litwicki\Bundle\ChargifyBundle\Services\ChargifyInterface;

/**
 * Class RenewalPreview
 *
 * @package ChargifyBundle\Model
 */
class RenewalPreview extends ChargifyModel implements ChargifyInterface
{
    /**
     * @type datetime
     * The timestamp for the subscription’s next renewal
     */
    protected $next_assessment_at;

    /**
     * @type int
     * An integer representing the amount of the subscription’s current balance
     */
    protected $existing_balance_in_cents;

    /**
     * @type int
     * An integer representing the amount of the total pre-tax, pre-discount charges that will be assessed at the next renewal
     */
    protected $subtotal_in_cents;

    /**
     * @type int
     * An integer representing the amount of the coupon discounts that will be applied to the next renewal
     */
    protected $total_discount_in_cents;

    /**
     * @type int
     * An integer representing the total tax charges that will be assessed at the next renewal
     */
    protected $total_tax_in_cents;

    /**
     * @type int
     * An integer representing the total amount owed, less any discounts, that will be assessed at the next renewal
     */
    protected $total_in_cents;

    /**
     * @type int
     * An integer representing the existing_balance_in_cents plus the total_in_cents
     */
    protected $total_amount_due_in_cents;

    /**
     * @type bool
     * A boolean indicating whether or not additional taxes will be calculated at the time of renewal.
     * This will be true if you are using Avalara and the address of the subscription is in one of your defined taxable regions.
     */
    protected $uncalculated_taxes;

    /**
     * @type array
     * @TODO: something with this data type.
     * An array of objects representing the individual transactions that will be created at the next renewal
     */
    protected $line_items;

    /**
     * @return int
     */
    public function getExistingBalanceInCents()
    {
        return $this->existing_balance_in_cents;
    }

    /**
     * @param int $existing_balance_in_cents
     */
    public function setExistingBalanceInCents($existing_balance_in_cents)
    {
        $this->existing_balance_in_cents = $existing_balance_in_cents;
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
     * @return array
     */
    public function getLineItems()
    {
        return $this->line_items;
    }

    /**
     * @param array $line_items
     */
    public function setLineItems($line_items)
    {
        $this->line_items = $line_items;
    }

    /**
     * @return datetime
     */
    public function getNextAssessmentAt()
    {
        return $this->next_assessment_at;
    }

    /**
     * @param datetime $next_assessment_at
     */
    public function setNextAssessmentAt($next_assessment_at)
    {
        $this->next_assessment_at = $next_assessment_at;
    }

    /**
     * @return int
     */
    public function getSubtotalInCents()
    {
        return $this->subtotal_in_cents;
    }

    /**
     * @param int $subtotal_in_cents
     */
    public function setSubtotalInCents($subtotal_in_cents)
    {
        $this->subtotal_in_cents = $subtotal_in_cents;
    }

    /**
     * @return int
     */
    public function getTotalAmountDueInCents()
    {
        return $this->total_amount_due_in_cents;
    }

    /**
     * @param int $total_amount_due_in_cents
     */
    public function setTotalAmountDueInCents($total_amount_due_in_cents)
    {
        $this->total_amount_due_in_cents = $total_amount_due_in_cents;
    }

    /**
     * @return int
     */
    public function getTotalDiscountInCents()
    {
        return $this->total_discount_in_cents;
    }

    /**
     * @param int $total_discount_in_cents
     */
    public function setTotalDiscountInCents($total_discount_in_cents)
    {
        $this->total_discount_in_cents = $total_discount_in_cents;
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
     * @return int
     */
    public function getTotalTaxInCents()
    {
        return $this->total_tax_in_cents;
    }

    /**
     * @param int $total_tax_in_cents
     */
    public function setTotalTaxInCents($total_tax_in_cents)
    {
        $this->total_tax_in_cents = $total_tax_in_cents;
    }

    /**
     * @return boolean
     */
    public function isUncalculatedTaxes()
    {
        return $this->uncalculated_taxes;
    }

    /**
     * @param boolean $uncalculated_taxes
     */
    public function setUncalculatedTaxes($uncalculated_taxes)
    {
        $this->uncalculated_taxes = $uncalculated_taxes;
    }



}