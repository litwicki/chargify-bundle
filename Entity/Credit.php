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
 * Class Credit
 *
 * @package Litwicki\Bundle\ChargifyBundle\Entity
 */

class Credit extends ChargifyEntity implements ChargifyEntityInterface
{
    /**
     * The Credits API has been deprecated in favor of Adjustments.
     * For information on how to use Adjustments, see the documentation for Adjustments.
     * @see: https://docs.chargify.com/api-adjustments
     */
}