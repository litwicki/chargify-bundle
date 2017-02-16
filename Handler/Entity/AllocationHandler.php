<?php

namespace Litwicki\Bundle\ChargifyBundle\Handler\Entity;

use Litwicki\Bundle\ChargifyBundle\Model\Entity\ChargifyComponentEntity;
use Litwicki\Bundle\ChargifyBundle\Model\Entity\ChargifyEntityInterface;
use Litwicki\Bundle\ChargifyBundle\Model\Handler\ChargifyEntityHandler;

use Litwicki\Bundle\ChargifyBundle\Entity\Adjustment;
use Litwicki\Bundle\ChargifyBundle\Entity\Allocation;
use Litwicki\Bundle\ChargifyBundle\Entity\Charge;
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

class AllocationHandler extends ChargifyEntityHandler
{
    /**
     * Define the CREATE (POST) URI for an Adjustment.
     *
     * @param ChargifyEntityInterface $entity
     * @return string
     */
    public function getUri(ChargifyEntityInterface $entity = null)
    {
        try {

            return sprintf('/subscriptions/%s/components/%s/allocations',
                $entity->getSubscriptionId(),
                $entity->getComponentId()
            );

        } catch (\Exception $e) {
            throw $e;
        }
    }

    /**
     * @param $entities
     *
     * @return array
     * @throws \Exception
     */
    public function createAllocations($entities)
    {
        try {

            foreach($entities as $entity) {
                $items[] = $this->create($entity);
            }

            /*
             * @TODO: fix nested serialization here because each $item is a json string, so this is
             * going to be very ugly...
             */
            return $this->apiResponse($items, '\Litwicki\Bundle\ChargifyBundle\Entity\Allocation');

        }
        catch(\Exception $e) {
            throw $e;
        }
    }

    /**
     * Return all allocations 50 records per page.
     *
     * @param $entity
     * @param int $page
     *
     * @throws \Exception
     */
    public function getAll(Allocation $entity, array $query = array())
    {
        try {

            $uri = sprintf('/subscriptions/%s/components/%s/allocations?%s',
                $entity->getSubscriptionId(),
                $entity->getComponentId(),
                http_build_query($query)
            );

            $response = $this->request($uri, 'GET');

            return $this->apiResponse($response->getBody(), '\Litwicki\Bundle\ChargifyBundle\Entity\Allocation');

        }
        catch(\Exception $e) {
            throw $e;
        }
    }

}