<?php

namespace Litwicki\Bundle\ChargifyBundle\Handler;

use Litwicki\Bundle\ChargifyBundle\Model\Handler\ChargifyHandler;

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

class CouponHandler extends ChargifyHandler
{

    /**
     * Create a new Coupon
     *
     * @param \Litwicki\Bundle\ChargifyBundle\Entity\Coupon $entity
     *
     * @throws \Exception
     */
    public function create(Coupon $entity)
    {
        try {

            $uri = sprintf('/coupons');

            $response = $this->request($uri, 'POST', $this->serialize($entity, $this->format()));

            return $this->apiResponse($response, $this->entityClass);

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
    public function get($id)
    {
        try {

            $uri = sprintf('/coupons/%s',
                $id
            );

            $response = $this->request($uri);
            return $this->apiResponse($response, $this->entityClass);

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
     * @return mixed
     * @throws \Exception
     */
    public function findByCode($code)
    {
        try {

            $uri = sprintf('/coupons/find');
            $query = array('code' => $code);

            return $this->fetchMultiple($uri, $this->entityClass, $query);

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
     * @return mixed
     * @throws \Exception
     */
    public function findByProductFamily($product_family_id)
    {
        try {

            $uri = sprintf('/coupons/find');
            $query = array('product_family_id' => $product_family_id);

            return $this->fetchMultiple($uri, $this->entityClass, $query);

        }
        catch (\Exception $e) {
            throw $e;
        }
    }

    /**
     * Save/Update a Coupon.
     *
     * @param \Litwicki\Bundle\ChargifyBundle\Entity\Coupon $entity
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
            $response = $this->responseToArray($request);
            return $this->assignValues($entity, $response);

        }
        catch (\Exception $e) {
            throw $e;
        }
    }

    /**
     * Archive a Coupon.
     *
     * @param \Litwicki\Bundle\ChargifyBundle\Entity\Coupon $entity
     *
     * @return mixed
     * @throws \Exception
     */
    public function archive(Coupon $entity)
    {
        try {

            $uri = sprintf('/coupons/%s',
                $entity->getId()
            );

            $request = $this->request($uri, 'DELETE', $this->serialize($entity, $this->format()));
            $response = $this->responseToArray($request);

            return $response;

        }
        catch (\Exception $e) {
            throw $e;
        }
    }

    /**
     * Alias for archive()
     *
     * @param \Litwicki\Bundle\ChargifyBundle\Entity\Coupon $entity
     *
     * @return mixed
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
     * @param \Litwicki\Bundle\ChargifyBundle\Entity\Coupon $entity
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
            $data = $this->responseToArray($request);

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
     * @param \Litwicki\Bundle\ChargifyBundle\Entity\Coupon $entity
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

            return $this->responseToArray($request);

        }
        catch (\Exception $e) {
            throw $e;
        }
    }

    /**
     * Fetch an array of codes associated with a coupon.
     *
     * @param \Litwicki\Bundle\ChargifyBundle\Entity\Coupon $entity
     *
     * @return mixed
     * @throws \Exception
     */
    public function findSubCodes(Coupon $entity)
    {
        try {

            $uri = sprintf('/couponts/%s/codes',
                $entity->getId()
            );

            $request = $this->request($uri);

            return $this->responseToArray($request);

        }
        catch(\Exception $e) {
            throw $e;
        }
    }

    /**
     * Create additional sub code(s).
     *
     * @param \Litwicki\Bundle\ChargifyBundle\Entity\Coupon $entity
     * @param array $codes
     *
     * @return mixed
     * @throws \Exception
     */
    public function createSubCode(Coupon $entity, $codes = array())
    {
        try {

            $uri = sprintf('/coupons/%s/codes',
                $entity->getId()
            );

            $request = $this->request($uri, 'POST', $codes);
            $response = $this->responseToArray($request);

            return $response;

        }
        catch(\Exception $e) {
            throw $e;
        }
    }

}