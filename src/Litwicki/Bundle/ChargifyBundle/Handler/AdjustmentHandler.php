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

            $result = $this->request($uri, 'POST', $this->entityToPostData($entity));

            $data = $this->formatResponse($result);

            return $this->assignValues($entity, $data);

        }
        catch(\Exception $e) {
            throw $e;
        }
    }

}