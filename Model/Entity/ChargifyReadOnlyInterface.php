<?php

namespace Litwicki\Bundle\ChargifyBundle\Model\Entity;

Interface ChargifyReadOnlyInterface
{
    /**
     * @return mixed
     */
    public function getHandler();
}