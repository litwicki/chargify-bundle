<?php

namespace Litwicki\Bundle\ChargifyBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use Litwicki\Common;
use Litwicki\Bundle\ChargifyBundle\Model\Entity\ChargifyEntity;
use Litwicki\Bundle\ChargifyBundle\Model\Entity\ChargifyInterface;

/**
 * Class Coupon
 *
 * @package Litwicki\Bundle\ChargifyBundle\Entity
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 * @orm\Table(name="ChargifyCoupon")
 */
class Coupon extends ChargifyEntity implements ChargifyInterface
{
    /**
     * @type
     */
    protected $id;

    /**
     * @type
     */
    protected $name;

    /**
     * @type
     */
    protected $code;

    /**
     * @type
     */
    protected $description;

    /**
     * @type
     */
    protected $percentage;

    /**
     * @type
     */
    protected $amount;

    /**
     * @type
     */
    protected $allow_negative_balance;

    /**
     * @type
     */
    protected $recurring;

    /**
     * @type
     */
    protected $duration_period_count;

    /**
     * @type
     */
    protected $coupon_end_date;
    
    /**
     * @type
     */
    protected $product_family_id;

    /**
     * @param \Symfony\Component\DependencyInjection\ContainerInterface $container
     */
    public function setContainer(ContainerInterface $container = NULL)
    {
        $this->container = $container;
    }

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

    public function create()
    {

    }
}