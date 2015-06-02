<?php

namespace Litwicki\Bundle\ChargifyBundle\Handler;

use Litwicki\Bundle\ChargifyBundle\Services\ChargifyHandler;
use Litwicki\Bundle\ChargifyBundle\Model\Coupon;

class CouponHandler extends ChargifyHandler
{

    /**
     * Create a new Coupon
     *
     * @param \Litwicki\Bundle\ChargifyBundle\Model\Coupon $entity
     *
     * @throws \Exception
     */
    public function create(Coupon $entity)
    {
        try {

            $uri = sprintf('/coupons');

            $request = $this->request($uri, 'POST', $this->entityToPostData($entity));

            $response = $this->formatResponse($request);

            return $this->assignValues($entity, $response);

        }
        catch (\Exception $e) {
            throw $e;
        }
    }

    /**
     * Find a Coupon by id.
     *
     * @param $id
     *
     * @throws \Exception
     */
    public function find($id)
    {
        try {

            $uri = sprintf('/coupons/%s',
                $id
            );

            $request = $this->request($uri);
            $response = $this->formatResponse($request);
            return $this->assignValues(new Coupon(), $response);

        }
        catch (\Exception $e) {
            throw $e;
        }
    }

    /**
     * Find a Coupon by code.
     *
     * @param $code
     *
     * @throws \Exception
     */
    public function findByCode($code)
    {
        try {

            $uri = sprintf('/coupons/find');
            $query = array('code' => $code);

            return $this->fetchMultiple($uri, '\ChargifyBundle\Model\Coupon', $query);

        }
        catch (\Exception $e) {
            throw $e;
        }
    }

    /**
     * Find a Coupon by code.
     *
     * @param $product_family_id
     *
     * @throws \Exception
     */
    public function findByProductFamily($product_family_id)
    {
        try {

            $uri = sprintf('/coupons/find');
            $query = array('product_family_id' => $product_family_id);

            return $this->fetchMultiple($uri, '\ChargifyBundle\Model\Coupon', $query);

        }
        catch (\Exception $e) {
            throw $e;
        }
    }

    /**
     * Save/Update a Coupon.
     *
     * @param \Litwicki\Bundle\ChargifyBundle\Model\Coupon $entity
     *
     * @throws \Exception
     */
    public function save(Coupon $entity)
    {
        try {

            $uri = sprintf('/coupons/%s',
                $entity->getId()
            );

            $request = $this->request($uri, 'PUT', $this->entityToPostData($entity));
            $response = $this->formatResponse($request);
            return $this->assignValues($entity, $response);

        }
        catch (\Exception $e) {
            throw $e;
        }
    }

    /**
     * Archive a Coupon.
     *
     * @param \Litwicki\Bundle\ChargifyBundle\Model\Coupon $entity
     *
     * @throws \Exception
     */
    public function archive(Coupon $entity)
    {
        try {

            $uri = sprintf('/coupons/%s',
                $entity->getId()
            );

            $request = $this->request($uri, 'DELETE', $this->entityToPostData($entity));
            $response = $this->formatResponse($request);

            return $response;

        }
        catch (\Exception $e) {
            throw $e;
        }
    }

    /**
     * Alias for archive()
     *
     * @param \Litwicki\Bundle\ChargifyBundle\Model\Coupon $entity
     *
     * @throws \Exception
     */
    public function delete(Coupon $entity)
    {
        return $this->archive($entity);
    }

    /**
     * Fetch usage for a coupon by id.
     * @see https://docs.chargify.com/api-coupons#api-coupon-usage
     *
     * @param \Litwicki\Bundle\ChargifyBundle\Model\Coupon $entity
     *
     * @throws \Exception
     * @return void $data
     */
    public function findUsage(Coupon $entity)
    {
        try {

            $uri = sprintf('/coupons/%s/usage',
                $entity->getId()
            );

            $request = $this->request($uri);
            $data = $this->formatResponse($request);

            return $data;

        }
        catch (\Exception $e) {
            throw $e;
        }
    }

    /**
     * You can verify if an specific coupon code is valid using the validate method.
     * This method is useful for validating coupon codes that are entered by a customer.
     * If the coupon is found and is valid, the coupon will be returned with a 200 status code.
     *
     * @param \Litwicki\Bundle\ChargifyBundle\Model\Coupon $entity
     *
     * @throws \Exception
     * @return string $response
     *                If invalid (404):
     *                Coupon not found
     *                Coupon is invalid
     *                Coupon expired
     */
    public function validate(Coupon $entity)
    {
        try {

            $uri = sprintf('/coupons/validate');
            $query = array('code' => $entity->getCode());

            if(!is_null($entity->getProductFamilyId())) {
                $query['product_family_id'] = $entity->getProductFamilyId();
            }

            $request = $this->request($uri, 'GET', null, $query);

            return $this->formatResponse($request);

        }
        catch (\Exception $e) {
            throw $e;
        }
    }

    /**
     * Fetch an array of codes associated with a coupon.
     *
     * @param \Litwicki\Bundle\ChargifyBundle\Model\Coupon $entity
     *
     * @throws \Exception
     */
    public function findSubCodes(Coupon $entity)
    {
        try {

            $uri = sprintf('/couponts/%s/codes',
                $entity->getId()
            );

            $request = $this->request($uri);

            return $this->formatResponse($request);

        }
        catch(\Exception $e) {
            throw $e;
        }
    }

    /**
     * Create additional sub code(s).
     *
     * @param \Litwicki\Bundle\ChargifyBundle\Model\Coupon $entity
     * @param array $codes
     *
     * @throws \Exception
     */
    public function createSubCode(Coupon $entity, $codes = array())
    {
        try {

            $uri = sprintf('/coupons/%s/codes',
                $entity->getId()
            );

            $request = $this->request($uri, 'POST', $codes);
            $response = $this->formatResponse($request);

            return $response;

        }
        catch(\Exception $e) {
            throw $e;
        }
    }

}