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

class ProductHandler extends ChargifyEntityHandler
{

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

            $uri = sprintf('%s/handle/%s',
                $this->getUri(),
                $handle
            );

            $response = $this->request($uri);
            return $this->apiResponse($response->getBody(), $this->entityClass);

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
    public function create(ChargifyEntityInterface $entity, $product_family_id)
    {
        try {

            $uri = sprintf('/product_families/%s/products',
                $product_family_id
            );

            $response = $this->request($uri, $this->serialize($entity));
            return $this->apiResponse($response, $this->entityClass);

        }
        catch (\Exception $e) {
            throw $e;
        }
    }

}