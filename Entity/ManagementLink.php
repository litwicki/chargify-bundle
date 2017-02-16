<?php

/**
 *  Api Entity written by jake.ltiwicki@gmail.com
 *  @source: https://docs.chargify.com/api-adjustments
 */

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

use Litwicki\Bundle\ChargifyBundle\Exception\ChargifyMethodNotAccessibleException;

/**
 * Class ManagementLink
 *
 * @package Litwicki\Bundle\ChargifyBundle\Entity
 */
class ManagementLink extends ChargifyEntity implements ChargifyEntityInterface
{

    /**
     * @Type("string")
	 * @Groups({"api"})
	 * @Expose
     */
    protected $url;
    
    /**
     * @Type("integer")
	 * @Groups({"api"})
	 * @Expose
     */
    protected $fetch_count;
    
    /**
     * @Type("datetime")
	 * @Groups({"api"})
	 * @Expose
     */
    protected $created_at;
    
    /**
     * @Type("datetime")
	 * @Groups({"api"})
	 * @Expose
     */
    protected $new_link_available_at;
    
    /**
     * @Type("datetime")
	 * @Groups({"api"})
	 * @Expose
     */
    protected $expires_at;

    /**
     * @return datetime
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * @param datetime $created_at
     */
    public function setCreatedAt($created_at)
    {
        $this->created_at = $created_at;
    }

    /**
     * @return datetime
     */
    public function getExpiresAt()
    {
        return $this->expires_at;
    }

    /**
     * @param datetime $expires_at
     */
    public function setExpiresAt($expires_at)
    {
        $this->expires_at = $expires_at;
    }

    /**
     * @return datetime
     */
    public function getFetchCount()
    {
        return $this->fetch_count;
    }

    /**
     * @param datetime $fetch_count
     */
    public function setFetchCount($fetch_count)
    {
        $this->fetch_count = $fetch_count;
    }

    /**
     * @return datetime
     */
    public function getNewLinkAvailableAt()
    {
        return $this->new_link_available_at;
    }

    /**
     * @param datetime $new_link_available_at
     */
    public function setNewLinkAvailableAt($new_link_available_at)
    {
        $this->new_link_available_at = $new_link_available_at;
    }

    /**
     * @return datetime
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param datetime $url
     */
    public function setUrl($url)
    {
        $this->url = $url;
    }

}