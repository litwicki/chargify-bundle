<?php

namespace Litwicki\Bundle\ChargifyBundle\Handler\Entity;

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

class CouponHandler extends ChargifyEntityHandler
{
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

            $query = array('code' => $code);

            $uri = sprintf('/coupons/find?%s',
                http_build_query($query)
            );

            $response = $this->request($uri, 'GET');
            return $this->apiResponse($response->getBody(), $this->entityClass);

        }
        catch (\Exception $e) {
            throw $e;
        }
    }

    /**
     * Find a Coupon by Product Family.
     *
     * @param $product_family_id
     *
     * @return mixed
     * @throws \Exception
     */
    public function findByProductFamily($product_family_id)
    {
        try {

            $query = array('product_family_id' => $product_family_id);

            $uri = sprintf('/coupons/find?%s',
                http_build_query($query)
            );

            $response = $this->request($uri, 'GET');
            return $this->apiResponse($response->getBody(), $this->entityClass);

        }
        catch (\Exception $e) {
            throw $e;
        }
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

            $response = $this->request($uri, 'GET');
            return $this->apiResponse($response->getBody(), $this->entityClass);

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

            $query = array('code' => $entity->getCode());

            if(!is_null($entity->getProductFamilyId())) {
                $query['product_family_id'] = $entity->getProductFamilyId();
            }

            $uri = sprintf('/coupons/validate?%s',
                http_build_query($query)
            );

            $response = $this->request($uri, 'GET', null, $query);

            return $this->apiResponse($response->getBody(), $this->entityClass);

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

            $response = $this->request($uri);

            return $this->apiResponse($response->getBody(), $this->entityClass);

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

            $response = $this->request($uri, 'POST', $codes);
            return $this->apiResponse($response->getBody(), $this->entityClass);

        }
        catch(\Exception $e) {
            throw $e;
        }
    }

}