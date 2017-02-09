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

class ProductHandler extends ChargifyHandler
{

    /**
     * Find all products in a specific Product Family.
     *
     * @param $product_family_id
     *
     * @return mixed
     * @throws \Exception
     */
    public function getAll($product_family_id)
    {
        try {

            $uri = sprintf('/product_families/%s/products',
                $product_family_id
            );

            $response = $this->request($uri);
            return $this->fetchMultiple($uri, '\Litwicki\Bundle\ChargifyBundle\Entity\Product', $response);

        }
        catch (\Exception $e) {
            throw $e;
        }
    }

    /**
     * Find a product by Id.
     *
     * @param $id
     *
     * @throws \Exception
     */
    public function get($id)
    {
        try {

            $uri = sprintf('/products/%s',
                $id
            );

            $response = $this->request($uri);
            return $this->apiResponse($response, '\Litwicki\Bundle\ChargifyBundle\Entity\Product', $this->format());

        }
        catch (\Exception $e) {
            throw $e;
        }
    }

    /**
     * Find a product by Handle.
     *
     * @param string $handle
     *
     * @throws \Exception
     */
    public function findByHandle($handle)
    {
        try {

            $uri = sprintf('/products/handle/%s',
                $handle
            );

            $response = $this->request($uri);
            return $this->apiResponse($response, '\Litwicki\Bundle\ChargifyBundle\Entity\Product', $this->format());

        }
        catch (\Exception $e) {
            throw $e;
        }
    }

    /**
     * Create a Product.
     *
     * @param \Litwicki\Bundle\ChargifyBundle\Entity\Product $entity
     * @param $product_family_id
     *
     * @throws \Exception
     */
    public function create(Product $entity, $product_family_id)
    {
        try {

            $uri = sprintf('/product_families/%s/products',
                $product_family_id
            );

            $response = $this->request($uri, $this->serializer()->serialize($entity, $this->format()));
            return $this->apiResponse($response, '\Litwicki\Bundle\ChargifyBundle\Entity\Product', $this->format());

        }
        catch (\Exception $e) {
            throw $e;
        }
    }

}