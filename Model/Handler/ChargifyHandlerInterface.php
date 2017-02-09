<?php

namespace Litwicki\Bundle\ChargifyBundle\Model\Handler;

use Litwicki\Bundle\ChargifyBundle\Model\Entity\ChargifyEntityInterface;

Interface ChargifyHandlerInterface
{

    /**
     * Create an object.
     *
     * @param $entity
     *
     * @return mixed
     */
    public function create(ChargifyEntityInterface $entity);

    /**
     * Save an existing object.
     *
     * @param $entity
     *
     * @return mixed
     */
    public function save(ChargifyEntityInterface $entity);

    /**
     * Delete an object.
     *
     * @param $entity
     *
     * @return mixed
     */
    public function delete(ChargifyEntityInterface $entity);


    /**
     * Get a specific Entity by Id.
     *
     * @param $id
     * @return mixed
     */
    public function get($id, array $options);

    /**
     * Get all Entities.
     *
     * @param array $options
     * @return mixed
     */
    public function getAll(array $options);

}