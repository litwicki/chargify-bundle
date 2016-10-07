<?php

namespace Litwicki\Bundle\ChargifyBundle\Services;

use Litwicki\Common\cURL;
use Litwicki\Common\Common;

use Litwicki\Bundle\ChargifyBundle\Model\Statement;
use Litwicki\Bundle\ChargifyBundle\Model\Subscription;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

class ChargifyHandler
{
    private $domain;
    private $test_mode;
    private $api_id;
    private $api_secret;
    private $api_password;
    private $api_key;
    private $format;

    protected $serializer;

    /**
     * @param $domain
     * @param $api_id
     * @param $api_secret
     * @param $api_password
     * @param $api_key
     * @param $format
     * @param $test_mode
     * @param $serializer
     *
     * arguments: [
     *   "%chargify.domain%",
     *   "%chargify.api_id%",
     *   "%chargify.api_secret%",
     *   "%chargify.api_password%",
     *   "%chargify.api_key%",
     *   "%chargify.shared_key%",
     *   "%chargify.data_format%",
     *   "%chargify.test_mode%"
     * ]
     *
     */
    public function __construct($domain, $api_id, $api_secret, $api_password, $api_key, $shared_key, $format, $test_mode, $serializer)
    {
        $this->domain = $domain;
        $this->api_id = $api_id;
        $this->api_secret = $api_secret;
        $this->api_password = $api_password;
        $this->api_key = $api_key;
        $this->shared_key = $shared_key;
        $this->format = $format;
        $this->test_mode = $test_mode;
        $this->serializer = $serializer;
    }

    public function serializer()
    {
        return $this->serializer;
    }

    public function format()
    {
        return $this->format;
    }

    /**
     * @param $uri
     * @param string $method
     * @param string $data
     * @param array $query
     * @param bool $v2
     *
     * @return \Litwicki\Common\cURL
     * @throws \Exception
     */
    public function request($uri, $method = 'GET', $data = '', $query = array(), $v2 = false)
    {

        $curl = new cURL();

        $url = sprintf('https://%s.chargify.com%s.%s',
            $this->domain,
            $uri,
            $this->format
        );

        if(!empty($query)) {
            $url = sprintf('%s?%s', $url, http_build_query($query));
        }

        $curl->setOpt(CURLOPT_SSL_VERIFYPEER, false);
        $curl->setOpt(CURLOPT_SSL_VERIFYHOST, 2);
        $curl->setOpt(CURLOPT_FOLLOWLOCATION, false);
        $curl->setOpt(CURLOPT_MAXREDIRS, 1);
        $curl->setOpt(CURLOPT_RETURNTRANSFER, true);

        if ($this->format == 'json') {
            $curl->setHeader('Content-Type', 'application/json');
            $curl->setHeader('Accept', 'application/json');
        }
        else {
            $curl->setHeader('Content-Type', 'application/xml');
            $curl->setHeader('Accept', 'application/xml');
        }

        /**
         * Setup authentication scheme.
         */
        if($v2) {
            $curl->setBasicAuthentication($this->api_secret, $this->api_password);
        }
        else {
            $curl->setBasicAuthentication($this->api_key, 'x');
        }

        $method = strtoupper($method);

        switch ($method) {

            case 'DELETE':
                $curl->delete($url, $data);
                break;
            case 'PATCH':
                $curl->patch($url, $data);
                break;
            case 'POST':
                $curl->post($url, $data);
                break;
            case 'PUT':
                $curl->put($url, $data);
                break;
            case 'GET':
            default:
                $curl->get($url);
                break;
        }

        $curl->setOpt(CURLOPT_CONNECTTIMEOUT, 10);
        $curl->setOpt(CURLOPT_TIMEOUT, 30);

        if ($curl->error) {
            $this->throwException($curl);
        }

        return $curl;
    }

    /**
     * Throw a proper exception message.
     *
     * @param $curl
     *
     * @throws \Exception
     */
    public function throwException($curl)
    {
        if($curl->error_message) {

            if($curl->error_code == 422) {
                $errors = json_decode($curl->response, true);
                $message = implode(' ', $errors['errors']);
            }
            else {
                $message = $curl->error_message;
            }
        }
        else {
            $message = json_decode($curl->response, true);
        }

        throw new \Exception($message);

    }

    /**
     * Convert an Array to JSON or XML string
     *
     * @param $data
     *
     * @return string
     */
    public function postData($data)
    {
        if($this->format == 'json') {
            return json_encode($data);
        }
        else {

            reset($data);
            $key = key($data);
            $root = sprintf('<%s/>', $key);

            $xml = new \SimpleXMLElement($root);
            array_walk_recursive($data, array ($xml, 'addChild'));
            return $xml->asXml();

        }
    }

    /**
     * @param $entity
     *
     * @throws \Exception
     */
    public function entityToPostData($entity)
    {
        try {
            return $this->serializer->serialize($entity, $this->format);
        }
        catch(\Exception $e) {
            throw $e;
        }
    }

    /**
     * Replace myCamelCaseWord with my_camel_case_word.
     *
     * @param $word
     *
     * @return mixed
     */
    public function decamelize($word)
    {
        return $word = preg_replace_callback(
            "/(^|[a-z])([A-Z])/",
            function($m) { return strtolower(strlen($m[1]) ? "$m[1]_$m[2]" : "$m[2]"); },
            $word
        );

    }

    /**
     * Replace my_camel_case_word with myCamelCaseWord
     *
     * @param $word
     *
     * @return mixed
     */
    public function camelize($word)
    {
        $word = preg_replace_callback(
            "/(^|_)([a-z])/",
            function($m) { return strtoupper("$m[2]"); },
            $word
        );

        return lcfirst($word);

    }

    /**
     * Fetch an array of objects.
     *
     * @param $uri
     * @param $class
     * @param array $query
     *
     * @return mixed
     * @throws \Exception
     */
    public function fetchMultiple($uri, $class, $query = array())
    {
        try {
            $response = $this->request($uri, 'GET', array(), $query);
            return $this->serializer()->deserialize($response, $class, $this->format());
        }
        catch(\Exception $e) {
            throw $e;
        }
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
    public function getSiteStatements($query = array())
    {
        try {

            $uri = sprintf('/statements/ids');

            if(empty($query)) {
                $response = $this->request($uri);
            }
            else {
                $response = $this->request($uri, 'GET', null, http_build_query($query));
            }

            return $this->responseToArray($response);

        }
        catch (\Exception $e) {
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
    public function findStatement($id)
    {
        try {

            $uri = sprintf('/statements/%s', $id);
            $response = $this->request($uri);
            return $this->serializer()->deserialize($response, '\Litwicki\Bundle\ChargifyBundle\Model\Statement', $this->format());

        }
        catch (\Exception $e) {
            throw $e;
        }
    }

    /**
     * Convert the response string to an array.
     *
     * @param $response
     *
     * @throws \Exception
     */
    public function responseToArray($response)
    {
        try {

            if($this->format == 'json') {
                $array = json_decode($response, true);
            }
            else {
                $json = json_encode($response);
                $array = json_decode($json, true);
            }

            return $array;

        }
        catch(\Exception $e) {
            throw $e;
        }
    }

    /**
     * The “Clear Sites” API is method of allowing merchants to clear customers and subscriptions or all data from a site in TEST mode only.
     *
     * @param $cleanup_scope
     *          Optional, all or customers, the scope of cleanup of the site to be performed. Default is all.
     *
     * @throws \Exception
     */
    private function clearSiteData($cleanup_scope)
    {
        try {

            if($this->test_mode) {
                $uri = '/sites/clear_data';
                $response = $this->request($uri, 'POST', null, http_build_query(array('cleanup_scope' => $cleanup_scope)));
                return $this->responseToArray($response);
            }
            else {
                throw new AccessDeniedException('Cannot clear Site Data unless in TEST MODE!');
            }

        }
        catch (\Exception $e) {
            throw $e;
        }
    }

}