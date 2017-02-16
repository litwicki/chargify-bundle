<?php

namespace Litwicki\Bundle\ChargifyBundle\Handler;

use GuzzleHttp\Client as Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Psr7;
use GuzzleHttp\Exception\RequestException;

use Litwicki\Bundle\ChargifyBundle\Entity\Statement;
use Litwicki\Bundle\ChargifyBundle\Entity\Subscription;
use Litwicki\Bundle\ChargifyBundle\Model\Handler\ChargifyApiHandler;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

class ChargifySiteHandler extends ChargifyApiHandler
{
    private $domain;
    private $test_mode;
    private $api_id;
    private $api_secret;
    private $api_password;
    private $api_key;
    private $format;
    private $uri;

    protected $serializer;

    public function __construct($uri, $domain, $api_id, $api_secret, $api_password, $api_key, $shared_key, $format, $test_mode, $serializer)
    {
        parent::__construct($uri, $domain, $api_id, $api_secret, $api_password, $api_key, $shared_key, $format, $test_mode, $serializer);
    }

    /**
     * The Stats API is a very basic view of some Site-level stats.
     * This is actually the source of the data that powers the Chargify To Go iPhone App
     *
     * This API call only answers with JSON responses. An XML version is not provided.
     *
     * @throws \Exception
     */
    public function getStats()
    {
        try {

            $request = $this->request('/stats');
            $response = $this->responseToArray($request);
            return $response;

        }
        catch(\Exception $e) {
            throw $e;
        }
    }

    /**
     * The “Clear Sites” API is method of allowing merchants to clear customers
     * and subscriptions or all data from a site in TEST mode only.
     *
     * @param $cleanupScope
     *          Optional, all or customers, the scope of cleanup of the site to
     *          be performed. Default is all.
     *
     * @return \Psr\Http\Message\StreamInterface
     * @throws \Exception
     */
    private function clearSiteData($cleanupScope = 'all')
    {
        try {

            if($this->test_mode) {

                if(!in_array($cleanupScope, ['all', 'customers'])) {
                    throw new \Exception(sprintf('%s is not a valid Cleanup Scope: `all` or `customers`', $cleanupScope));
                }

                $uri = '/sites/clear_data';
                return $this->request($uri, 'POST', null, http_build_query(array('cleanup_scope' => $cleanupScope)));

            }
            else {
                throw new AccessDeniedException(sprintf('You must be in `test_mode` to clear site data for "%s."', $this->domain));
            }

        }
        catch (\Exception $e) {
            throw $e;
        }
    }

}