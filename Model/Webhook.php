<?php

namespace Litwicki\Bundle\ChargifyBundle\Model;

use Litwicki\Bundle\ChargifyBundle\Services\ChargifyModel;
use Litwicki\Bundle\ChargifyBundle\Services\ChargifyInterface;

class Webhook extends ChargifyModel implements ChargifyInterface
{
    /**
     * @type int
     *  The unique identifier for the webhooks (unique across all of Chargify).
     * This is not changed on a retry/replay of the same webhook, so it may be used to avoid duplicate action for the same event.
     */
    protected $id;

    /**
     * @type bool
     *  A boolean flag describing whether the webhook was accepted by the webhook endpoint for the most recent attempt.
     * (Acceptance is defined by receiving a “200 OK” HTTP response within a reasonable timeframe, i.e. 15 seconds)
     */
    private $successful;

    /**
     * @type
     *  A string describing which event type produced the given Webhook
     */
    private $event;

    /**
     * @type string
     *  The data sent within the Webhook post
     */
    private $body;

    /**
     * @type string
     *  The calculated Webhook signature
     */
    private $signature;

    /**
     * @type datetime
     *  Timestamp indicating when the Webhook was created
     */
    private $created_at;

    /**
     * @type datetime
     *  Timestamp indicating when the Webhook was accepted by the merchant endpoint.
     * When a webhook is explicitly replayed by the merchant, this value will be cleared until it is accepted again.
     */
    private $accepted_at;

    /**
     * @type datetime
     *  Timestamp indicating when the most recent attempt was made to send the Webhook
     */
    private $last_sent_at;

    /**
     * @type datetime
     *  Timestamp indicating when the last non-acceptance occurred. If a webhooks is later resent and accepted, this field will be cleared.
     */
    private $last_error_at;

    /**
     * @type string
     *  The url that the endpoint was last sent to.
     */
    private $last_sent_url;

    /**
     * @type string
     *  Text describing the status code and/or error from the last failed attempt to send the Webhook.
     * When a webhook is retried and accepted, this field will be cleared.
     */
    private $last_error;

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
