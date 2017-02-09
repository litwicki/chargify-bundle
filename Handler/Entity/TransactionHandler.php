<?php

namespace Litwicki\Bundle\ChargifyBundle\Handler\Entity;

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

class TransactionHandler extends ChargifyHandler
{

    /**
     * List all Webhooks for a Site.
     *
     * @param array $options
     *
     * kinds[] An array of transaction types (see above). Multiple values can be passed in the url, for example: http://example.com?kinds[]=charge&kinds[]=payment&kinds[]=credit
     * since_id Returns transactions with an id greater than or equal to the one specified
     * max_id Returns transactions with an id less than or equal to the one specified
     * since_date (format YYYY-MM-DD) Returns transactions with a created_at date greater than or equal to the one specified
     * until_date (format YYYY-MM-DD) Returns transactions with a created_at date less than or equal to the one specified
     * page and per_page The page number and number of results used for pagination. By default results are paginated 20 per page.
     *
     * @throws \Exception
     * @returns array of \Litwicki\Bundle\ChargifyBundle\Entity\Transaction
     */
    public function getAll($options = array())
    {
        try {

            $uri = '/transactions';

            if (empty($options)) {
                $response = $this->request($uri);
            }
            else {
                $response = $this->request($uri, 'GET', NULL, http_build_query($options));
            }

            return $this->apiResponse($response, 'Litwicki\Bundle\Chargify\Modle\Transaction');
        }
        catch (\Exception $e) {
            throw $e;
        }
    }

    /**
     * Show a transaction by Id.
     *
     * @param $id
     *
     * @throws \Exception
     */
    public function get($id)
    {
        try {
            $uri = sprintf('/transactions/%s', $id);
            $response = $this->request($uri);
            return $this->apiResponse($response, 'Litwicki\Bundle\Chargify\Modle\Transaction');
        }
        catch (\Exception $e) {
            throw $e;
        }
    }

    /**
     * @param $subscription_id
     * @param array $options
     *
     * kinds[] An array of transaction types (see above). Multiple values can be passed in the url, for example: http://example.com?kinds[]=charge&kinds[]=payment&kinds[]=credit
     * since_id Returns transactions with an id greater than or equal to the one specified
     * max_id Returns transactions with an id less than or equal to the one specified
     * since_date (format YYYY-MM-DD) Returns transactions with a created_at date greater than or equal to the one specified
     * until_date (format YYYY-MM-DD) Returns transactions with a created_at date less than or equal to the one specified
     * page and per_page The page number and number of results used for pagination. By default results are paginated 20 per page.
     *
     * @throws \Exception
     */
    public function findBySubscription($subscription_id, $options = array())
    {
        try {

            $uri = sprintf('/subscriptions/%s/transactions',
                $subscription_id
            );

            if (empty($options)) {
                $response = $this->request($uri);
            }
            else {
                $response = $this->request($uri, 'GET', NULL, http_build_query($options));
            }

            return $this->apiResponse($response, 'Litwicki\Bundle\Chargify\Modle\Transaction');

        }
        catch (\Exception $e) {
            throw $e;
        }
    }

}