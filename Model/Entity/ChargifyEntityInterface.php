<?php

namespace Litwicki\Bundle\ChargifyBundle\Model\Entity;

Interface ChargifyEntityInterface
{
    function __toString();

    public function getXmlRootName();
}