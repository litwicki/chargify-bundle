<?php

namespace Litwicki\Bundle\ChargifyBundle\Model;

use Litwicki\Bundle\ChargifyBundle\Services\ChargifyModel;
use Litwicki\Bundle\ChargifyBundle\Services\ChargifyInterface;

class Credit extends ChargifyModel implements ChargifyInterface
{
    /**
     * The Credits API has been deprecated in favor of Adjustments.
     * For information on how to use Adjustments, see the documentation for Adjustments.
     * @see: https://docs.chargify.com/api-adjustments
     */
}