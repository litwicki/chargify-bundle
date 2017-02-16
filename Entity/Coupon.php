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
 * Class Coupon
 *
 * @package Litwicki\Bundle\ChargifyBundle\Entity
 */
class Coupon extends ChargifyEntity implements ChargifyEntityInterface
{
    /**
     * @Type("string")
	 * @Groups({"api"})
	 * @Expose
     */
    protected $name;

    /**
     * @Type("string")
	 * @Groups({"api"})
	 * @Expose
     */
    protected $code;

    /**
     * @Type("string")
	 * @Groups({"api"})
	 * @Expose
     */
    protected $description;

    /**
     * @Type("integer")
	 * @Groups({"api"})
	 * @Expose
     */
    protected $percentage;

    /**
     * @Type("float")
	 * @Groups({"api"})
	 * @Expose
     */
    protected $amount;

    /**
     * @Type("boolean")
	 * @Groups({"api"})
	 * @Expose
     */
    protected $allow_negative_balance;

    /**
     * @Type("boolean")
	 * @Groups({"api"})
	 * @Expose
     */
    protected $recurring;

    /**
     * @Type("integer")
	 * @Groups({"api"})
	 * @Expose
     */
    protected $duration_period_count;

    /**
     * @Type("datetime")
	 * @Groups({"api"})
	 * @Expose
     */
    protected $coupon_end_date;
    
    /**
     * @Type("integer")
	 * @Groups({"api"})
	 * @Expose
     */
    protected $product_family_id;

    /**
     * @return mixed
     */
    public function getAllowNegativeBalance()
    {
        return $this->allow_negative_balance;
    }

    /**
     * @param mixed $allow_negative_balance
     */
    public function setAllowNegativeBalance($allow_negative_balance)
    {
        $this->allow_negative_balance = $allow_negative_balance;
    }

    /**
     * @return mixed
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * @param mixed $amount
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;
    }

    /**
     * @return mixed
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @param mixed $code
     */
    public function setCode($code)
    {
        $this->code = $code;
    }

    /**
     * @return mixed
     */
    public function getCouponEndDate()
    {
        return $this->coupon_end_date;
    }

    /**
     * @param mixed $coupon_end_date
     */
    public function setCouponEndDate($coupon_end_date)
    {
        $this->coupon_end_date = $coupon_end_date;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getDurationPeriodCount()
    {
        return $this->duration_period_count;
    }

    /**
     * @param mixed $duration_period_count
     */
    public function setDurationPeriodCount($duration_period_count)
    {
        $this->duration_period_count = $duration_period_count;
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
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getPercentage()
    {
        return $this->percentage;
    }

    /**
     * @param mixed $percentage
     */
    public function setPercentage($percentage)
    {
        $this->percentage = $percentage;
    }

    /**
     * @return mixed
     */
    public function getProductFamilyId()
    {
        return $this->product_family_id;
    }

    /**
     * @param mixed $product_family_id
     */
    public function setProductFamilyId($product_family_id)
    {
        $this->product_family_id = $product_family_id;
    }

    /**
     * @return mixed
     */
    public function getRecurring()
    {
        return $this->recurring;
    }

    /**
     * @param mixed $recurring
     */
    public function setRecurring($recurring)
    {
        $this->recurring = $recurring;
    }

}