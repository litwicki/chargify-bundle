<?php

namespace Litwicki\Bundle\ChargifyBundle\Handler;

use Litwicki\Bundle\ChargifyBundle\Services\ChargifyHandler;
use Litwicki\Bundle\ChargifyBundle\Model\Adjustment;

class AdjustmentHandler extends ChargifyHandler
{

    /**
     * Create an adjustment on a subscription.
     *
     * @param $entity
     *
     * @throws \Exception
     */
    public function create(Adjustment $entity)
    {
        try {

            $uri = sprintf('/subscriptions/%s/adjustments',
                $entity->getSubscriptionId()
            );

            $response = $this->request($uri, 'POST', $this->serializer()->serialize($entity, $this->format()));
            return $this->serializer()->deserialize($response, '\Litwicki\Bundle\ChargifyBundle\Model\Adjustment', $this->format());

        }
        catch(\Exception $e) {
            throw $e;
        }
    }

}