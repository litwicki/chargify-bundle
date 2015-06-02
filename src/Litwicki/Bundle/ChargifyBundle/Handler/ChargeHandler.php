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

            $result = $this->request($uri, 'POST', $this->entityToPostData($entity));

            $response = $this->formatResponse($result);

            return $this->assignValues($entity, $response);

        }
        catch(\Exception $e) {
            throw $e;
        }
    }
}