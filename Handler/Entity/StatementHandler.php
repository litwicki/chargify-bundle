<?php

namespace Litwicki\Bundle\ChargifyBundle\Handler\Entity;

use Litwicki\Bundle\ChargifyBundle\Model\Handler\ChargifyEntityHandler;

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

class ProductHandler extends ChargifyEntityHandler
{
    /**
     * Find all statement Ids for the default site.
     *
     * Say you would like to get the 10 most recently created statements.
     * You would specify the following optional parameters sort as created_at, direction as desc and limit your per_page to 10.
     *
     * If you on the other hand wish to find the oldest closed statements you could do: sort as closed_at and direction as asc.
     *
     * @param array $query
     *
     * @throws \Exception
     * @return array of ids
     */
    public function getAll($query = array())
    {
        try {

            $uri = sprintf('/statements/ids');

            if (empty($query)) {
                $response = $this->request($uri);
            } else {
                $response = $this->request($uri, 'GET', null, http_build_query($query));
            }

            return $this->apiResponse($response->getBody(), $this->entityClass);

        } catch (\Exception $e) {
            throw $e;
        }
    }

    /**
     * Find a statement.
     *
     * @param $id
     *
     * @throws \Exception
     */
    public function get($id)
    {
        try {

            $uri = sprintf('/statements/%s', $id);
            $response = $this->request($uri);
            return $this->apiResponse($response, $this->entityClass);

        } catch (\Exception $e) {
            throw $e;
        }
    }
}