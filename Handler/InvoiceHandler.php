<?php

namespace Litwicki\Bundle\ChargifyBundle\Handler;

use Litwicki\Bundle\ChargifyBundle\Services\ChargifyHandler;
use Litwicki\Bundle\ChargifyBundle\Services\ChargifyHandlerInterface;

use Litwicki\Bundle\ChargifyBundle\Model\Charge;
use Litwicki\Bundle\ChargifyBundle\Model\Adjustment;
use Litwicki\Bundle\ChargifyBundle\Model\Payment;

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
            return $this->fetchMultiple($uri, '\Litwicki\Bundle\ChargifyBundle\Model\Invoice');
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
            return $this->serializer()->deserialize($response, '\Litwicki\Bundle\ChargifyBundle\Model\Invoice', $this->format());

        }
        catch(\Exception $e) {
            throw $e;
        }
    }

    /**
     * Send an Invoice payment.
     *
     * @param \Litwicki\Bundle\ChargifyBundle\Handler\Invoice $entity
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
            return $this->serializer()->deserialize($response, '\Litwicki\Bundle\ChargifyBundle\Model\Payment', $this->format());

        }
        catch (\Exception $e) {
            throw $e;
        }
    }

    /**
     * Credit (Adjust) an invoice.
     *
     * @param \Litwicki\Bundle\ChargifyBundle\Handler\Invoice $entity
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
            return $this->serializer()->deserialize($response, '\Litwicki\Bundle\ChargifyBundle\Model\Adjustment', $this->format());

        }
        catch (\Exception $e) {
            throw $e;
        }
    }

    /**
     * Apply a Charge to an Invoice.
     *
     * @param \Litwicki\Bundle\ChargifyBundle\Handler\Invoice $entity
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
            return $this->serializer()->deserialize($response, '\Litwicki\Bundle\ChargifyBundle\Model\Charge', $this->format());

        }
        catch (\Exception $e) {
            throw $e;
        }
    }

}