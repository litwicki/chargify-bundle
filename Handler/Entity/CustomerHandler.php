<?php

namespace Litwicki\Bundle\ChargifyBundle\Handler\Entity;

use Litwicki\Bundle\ChargifyBundle\Model\Handler\ChargifyHandler;
use Litwicki\Bundle\ChargifyBundle\Model\Handler\ChargifyHandlerInterface;

use Litwicki\Bundle\ChargifyBundle\Entity\Adjustment;
use Litwicki\Bundle\ChargifyBundle\Entity\Allocation;
use Litwicki\Bundle\ChargifyBundle\Entity\Charge;
use Litwicki\Bundle\ChargifyBundle\Entity\Component;
use Litwicki\Bundle\ChargifyBundle\Entity\Coupon;
use Litwicki\Bundle\ChargifyBundle\Entity\Credit;
use Litwicki\Bundle\ChargifyBundle\Entity\Customer;
use Litwicki\Bundle\ChargifyBundle\Entity\Event;
use Litwicki\Bundle\ChargifyBundle\Entity\Invoice;
use Litwicki\Bundle\ChargifyBundle\Entity\ManagementLink;
use Litwicki\Bundle\ChargifyBundle\Entity\Migration;
use Litwicki\Bundle\ChargifyBundle\Entity\Payment;
use Litwicki\Bundle\ChargifyBundle\Entity\PaymentProfile;
use Litwicki\Bundle\ChargifyBundle\Entity\Product;
use Litwicki\Bundle\ChargifyBundle\Entity\Refund;
use Litwicki\Bundle\ChargifyBundle\Entity\RenewalPreview;
use Litwicki\Bundle\ChargifyBundle\Entity\Statement;
use Litwicki\Bundle\ChargifyBundle\Entity\Subscription;
use Litwicki\Bundle\ChargifyBundle\Entity\Transaction;
use Litwicki\Bundle\ChargifyBundle\Entity\Webhook;

class CustomerHandler extends ChargifyHandler implements ChargifyHandlerInterface
{

    /**
     * Set the Reference value for this Customer. By default it will be the Id, unless
     * we pass a $value to set.
     *
     * @param $entity
     * @param null $value
     * @return mixed
     * @throws \Exception
     */
    public function setReference(ChargifyEntityInterface $entity, $value = null)
    {
        try {

            $reference = (is_null($value)) ? $entity->getId() : $value;

            if(is_null($entity->getReference())) {
                $entity->setReference($reference);
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

            $response = $this->request($uri, 'POST', $this->serialize($entity, $this->format()));

            return $this->apiResponse($response, $this->entityClass);

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
                $this->format(),
                $reference
            );

            $response = $this->request($uri);

            return $this->apiResponse($response, $this->entityClass);

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
    public function get($id)
    {
        try {

            $uri = sprintf('/customers/%s',
                $id
            );

            $response = $this->request($uri);

            $json = json_decode($response->getBody(), true);
            $xml = array(); //@TODO: fix for XML :)
            
            $body = $this->format() == 'json' ? $json : $xml;

            return $this->apiResponse($body, $this->entityClass);

        }
        catch(\Exception $e) {
            throw $e;
        }
    }

    /**
     * @param int $page
     * @param string $sort
     *
     * @return mixed
     * @throws \Exception
     */
    public function getAll($page = 1, $sort = 'asc')
    {
        try {

            $uri = sprintf('/customers');
            $query = array('page' => $page, 'direction' => $sort);

            return $this->fetchMultiple($uri, $this->entityClass, $query);

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

            $response = $this->request($uri, 'PUT', $this->serialize($entity, $this->format()));

            return $this->apiResponse($response, $this->entityClass);

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

            $result = $this->request($uri, 'POST', $this->serialize($entity, $this->format()), $query);

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
            return $this->apiResponse($response, '\Litwicki\Bundle\ChargifyBundle\Entity\ManagementLink');

        }
        catch(\Exception $e) {
            throw $e;
        }
    }

}