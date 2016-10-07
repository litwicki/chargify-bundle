<?php

namespace Litwicki\Bundle\ChargifyBundle\Services;

Interface ChargifyReadOnlyInterface
{
    /**
     * @return mixed
     */
    public function getHandler();
}