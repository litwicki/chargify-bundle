<?php

namespace Litwicki\Bundle\ChargifyBundle\Model\Handler;

Interface ChargifyHandlerInterface
{

    /**
     * Create an object.
     *
     * @param $entity
     *
     * @return mixed
     */
    public function create($entity);

    /**
     * Save an existing object.
     *
     * @param $entity
     *
     * @return mixed
     */
    public function save($entity);

    /**
     * Delete an object.
     *
     * @param $entity
     *
     * @return mixed
     */
    public function delete($entity);

}