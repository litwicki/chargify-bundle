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
            $items = $this->fetchMultiple($uri, 'ChargifyBundle\Model\Invoice');
            return $items;
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

            $request = $this->request($uri);
            $response = $this->formatResponse($request);
            return $this->assignValues(new Invoice(), $response);

        }
        catch(\Exception $e) {
            throw $e;
        }
    }

    /**
     * Send an Invoice payment.
     *
     * @param \ChargifyBundle\Handler\Invoice $entity
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

            $request = $this->request($uri, 'POST', $this->postData($data));
            $response = $this->formatResponse($request);
            return $this->assignValues(new Payment(), $response);

        }
        catch (\Exception $e) {
            throw $e;
        }
    }

    /**
     * Credit (Adjust) an invoice.
     *
     * @param \ChargifyBundle\Handler\Invoice $entity
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

            $request = $this->request($uri, 'POST', $this->postData($data));
            $response = $this->formatResponse($request);
            return $this->assignValues(new Adjustment($entity->getSubscriptionId()), $response);

        }
        catch (\Exception $e) {
            throw $e;
        }
    }

    /**
     * Apply a Charge to an Invoice.
     *
     * @param \ChargifyBundle\Handler\Invoice $entity
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

            $request = $this->request($uri, 'POST', $this->postData($data));
            $response = $this->formatResponse($request);
            return $this->assignValues(new Charge($entity->getSubscriptionId()), $response);

        }
        catch (\Exception $e) {
            throw $e;
        }
    }

}