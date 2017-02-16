<?php

namespace Litwicki\Bundle\ChargifyBundle\Handler\Entity;

use Litwicki\Bundle\ChargifyBundle\Model\Handler\ChargifyEntityHandler;
use Litwicki\Bundle\ChargifyBundle\Entity\Webhook;

class WebhookHandler extends ChargifyEntityHandler
{
    /**
     * Replay Webhooks for a Site
     * Posting to the replay endpoint does not immediate resend the webhooks.
     * They are added to the background job queue and should be resent
     * momentarily.
     *
     * @param array $ids
     *
     * @return mixed
     * @throws \Exception
     */
    public function replay(array $ids = array())
    {
        try {

            $uri = '/webhooks/replay';
            $response = $this->request($uri, 'POST', $this->serialize($ids));
            return $this->apiResponse($response->getBody(), $this->entityClass);

        }
        catch (\Exception $e) {
            throw $e;
        }
    }

}