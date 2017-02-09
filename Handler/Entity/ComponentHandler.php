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

class ComponentHandler extends ChargifyEntityHandler
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

            return sprintf('product_families/%s/%s',
                $entity->getProductFamilyId(),
                $this->getComponentUri()
            );

        }
        catch(\Exception $e) {
            throw $e;
        }
    }

    /**
     * @param ChargifyEntityInterface $entity
     * @return string
     * @throws \Exception
     */
    public function getComponentUri(ChargifyEntityInterface $entity)
    {
        try {

            if(!$entity instanceof ChargifyComponentEntity) {
                throw new \Exception(sprintf("Component Uri requires ChargifyComponentEntity, %s given.", get_class($entity)));
            }

            //['metered_component', 'quantity_based_component', 'on_off_component']

            switch($entity->getKind()) {

                case 'metered_component':
                    return 'metered_components';
                case 'quantity_based_component':
                    return 'quantity_based_components';
                case 'on_off_component':
                    return 'on_off_components';
                default:
                    //this should never be hit!
                    throw new \Exception('Invalid Component Kind: %s', $entity->getKind());
                    break;
            }

        }
        catch(\Exception $e) {
            throw $e;
        }
    }


    /**
     * get all Component line-items by subscription.
     *
     * @param $subscription_id
     *
     * @return mixed
     * @throws \Exception
     */
    public function getAllBySubscription($subscription_id)
    {
        try {

            $uri = sprintf('/subscriptions/%s/components',
                $subscription_id
            );

            return $this->fetchMultiple($uri, $this->entityClass);

        }
        catch (\Exception $e) {
            throw $e;
        }
    }

    /**
     * @param $subscription_id
     * @param $component_id
     *
     * @throws \Exception
     */
    public function getBySubscriptionAndComponentId($subscription_id, $component_id)
    {
        try {

            $uri = sprintf('/subscriptions/%s/components/%s',
                $subscription_id,
                $component_id
            );

            $response = $this->request($uri);
            return $this->apiResponse($response, $this->entityClass);

        }
        catch (\Exception $e) {
            throw $e;
        }
    }

    /**
     * get all Component line items by product family.
     *
     * @param $id
     *
     * @return mixed
     * @throws \Exception
     */
    public function getAllByProductFamily($id, array $query = array())
    {
        try {

            $uri = sprintf('/product_families/%s/components',
                $id
            );

            $response = $this->request($uri, 'GET', array(), $query);
            return $this->apiResponse($response->getBody(), '\Litwicki\Bundle\ChargifyBundle\Model\Entity\ChargifyEntityInterface');

        }
        catch (\Exception $e) {
            throw $e;
        }
    }

    /**
     * get Component line-item by product family and component id
     *
     * @param $product_family_id
     * @param $component_id
     *
     * @param array $query
     * @return mixed
     * @throws \Exception
     */
    public function getByProductFamily($product_family_id, $component_id, array $query = array())
    {
        try {

            $uri = sprintf('/product_families/%s/components/%s',
                $product_family_id,
                $component_id
            );

            $response = $this->request($uri, 'GET');
            return $this->apiResponse($response->getBody(), '\Litwicki\Bundle\ChargifyBundle\Model\Entity\ChargifyEntityInterface');

        }
        catch (\Exception $e) {
            throw $e;
        }
    }

}