<?php

namespace Litwicki\Bundle\ChargifyBundle\Model\Entity;

Interface ChargifyEntityInterface
{

    /**
     * @return mixed
     */
    public function __toString();

    /**
     * @return mixed
     */
    public function getXmlRootName();

    /**
     * @return mixed
     */
    public function getId();

}