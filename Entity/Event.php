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
 * Class Event
 *
 * @package Litwicki\Bundle\ChargifyBundle\Entity
 */
class Event extends ChargifyEntity implements ChargifyEntityInterface
{

    /**
     * All Event objects are READ ONLY, so we have deliberately not allowed setters.
     * @see: https://docs.chargify.com/api-events
     */

    /**
     * @Type("string")
	 * @Groups({"api"})
	 * @Expose
     */
    protected $key;

    /**
     * @Type("string")
	 * @Groups({"api"})
	 * @Expose
     */
    protected $message;

    /**
     * @Type("integer")
	 * @Groups({"api"})
	 * @Expose
     */
    protected $subscription_id;

    /**
     * @Type("datetime")
	 * @Groups({"api"})
	 * @Expose
     */
    protected $event_specific_date;

    /**
     * @Type("datetime")
	 * @Groups({"api"})
	 * @Expose
     */
    protected $created_at;

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
    public function getEventSpecificDate()
    {
        return $this->event_specific_date;
    }

    /**
     * @return mixed
     */
    public function getKey()
    {
        return $this->key;
    }

    /**
     * @return mixed
     */
    public function getMessage()
    {
        return $this->message;
    }

}