<?php

namespace Litwicki\Bundle\ChargifyBundle\Handler\Entity;

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

use Litwicki\Bundle\ChargifyBundle\Model\Handler\ChargifyEntityHandler;
use Litwicki\Bundle\ChargifyBundle\Model\Handler\ChargifyHandlerInterface;
use Litwicki\Bundle\ChargifyBundle\Model\Entity\ChargifyEntityInterface;

class SubscriptionHandler extends ChargifyEntityHandler
{
    /**
     * Refund a Subscription.
     *
     * @param \Litwicki\Bundle\ChargifyBundle\Entity\Refund $entity
     * @param $subscription_id
     *
     * @throws \Exception
     */
    public function refund(Refund $entity, $subscription_id)
    {
        try {

            $uri = sprintf('subscriptions/%s/refunds',
                $subscription_id
            );

            $response = $this->request($uri, 'POST', $this->serialize($entity));
            return $this->apiResponse($response, '\Litwicki\Bundle\ChargifyBundle\Entity\Refund');

        }
        catch (\Exception $e) {
            throw $e;
        }
    }

    /**
     * Renewal Preview is an object representing a subscription’s next
     * assessment. You can retrieve it to see a snapshot of how much your
     * customer will be charged on their next renewal.
     *
     * @param \Litwicki\Bundle\ChargifyBundle\Entity\Subscription $entity
     *
     * @return mixed
     * @throws \Exception
     */
    public function getRenewalPreview(Subscription $entity)
    {
        try {

            $uri = sprintf('/subscriptions/%s/renewals/preview',
                $entity->getId()
            );

            $response = $response = $this->request($uri);
            return $this->apiResponse($response->getBody(), '\Litwicki\Bundle\ChargifyBundle\Entity\RenewalPreview');

        }
        catch (\Exception $e) {
            throw $e;
        }
    }

    /**
     * Find all statements for a Subscription.
     *
     * @param \Litwicki\Bundle\ChargifyBundle\Entity\Subscription $entity
     *
     * @return mixed
     * @throws \Exception
     */
    public function getStatements(Subscription $entity)
    {
        try {

            $uri = sprintf('/subscriptions/%s/statements',
                $entity->getId()
            );

            $response = $this->request($uri);
            return $this->apiResponse($response->getBody(), '\Litwicki\Bundle\ChargifyBundle\Entity\Statement');

        }
        catch (\Exception $e) {
            throw $e;
        }
    }

    /**
     * Cancel a Subscription immediately.
     *
     * @TODO: this method!
     *
     * @param \Litwicki\Bundle\ChargifyBundle\Entity\Subscription $entity
     *
     * @return mixed
     * @throws \Exception
     */
    public function cancel(ChargifyEntityInterface $entity)
    {
        return null;
    }

    /**
     * Chargify offers the ability to cancel a subscription at the end of the current period (as set by its current product.
     * Setting the subscription to cancel at the end of the period sets the cancel_at_end_of_period to true.
     *
     * Note, that you cannot set cancel_at_end_of_period at subscription creation.
     *
     * @param \Litwicki\Bundle\ChargifyBundle\Entity\Subscription $entity
     *
     * @throws \Exception
     */
    public function cancelAtEndOfPeriod(Subscription $entity)
    {
        try {

            $uri = sprintf('/subscriptions/%s',
                $entity->getId()
            );

            $entity->setCancelAtEndOfPeriod(true);

            $response = $this->request($uri, 'PUT', $this->serialize($entity));
            return $this->apiResponse($response->getBody(), $this->entityClass);

        }
        catch (\Exception $e) {
            throw $e;
        }
    }


    /**
     * Reactivate a Subscription
     *
     * Optional Parameters:
     *   include_trial – Boolean, default 0. If 1 is sent the reactivated subscription will include a trial if one is available. If 0 is sent, the trial period will be ignored. This parameter should be sent in a query string, and does not need to be nested inside a subscription object
     *   preserve_balance – Boolean, default ‘0’. If ‘1’ is passed, the existing subscription balance will NOT be cleared/reset before adding the additional reactivation charges.
     *   coupon_code – The coupon code to be applied during reactivation
     *
     * @param \Litwicki\Bundle\ChargifyBundle\Entity\Subscription $entity
     *
     * @throws \Exception
     */
    public function reactivate(ChargifyEntityInterface $entity, $options = array())
    {
        try {

            $uri = sprintf('/subscriptions/%s/reactivate',
                $entity->getId()
            );

            $response = $this->request($uri, 'PUT', $this->arrayToPostData($options));
            return $this->apiResponse($response->getBody(), $this->entityClass);

        }
        catch (\Exception $e) {
            throw $e;
        }
    }

    /**
     * Reset the balance on a subscription.
     *
     * Chargify offers the ability to easily reset the balance of a subscription to zero.
     * If a subscription has a positive balance, this API call will issue a credit to the subscription for the outstanding balance.
     * This is particularly helpful if you want to reactivate a canceled subscription without charging the customer for their previously owed balance.
     *
     * @param \Litwicki\Bundle\ChargifyBundle\Entity\Subscription $entity
     *
     * @throws \Exception
     */
    public function resetBalance(Subscription $entity)
    {
        try {

            $uri = sprintf('/subscriptions/%s/reset_balance',
                $entity->getId()
            );

            $response = $this->request($uri, 'PUT');
            return $this->apiResponse($response->getBody(), $this->entityClass);

        }
        catch (\Exception $e) {
            throw $e;
        }
    }

    /**
     * Find all Subscriptions for a Customer.
     *
     * @param \Litwicki\Bundle\ChargifyBundle\Handler\Customer $entity
     * @param array $query
     *
     * @return mixed
     * @throws \Exception
     */
    public function findByCustomer(Customer $entity, $query = array())
    {
        try {

            $uri = sprintf('/customers/%s/subscriptions?%s',
                $entity->getId(),
                http_build_query($query)
            );

            $response = $this->request($uri);
            return $this->apiResponse($response->getBody(), $this->entityClass);

        }
        catch (\Exception $e) {
            throw $e;
        }
    }

    /**
     * This will delete a payment profile belonging to the customer on the
     * subscription. Please note that if the customer has multiple
     * subscriptions, the payment profile will be removed from all of them.
     *
     * Please note that if you delete the default payment profile for a
     * subscription, there is currently no way to designate a different payment
     * profile as the default via the API. You may want to Update the
     * subscription instead. To establish a new default payment profile after
     * it has been deleted, either prompt the user to enter a card in the
     * billing portal or on the self-service page, or visit the Payment Details
     * tab on the subscription in the Admin UI and use the “Add New Credit
     * Card” or “Make Active Payment Method” link, (depending on whether there
     * are other cards present.)
     *
     * @param \Litwicki\Bundle\ChargifyBundle\Entity\PaymentProfile $entity
     *
     * @return mixed
     * @throws \Exception
     */
    public function deletePaymentProfile(PaymentProfile $entity)
    {
        try {

            $uri = sprintf('/subscriptions/%s/payment_profiles/%s',
                $entity->getSubscriptionId(),
                $entity->getId()
            );

            $response = $this->request($uri, 'DELETE');

            return $this->apiResponse($response->getBody(), $this->entityClass);

        }
        catch (\Exception $e) {
            throw $e;
        }
    }

}