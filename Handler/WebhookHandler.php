<?php

namespace Litwicki\Bundle\ChargifyBundle\Handler;

use Litwicki\Bundle\ChargifyBundle\Model\Handler\ChargifyHandler;
use Litwicki\Bundle\ChargifyBundle\Entity\Webhook;

class WebhookHandler extends ChargifyHandler
{

    /**
     * List all Webhooks for a Site.
     *
     * @param array $options
     *
     * @throws \Exception
     * @returns array of \Litwicki\Bundle\ChargifyBundle\Entity\Webhook
     */
    public function getAll($options = array())
    {
        try {

            $uri = '/webhooks';

            if(empty($options)) {
                $response = $this->request($uri);
            }
            else {
                $response = $this->request($uri, 'GET', null, http_build_query($options));
            }

            return $this->apiResponse($response, 'Litwicki\Bundle\Chargify\Modle\Webhook', $this->format());

        }
        catch (\Exception $e) {
            throw $e;
        }
    }

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
    public function replay($ids)
    {
        try {

            $uri = '/webhooks/replay';
            $response = $this->request($uri, 'POST', $this->postData($ids));

            return $this->responseToArray($response);

        }
        catch (\Exception $e) {
            throw $e;
        }
    }

}