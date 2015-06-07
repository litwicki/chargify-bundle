<?php

namespace Litwicki\Bundle\ChargifyBundle\Entity;

/**
 *  Api Entity written by jake.ltiwicki@gmail.com
 *  @source: https://docs.chargify.com/api-allocations
 */

use Doctrine\ORM\Mapping as ORM;
use Litwicki\Common;

use Litwicki\Bundle\ChargifyBundle\Services\ChargifyEntity;
use Litwicki\Bundle\ChargifyBundle\Services\ChargifyInterface;
use Litwicki\Bundle\ChargifyBundle\Exception\ChargifyMethodNotAccessibleException;

/**
 * Class Allocation
 *
 * @package Litwicki\Bundle\ChargifyBundle\Entity
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 * @orm\Table(name="ChargifyAllocation")
 */
class Allocation extends ChargifyEntity implements ChargifyInterface
{
    protected $previous_quantity;

    protected $timestamp;

    protected $subscription_id;

    protected $component_id;

    protected $quantity;

    protected $memo;

    protected $proration_upgrade_scheme;

    protected $proration_downgrade_scheme;

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
     * Load the Allocation Handler.
     * @throws \Exception
     */
    public function getHandler()
    {
        try {
            return $this->container->get('chargify.handler.allocation');
        }
        catch(\Exception $e) {
            throw $e;
        }
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