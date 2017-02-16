<?php

namespace Litwicki\Bundle\ChargifyBundle\Entity;

/**
 *  Api Entity written by jake.ltiwicki@gmail.com
 *  @source: https://docs.chargify.com/api-allocations
 */

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

use Litwicki\Bundle\ChargifyBundle\Model\Entity\ChargifyEntity;
use Litwicki\Bundle\ChargifyBundle\Model\Entity\ChargifyEntityInterface;
use Litwicki\Bundle\ChargifyBundle\Exception\ChargifyMethodNotAccessibleException;

/**
 * Class Allocation
 *
 * @package Litwicki\Bundle\ChargifyBundle\Entity
 */
class Allocation extends ChargifyEntity implements ChargifyEntityInterface
{
    /**
     * @Type("integer")
     * @Groups({"api"})
     * @Expose
     */
    protected $previous_quantity;

    /**
     * @Type("datetime")
     * @Groups({"api"})
     * @Expose
     */
    protected $timestamp;

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
     */
    protected $quantity;

    /**
     * @Type("string")
     * @Groups({"api"})
     * @Expose
     */
    protected $memo;

    /**
     * @Type("string")
     * @Groups({"api"})
     * @Expose
     */
    protected $proration_upgrade_scheme;

    /**
     * @Type("string")
     * @Groups({"api"})
     * @Expose
     */
    protected $proration_downgrade_scheme;

    /**
     * @Type("string")
     * @Groups({"api"})
     * @Expose
     */
    protected $payment_collection_method;

    /**
     * @param $subscription_id
     * @param $component_id
     */
    public function __construct($subscription_id, $component_id)
    {
        $this->subscription_id = $subscription_id;
        $this->component_id = $component_id;
    }

    /**
     * @return mixed
     */
    public function getMemo()
    {
        return $this->memo;
    }

    /**
     * Allocations do not have an accessible id property.
     * @return int|null
     */
    public function getId()
    {
        $message = sprintf('Allocations do not have an accessible identifier.', get_class($this));
        throw new ChargifyMethodNotAccessibleException($message);
    }

    /**
     * @param mixed $memo
     */
    public function setMemo($memo)
    {
        $this->memo = $memo;
    }

    /**
     * @return mixed
     */
    public function getPaymentCollectionMethod()
    {
        return $this->payment_collection_method;
    }

    /**
     * @param mixed $payment_collection_method
     */
    public function setPaymentCollectionMethod($payment_collection_method)
    {
        $this->payment_collection_method = $payment_collection_method;
    }

    /**
     * @return mixed
     */
    public function getProrationDowngradeScheme()
    {
        return $this->proration_downgrade_scheme;
    }

    /**
     * @param mixed $proration_downgrade_scheme
     */
    public function setProrationDowngradeScheme($proration_downgrade_scheme)
    {
        $this->proration_downgrade_scheme = $proration_downgrade_scheme;
    }

    /**
     * @return mixed
     */
    public function getProrationUpgradeScheme()
    {
        return $this->proration_upgrade_scheme;
    }

    /**
     * @param mixed $proration_upgrade_scheme
     */
    public function setProrationUpgradeScheme($proration_upgrade_scheme)
    {
        $this->proration_upgrade_scheme = $proration_upgrade_scheme;
    }

    /**
     * @return mixed
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * @param mixed $quantity
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
    }

    /**
     * @return mixed
     */
    public function getPreviousQuantity()
    {
        return $this->previous_quantity;
    }

    /**
     * @return mixed
     */
    public function getTimestamp()
    {
        return $this->timestamp;
    }

    /**
     * @return mixed
     */
    public function getComponentId()
    {
        return $this->component_id;
    }

    /**
     * @return mixed
     */
    public function getSubscriptionId()
    {
        return $this->subscription_id;
    }

}