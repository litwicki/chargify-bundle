<?php

namespace Litwicki\Bundle\ChargifyBundle\Handler;

use Litwicki\Bundle\ChargifyBundle\Model\Handler\ChargifyHandler;
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

abstract class InvoiceHandler extends ChargifyHandler implements ChargifyHandlerInterface
{

    /**
     * Fetch a paged result set of Invoices.
     *
     * @throws \Exception
     * @return void $items array
     */
    public function findAll()
    {
        try {
            $uri = 'events';
            return $this->fetchMultiple($uri, '\Litwicki\Bundle\ChargifyBundle\Entity\Invoice');
        }
        catch(\Exception $e) {
            throw $e;
        }
    }

    /**
     * Fetch an Invoice by Id.
     *
     * @param $id
     *
     * @throws \Exception
     */
    public function find($id)
    {
        try {

            $uri = sprintf('/invoices/%s',
                $id
            );

            $response = $this->request($uri);
            return $this->serializer()->deserialize($response, '\Litwicki\Bundle\ChargifyBundle\Entity\Invoice', $this->format());

        }
        catch(\Exception $e) {
            throw $e;
        }
    }

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

            $uri = sprintf('/invoices/%s/payments',
                $entity->getId()
            );

            $response = $this->request($uri, 'POST', $this->postData($data));
            return $this->serializer()->deserialize($response, '\Litwicki\Bundle\ChargifyBundle\Entity\Payment', $this->format());

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

            $response = $this->request($uri, 'POST', $this->postData($data));
            return $this->serializer()->deserialize($response, '\Litwicki\Bundle\ChargifyBundle\Entity\Adjustment', $this->format());

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

            $response = $this->request($uri, 'POST', $this->postData($data));
            return $this->serializer()->deserialize($response, '\Litwicki\Bundle\ChargifyBundle\Entity\Charge', $this->format());

        }
        catch (\Exception $e) {
            throw $e;
        }
    }

}