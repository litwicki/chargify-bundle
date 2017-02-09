<?php

namespace Litwicki\Bundle\ChargifyBundle\Handler\Entity;

use Litwicki\Bundle\ChargifyBundle\Model\Handler\ChargifyEntityHandler;
use Litwicki\Bundle\ChargifyBundle\Model\Handler\ChargifyHandlerInterface;

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

class InvoiceHandler extends ChargifyEntityHandler
{

    /**
     * Send an Invoice payment.
     *
     * @param \Litwicki\Bundle\ChargifyBundle\Entity\Invoice $entity
     * @param $data
     *
     * @throws \Exception
     */
    public function pay(Invoice $entity, $data)
    {
        try {

            $uri = sprintf('%s/%s/payments',
                $this->getUri(),
                $entity->getId()
            );

            $response = $this->request($uri, 'POST', $this->serialize($data));
            return $this->apiResponse($response, '\Litwicki\Bundle\ChargifyBundle\Entity\Payment');

        }
        catch (\Exception $e) {
            throw $e;
        }
    }

    /**
     * Credit (Adjust) an invoice.
     *
     * @param \Litwicki\Bundle\ChargifyBundle\Entity\Invoice $entity
     * @param $data
     *
     * @throws \Exception
     */
    public function credit(Invoice $entity, $data)
    {
        try {

            $uri = sprintf('/invoices/%s/credits',
                $entity->getId()
            );

            $response = $this->request($uri, 'POST', $this->serialize($data));
            return $this->apiResponse($response, '\Litwicki\Bundle\ChargifyBundle\Entity\Adjustment');

        }
        catch (\Exception $e) {
            throw $e;
        }
    }

    /**
     * Apply a Charge to an Invoice.
     *
     * @param \Litwicki\Bundle\ChargifyBundle\Entity\Invoice $entity
     * @param $data
     *
     * @throws \Exception
     */
    public function charge(Invoice $entity, $data)
    {
        try {

            $uri = sprintf('/invoices/%s/credits',
                $entity->getId()
            );

            $response = $this->request($uri, 'POST', $this->serialize($data));
            return $this->apiResponse($response, '\Litwicki\Bundle\ChargifyBundle\Entity\Charge');

        }
        catch (\Exception $e) {
            throw $e;
        }
    }

}