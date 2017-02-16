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

use Litwicki\Common;
use Litwicki\Bundle\ChargifyBundle\Model\Entity\ChargifyComponentEntity;
use Litwicki\Bundle\ChargifyBundle\Model\Entity\ChargifyEntityInterface;

/**
 * Class ComponentMetered
 *
 * @package Litwicki\Bundle\ChargifyBundle\Entity
 */
class ComponentMetered extends ChargifyComponentEntity implements ChargifyEntityInterface
{
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
    protected $product_family_id;

    /**
     * @Type("string")
	 * @Groups({"api"})
	 * @Expose
     */
    protected $kind;

    /**
     * @Type("boolean")
	 * @Groups({"api"})
	 * @Expose
     */
    protected $archived;

    /**
     * @Type("string")
	 * @Groups({"api"})
	 * @Expose
     */
    protected $name;

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
     */
    protected $unit_name;

    /**
     * @Type("float")
	 * @Groups({"api"})
	 * @Expose
     */
    protected $unit_price;

    /**
     * @Type("string")
	 * @Groups({"api"})
	 * @Expose
     */
    protected $pricing_scheme;

    /**
     * @Type("string")
	 * @Groups({"api"})
	 * @Expose
     */
    protected $prices;

    /**
     * @Type("integer")
	 * @Groups({"api"})
	 * @Expose
     */
    protected $subscription_id;

    /**
     * @Type("integer")
	 * @Groups({"api"})
	 * @Expose
     */
    protected $component_id;

    /**
     * @Type("integer")
	 * @Groups({"api"})
	 * @Expose
     *
     */
    protected $quantity;

    /**
     * @Type("string")
	 * @Groups({"api"})
	 * @Expose
     */
    protected $memo;

    /**
     * @Type("integer")
	 * @Groups({"api"})
	 * @Expose
     */
    protected $unit_balance;

    /**
     * Construct the Component.
     *
     * @param $subscription_id
     */
    public function __construct($subscription_id)
    {
        parent::__construct($subscription_id);
        $this->subscription_id = $subscription_id;
    }

    /**
     * @return mixed
     */
    public function getUnitBalance()
    {
        return $this->unit_balance;
    }

    /**
     * @param mixed $unit_balance
     */
    public function setUnitBalance($unit_balance)
    {
        $this->unit_balance = $unit_balance;
    }

    /**
     * @return mixed
     */
    public function getComponentId()
    {
        return $this->component_id;
    }

    /**
     * @param mixed $component_id
     */
    public function setComponentId($component_id)
    {
        $this->component_id = $component_id;
    }

    /**
     * @return mixed
     */
    public function getSubscriptionId()
    {
        return $this->subscription_id;
    }

    /**
     * @param mixed $subscription_id
     */
    public function setSubscriptionId($subscription_id)
    {
        $this->subscription_id = $subscription_id;
    }

    /**
     * @return mixed
     */
    public function getArchived()
    {
        return $this->archived;
    }

    /**
     * @param mixed $archived
     */
    public function setArchived($archived)
    {
        $this->archived = $archived;
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
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getKind()
    {
        return $this->kind;
    }

    /**
     * @param mixed $kind
     */
    public function setKind($kind)
    {
        $this->kind = $kind;
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
    public function getPrices()
    {
        return $this->prices;
    }

    /**
     * @param mixed $prices
     */
    public function setPrices($prices)
    {
        $this->prices = $prices;
    }

    /**
     * @return mixed
     */
    public function getPricingScheme()
    {
        return $this->pricing_scheme;
    }

    /**
     * @param mixed $pricing_scheme
     */
    public function setPricingScheme($pricing_scheme)
    {
        $this->pricing_scheme = $pricing_scheme;
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
    public function getTaxable()
    {
        return $this->taxable;
    }

    /**
     * @param mixed $taxable
     */
    public function setTaxable($taxable)
    {
        $this->taxable = $taxable;
    }

    /**
     * @return mixed
     */
    public function getUnitName()
    {
        return $this->unit_name;
    }

    /**
     * @param mixed $unit_name
     */
    public function setUnitName($unit_name)
    {
        $this->unit_name = $unit_name;
    }

    /**
     * @return mixed
     */
    public function getUnitPrice()
    {
        return $this->unit_price;
    }

    /**
     * @param mixed $unit_price
     */
    public function setUnitPrice($unit_price)
    {
        $this->unit_price = $unit_price;
    }
}