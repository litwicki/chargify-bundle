<?php

namespace Litwicki\Bundle\ChargifyBundle\Handler;

use Litwicki\Bundle\ChargifyBundle\Services\ChargifyHandler;
use Litwicki\Bundle\ChargifyBundle\Model\Charge;

class ChargeHandler extends ChargifyHandler
{
    /**
     * @param $entity
     *
     * @throws \Exception
     */
    public function create(Charge $entity)
    {
        try {

            $uri = sprintf('subscriptions/%s/charges',
                $entity->getSubscriptionId()
            );

            $response = $this->request($uri, 'POST', $this->serializer()->serialize($entity, $this->format()));
            return $this->serializer()->deserialize($response, '\Litwicki\Bundle\ChargifyBundle\Model\Charge', $this->format());

        }
        catch(\Exception $e) {
            throw $e;
        }
    }
}