<?php

namespace Litwicki\Bundle\ChargifyBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use Litwicki\Common;
use Litwicki\Bundle\ChargifyBundle\Model\Entity\ChargifyEntity;
use Litwicki\Bundle\ChargifyBundle\Model\Entity\ChargifyInterface;

/**
 * Class Credit
 *
 * @package Litwicki\Bundle\ChargifyBundle\Entity
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 * @orm\Table(name="ChargifyCredit")
 */

class Credit extends ChargifyEntity implements ChargifyInterface
{
    /**
     * The Credits API has been deprecated in favor of Adjustments.
     * For information on how to use Adjustments, see the documentation for Adjustments.
     * @see: https://docs.chargify.com/api-adjustments
     */
}