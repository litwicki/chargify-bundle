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

class ChargeHandler extends ChargifyHandler
{
    /**
     * @param $entity
     *
     * @throws \Exception
     */
    public function create(Charge $entity)
    {
        try {

            $uri = sprintf('subscriptions/%s/charges',
                $entity->getSubscriptionId()
            );

            $response = $this->request($uri, 'POST', $this->serializer()->serialize($entity, $this->format()));
            return $this->serializer()->deserialize($response, '\Litwicki\Bundle\ChargifyBundle\Entity\Charge', $this->format());

        }
        catch(\Exception $e) {
            throw $e;
        }
    }
}