<?php

namespace Litwicki\Bundle\ChargifyBundle\Handler;

use Litwicki\Bundle\ChargifyBundle\Services\ChargifyHandler;
use Litwicki\Bundle\ChargifyBundle\Services\ChargifyHandlerInterface;

use Litwicki\Bundle\ChargifyBundle\Model\Event;
use Litwicki\Bundle\ChargifyBundle\Model\Subscription;

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
            $items = $this->fetchMultiple($uri, 'ChargifyBundle\Model\Event', $query);
            return $items;
        }
        catch(\Exception $e) {
            throw $e;
        }
    }

}