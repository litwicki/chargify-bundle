<?php

namespace Litwicki\Bundle\ChargifyBundle\Handler;

use Litwicki\Bundle\ChargifyBundle\Model\Handler\ChargifyHandler;
use Litwicki\Bundle\ChargifyBundle\Model\Handler\ChargifyHandlerInterface;

use Litwicki\Bundle\ChargifyBundle\Entity\Event;
use Litwicki\Bundle\ChargifyBundle\Entity\Subscription;

abstract class EventHandler extends ChargifyHandler implements ChargifyHandlerInterface
{

    /**
     * Fetch a paged result set of Events.
     *
     * @param $options
     * Optional Parameters: page, per_page, since_id, max_id, direction (asc, desc)
     *
     * @throws \Exception
     * @return void $items array
     */
    public function findAll($options)
    {
        try {
            $uri = 'events';
            $query = http_build_query($options);
            return $this->fetchMultiple($uri, '\Litwicki\Bundle\ChargifyBundle\Entity\Event', $query);
        }
        catch(\Exception $e) {
            throw $e;
        }
    }

}