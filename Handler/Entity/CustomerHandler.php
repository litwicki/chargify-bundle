<?php

namespace Litwicki\Bundle\ChargifyBundle\Handler\Entity;

use Litwicki\Bundle\ChargifyBundle\Model\Handler\ChargifyEntityHandler;
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

class CustomerHandler extends ChargifyEntityHandler
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
     * @param \Litwicki\Bundle\ChargifyBundle\Entity\Customer $entity
     * @param bool $auto_invite
     *
     * @throws \Exception
     */
    public function enableBillingPortal(Customer $entity, array $query = array())
    {
        try {

            $uri = sprintf('/portal/customers/%s/enable?%s',
                $entity->getId(),
                http_build_query($query)
            );

            $response = $this->request($uri, 'POST', $this->serialize($entity));

            return $this->apiResponse($response, $this->entityClass);

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

            $response = $this->request($uri, 'POST', $this->serialize($customer));
            return $this->apiResponse($response, '\Litwicki\Bundle\ChargifyBundle\Entity\ManagementLink');

        }
        catch(\Exception $e) {
            throw $e;
        }
    }

}