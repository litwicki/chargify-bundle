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
 * Class Webhook
 *
 * @package Litwicki\Bundle\ChargifyBundle\Entity
 */
class Webhook extends ChargifyEntity implements ChargifyEntityInterface
{

    /**
     * @Type("boolean")
	 * @Groups({"api"})
	 * @Expose
     *  A boolean flag describing whether the webhook was accepted by the webhook endpoint for the most recent attempt.
     * (Acceptance is defined by receiving a “200 OK” HTTP response within a reasonable timeframe, i.e. 15 seconds)
     */
    protected $successful;

    /**
     * @Type("string")
	 * @Groups({"api"})
	 * @Expose
     *  A string describing which event type produced the given Webhook
     */
    protected $event;

    /**
     * @Type("string")
	 * @Groups({"api"})
	 * @Expose
     *  The data sent within the Webhook post
     */
    protected $body;

    /**
     * @Type("string")
	 * @Groups({"api"})
	 * @Expose
     *  The calculated Webhook signature
     */
    protected $signature;

    /**
     * @Type("datetime")
	 * @Groups({"api"})
	 * @Expose
     *  Timestamp indicating when the Webhook was created
     */
    protected $created_at;

    /**
     * @Type("datetime")
	 * @Groups({"api"})
	 * @Expose
     *  Timestamp indicating when the Webhook was accepted by the merchant endpoint.
     * When a webhook is explicitly replayed by the merchant, this value will be cleared until it is accepted again.
     */
    protected $accepted_at;

    /**
     * @Type("datetime")
	 * @Groups({"api"})
	 * @Expose
     *  Timestamp indicating when the most recent attempt was made to send the Webhook
     */
    protected $last_sent_at;

    /**
     * @Type("datetime")
	 * @Groups({"api"})
	 * @Expose
     *  Timestamp indicating when the last non-acceptance occurred. If a webhooks is later resent and accepted, this field will be cleared.
     */
    protected $last_error_at;

    /**
     * @Type("string")
	 * @Groups({"api"})
	 * @Expose
     *  The url that the endpoint was last sent to.
     */
    protected $last_sent_url;

    /**
     * @Type("string")
	 * @Groups({"api"})
	 * @Expose
     *  Text describing the status code and/or error from the last failed attempt to send the Webhook.
     * When a webhook is retried and accepted, this field will be cleared.
     */
    protected $last_error;

    /**
     * @return datetime
     */
    public function getAcceptedAt()
    {
        return $this->accepted_at;
    }

    /**
     * @return string
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * @return datetime
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * @return mixed
     */
    public function getEvent()
    {
        return $this->event;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getLastError()
    {
        return $this->last_error;
    }

    /**
     * @return datetime
     */
    public function getLastErrorAt()
    {
        return $this->last_error_at;
    }

    /**
     * @return datetime
     */
    public function getLastSentAt()
    {
        return $this->last_sent_at;
    }

    /**
     * @return string
     */
    public function getLastSentUrl()
    {
        return $this->last_sent_url;
    }

    /**
     * @return string
     */
    public function getSignature()
    {
        return $this->signature;
    }

    /**
     * @return boolean
     */
    public function isSuccessful()
    {
        return $this->successful;
    }

    /**
     * @param datetime $accepted_at
     */
    public function setAcceptedAt($accepted_at)
    {
        $this->accepted_at = $accepted_at;
    }

    /**
     * @param string $body
     */
    public function setBody($body)
    {
        $this->body = $body;
    }

    /**
     * @param datetime $created_at
     */
    public function setCreatedAt($created_at)
    {
        $this->created_at = $created_at;
    }

    /**
     * @param mixed $event
     */
    public function setEvent($event)
    {
        $this->event = $event;
    }

    /**
     * @param string $last_error
     */
    public function setLastError($last_error)
    {
        $this->last_error = $last_error;
    }

    /**
     * @param datetime $last_error_at
     */
    public function setLastErrorAt($last_error_at)
    {
        $this->last_error_at = $last_error_at;
    }

    /**
     * @param datetime $last_sent_at
     */
    public function setLastSentAt($last_sent_at)
    {
        $this->last_sent_at = $last_sent_at;
    }

    /**
     * @param string $last_sent_url
     */
    public function setLastSentUrl($last_sent_url)
    {
        $this->last_sent_url = $last_sent_url;
    }

    /**
     * @param string $signature
     */
    public function setSignature($signature)
    {
        $this->signature = $signature;
    }

    /**
     * @param boolean $successful
     */
    public function setSuccessful($successful)
    {
        $this->successful = $successful;
    }


    
}
