<?php

namespace Litwicki\Bundle\ChargifyBundle\Handler;

use Litwicki\Bundle\ChargifyBundle\Services\ChargifyHandler;
use Litwicki\Bundle\ChargifyBundle\Model\Component;

class ComponentHandler extends ChargifyHandler
{

    /**
     * Find all Component line-items by subscription.
     *
     * @param $subscription_id
     *
     * @throws \Exception
     */
    public function findAllBySubscription($subscription_id)
    {
        try {

            $uri = sprintf('/subscriptions/%s/components',
                $subscription_id
            );

            return $this->fetchMultiple($uri, '\ChargifyBundle\Model\Component');

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
    public function findBySubscriptionAndComponentId($subscription_id, $component_id)
    {
        try {

            $uri = sprintf('/subscriptions/%s/components/%s',
                $subscription_id,
                $component_id
            );

            $response = $this->request($uri);

            $data = $this->formatResponse($response);

            return $this->assignValues(new Component(), $data);

        }
        catch (\Exception $e) {
            throw $e;
        }
    }

    /**
     * @param \Litwicki\Bundle\ChargifyBundle\Model\Component $entity
     * @param string $plural_kind
     *  options: metered_components, quantity_based_components, on_off_components
     *
     * @throws \Exception
     */
    public function create(Component $entity, $plural_kind)
    {
        try {

            $uri = sprintf('product_families/%s/%s',
                $entity->getProductFamilyId(),
                $plural_kind
            );

            $response = $this->request($uri, 'POST', $this->entityToPostData($entity));

            $data = $this->formatResponse($response);

            return $this->assignValues($entity, $data);

        }
        catch (\Exception $e) {
            throw $e;
        }
    }

    /**
     * Find all Component line items by product family.
     *
     * @param $product_family_id
     *
     * @throws \Exception
     */
    public function findAllByProductFamily($product_family_id)
    {
        try {

            $uri = sprintf('/product_families/%s/components',
                $product_family_id
            );

            return $this->fetchMultiple($uri, '\ChargifyBundle\Model\Component');

        }
        catch (\Exception $e) {
            throw $e;
        }
    }

    /**
     * Find Component line-item by product family and component id
     *
     * @param $product_family_id
     * @param $component_id
     *
     * @throws \Exception
     */
    public function findByProductFamily($product_family_id, $component_id)
    {
        try {

            $uri = sprintf('/product_families/%s/components/%s',
                $product_family_id,
                $component_id
            );

            $response = $this->request($uri);

            $data = $this->formatResponse($response);

            return $this->assignValues(new Component(), $data);

        }
        catch (\Exception $e) {
            throw $e;
        }
    }

    /**
     * @param \Litwicki\Bundle\ChargifyBundle\Handler\Component $entity
     *
     * @throws \Exception
     */
    public function createUsage(Component $entity)
    {
        try {

            $uri = sprintf('/subscriptions/%s/components/%s',
                $entity->getSubscriptionId(),
                $entity->getId()
            );

            $response = $this->request($uri, $this->entityToPostData($entity));
            $data = $this->formatResponse($response);

            return $this->assignValues($entity, $data);

        }
        catch (\Exception $e) {
            throw $e;
        }
    }

    /**
     * Create an adjustment on a subscription.
     *
     * @param $entity
     *
     * @throws \Exception
     */
    public function createAllocation(Allocation $entity)
    {
        try {

            $uri = sprintf('/subscriptions/%s/components/%s/allocations',
                $entity->getSubscriptionId(),
                $entity->getComponentId()
            );

            $result = $this->request($uri, 'POST', $this->entityToPostData($entity));

            $data = $this->formatResponse($result);

            return $this->assignValues($entity, $data);

        }
        catch(\Exception $e) {
            throw $e;
        }
    }

    /**
     * @param $entities
     *
     * @throws \Exception
     */
    public function createAllocations($entities)
    {
        try {

            $responses = array();

            foreach($entities as $entity) {

                $uri = sprintf('/subscriptions/%s/allocations',
                    $entity->getSubscriptionId()
                );

                $result = $this->request($uri, 'POST', $this->entityToPostData($entity));

                $responses[] = $this->getResponse($result);

            }

            return $responses;

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
    public function findAllocations(Allocation $entity, $page = 1)
    {
        try {

            $uri = sprintf('/subscriptions/%s/components/%s/allocations?%s',
                $entity->getSubscriptionId(),
                $entity->getComponentId(),
                http_build_query(array('page' => $page))
            );

            $result = $this->request($uri);

            return $this->getResponse($result);

        }
        catch(\Exception $e) {
            throw $e;
        }
    }

}