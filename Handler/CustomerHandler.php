<?php

namespace Litwicki\Bundle\ChargifyBundle\Handler;

use Litwicki\Bundle\ChargifyBundle\Model\Handler\ChargifyHandler;
use Litwicki\Bundle\ChargifyBundle\Model\Handler\ChargifyHandlerInterface;

use Litwicki\Bundle\ChargifyBundle\Entity\Customer;

class CustomerHandler extends ChargifyHandler implements ChargifyHandlerInterface
{

    /**
     * Set the Reference field equal to the email. This stops duplicates from being
     * created under the same email address, and allows reverse lookup to the local
     * system, assuming email addresses are also unique locally.
     * @param $entity
     *
     * @throws \Exception
     */
    public function setReference($entity)
    {
        try {

//            if($entity->getId()) {
//                throw new \Exception('Cannot assign Reference value to an existing Customer!');
//            }

            if(is_null($entity->getReference())) {
                $entity->setReference($entity->getEmail());
            }

            return $entity;

        }
        catch(\Exception $e) {
            throw $e;
        }
    }

    /**
     * Create an adjustment on a subscription.
     *
     * @param $entity
     *
     * @return mixed|void
     * @throws \Exception
     */
    public function create($entity)
    {
        try {

            $entity = $this->setReference($entity);

            $uri = sprintf('/customers');

            $response = $this->request($uri, 'POST', $this->serializer()->serialize($entity, $this->format()));

            return $this->serializer()->deserialize($response, '\Litwicki\Bundle\ChargifyBundle\Entity\Customer', $this->format());

        }
        catch(\Exception $e) {
            throw $e;
        }
    }

    /**
     * Find a Customer by Reference Id.
     *
     * @param $reference
     *
     * @throws \Exception
     */
    public function findByReference($reference)
    {
        try {

            $uri = sprintf('/customers/lookup.%s?reference=%s',
                $this->getFormat(),
                $reference
            );

            $response = $this->request($uri);

            return $this->serializer()->deserialize($response, '\Litwicki\Bundle\ChargifyBundle\Entity\Customer', $this->format());

            return $entity;

        }
        catch(\Exception $e) {
            throw $e;
        }
    }


    /**
     * Find a Customer record by primary identifier
     *
     * @throws \Exception
     */
    public function find($id)
    {
        try {

            $uri = sprintf('/customers/%s',
                $id
            );

            $response = $this->request($uri);

            return $this->serializer()->deserialize($response, '\Litwicki\Bundle\ChargifyBundle\Entity\Customer', $this->format());

        }
        catch(\Exception $e) {
            throw $e;
        }
    }

    /**
     * @param int $page
     *
     * @throws \Exception
     */
    public function findAll($page = 1, $sort = 'asc')
    {
        try {

            $uri = sprintf('/customers');
            $query = array('page' => $page, 'direction' => $sort);

            return $this->fetchMultiple($uri, '\Litwicki\Bundle\ChargifyBundle\Entity\Customer', $query);

        }
        catch(\Exception $e) {
            throw $e;
        }
    }

    /**
     * Save this entity.
     *
     * @throws \Exception
     */
    public function save($entity)
    {
        try {

            $entity = $this->setReference($entity);

            $uri = sprintf('/customers/%s',
                $entity->getId()
            );

            $response = $this->request($uri, 'PUT', $this->serializer()->serialize($entity, $this->format()));

            return $this->serializer()->deserialize($response, '\Litwicki\Bundle\ChargifyBundle\Entity\Customer', $this->format());

        }
        catch(\Exception $e) {
            throw $e;
        }

    }

    /**
     * Delete this entity.
     *
     * @throws \Exception
     */
    public function delete($id)
    {
        try {

            $uri = sprintf('/customers/%s',
                $id
            );

            $result = $this->request($uri, 'DELETE');

            return $result->response;

        }
        catch(\Exception $e) {
            throw $e;
        }
    }

    /**
     * @param \Litwicki\Bundle\ChargifyBundle\Entity\Customer $entity
     * @param bool $auto_invite
     *
     * @throws \Exception
     */
    public function enableBillingPortal(Customer $entity, $auto_invite = false)
    {
        try {

            $uri = sprintf('/portal/customers/%s/enable',
                $entity->getId()
            );

            $query = array();
            if($auto_invite) {
                $query['auto_invite'] = $auto_invite;
            }

            $result = $this->request($uri, 'POST', $this->serializer()->serialize($entity, $this->format()), $query);

            return $result->response;

        }
        catch(\Exception $e) {
            throw $e;
        }
    }

    /**
     * @param \Litwicki\Bundle\ChargifyBundle\Entity\Customer $customer
     *
     * @throws \Exception
     */
    public function getManagementLink(Customer $customer)
    {
        try {

            $uri = sprintf('/portal/customers/%/management_link',
                $customer->getId()
            );

            $response = $this->request($uri, 'POST', $this->serialize()->serialize($customer, $this->format()));
            return $this->serializer()->deserialize($response, '\Litwicki\Bundle\ChargifyBundle\Entity\ManagementLink', $this->format());

        }
        catch(\Exception $e) {
            throw $e;
        }
    }

}