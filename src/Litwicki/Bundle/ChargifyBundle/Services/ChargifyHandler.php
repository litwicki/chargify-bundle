<?php

namespace Litwicki\Bundle\ChargifyBundle\Services;

use Litwicki\Common\cURL;
use Litwicki\Bundle\ChargifyBundle\Model\Statement;
use Litwicki\Bundle\ChargifyBundle\Model\Subscription;

class ChargifyHandler
{
    private $domain;
    private $test_mode;
    private $api_id;
    private $api_secret;
    private $api_password;
    private $api_key;
    private $format;

    /**
     * @param $domain
     * @param $api_id
     * @param $api_secret
     * @param $api_password
     * @param $api_key
     * @param $format
     * @param $test_mode
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
    public function __construct($domain, $api_id, $api_secret, $api_password, $api_key, $shared_key, $format, $test_mode)
    {
        $this->domain = $domain;
        $this->api_id = $api_id;
        $this->api_secret = $api_secret;
        $this->api_password = $api_password;
        $this->api_key = $api_key;
        $this->shared_key = $shared_key;
        $this->format = $format;
        $this->test_mode = $test_mode;
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
     * @param $curl
     * @throws \Exception
     */
    public function formatResponse($curl)
    {
        try {

            if($this->format == 'json') {
                $response = $curl->response;
                $item = json_decode($response, true);
            }
            elseif($this->format == 'xml') {
                $response = $curl->response;
                $json = json_encode($response);
                $item = json_decode($json, true);
            }
            else {
                $item = $curl->response;
            }

            return $item;

        }
        catch(\Exception $e) {
            throw $e;
        }
    }

    /**
     * Convert an entity to a json object.
     *
     * @param $entity
     *
     * @throws \Exception
     */
    public function entityToJson($entity)
    {

        try {

            $data = $this->entityToArray($entity);

            $json = json_encode($data);

            return $json;

        }
        catch(\Exception $e) {
            throw $e;
        }

    }

    /**
     * @param $entity
     *
     * @throws \Exception
     */
    public function entityToXml($entity)
    {
        try {

            $data = $this->entityToArray($entity);

            $root = $entity->getXmlRootName();

            $xml = new \SimpleXMLElement($root);

            array_walk_recursive($data, array ($xml, 'addChild'));
            return $xml->asXml();

        }
        catch(\Exception $e) {
            throw $e;
        }
    }

    /**
     * Convert an entity to an associative array.
     *
     * @param $entity
     *
     * @throws \Exception
     */
    public function entityToArray($entity)
    {
        try {

            $obj = new \ReflectionClass($entity);

            $properties = $obj->getProperties(\ReflectionProperty::IS_PROTECTED);

            $data = array();
            $item = array();

            foreach($properties as $property) {

                $field = $property->name;

                $getter = ucwords($field);
                $getter = str_replace('_','',$getter);
                $getter = sprintf('get%s', $getter);

                if(method_exists($entity, $getter)) {
                    if(!is_null($entity->$getter())) {
                        $data[$field] = $entity->$getter();
                    }
                }

            }

            $class = new \ReflectionClass($entity);

            $objectName = $this->decamelize($class->getShortName());

            $item = array(
                $objectName => $data
            );

            return $item;

        }
        catch(\Exception $e) {
            throw $e;
        }
    }

    /**
     * @param $string
     *
     * @throws \Exception
     */
    public function stringToArray($string)
    {
        try {

            if($this->format == 'json') {
                $array = json_decode($string, true);
            }
            else {
                $json = json_encode($string);
                $array = json_decode($json, true);
            }

            return $array;

        }
        catch(\Exception $e) {
            throw $e;
        }
    }

    /**
     * Assign the response values to the entity itself.
     *
     * @param $entity
     * @param $data
     *
     * @throws \Exception
     */
    public function assignValues($entity, $data)
    {
        try {

            foreach($data as $key => $value) {

                $setter = ucwords($key);
                $setter = str_replace('_','',$setter);
                $setter = sprintf('set%s', $setter);

                if(method_exists($entity, $setter) && !is_null($value)) {
                    $entity->$setter($value);
                }

            }

            return $entity;

        }
        catch(\Exception $e) {
            throw $e;
        }
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
        if($this->format == 'json') {
            return $this->entityToJson($entity);
        }
        else {
            return $this->entityToXml($entity);
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
        $response = $this->request($uri, 'GET', array(), $query);

        $items = $this->formatResponse($response);

        foreach($items as $item) {
            $data = reset($item);
            $entities[$data['id']] = $this->assignValues(new $class(), $data);
        }

        return $entities;
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
            $response = $this->formatResponse($request);
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

            return $this->formatResponse($response);

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
            $data = $this->formatResponse($response);
            return $this->assignValues(new Statement(), $data);

        }
        catch (\Exception $e) {
            throw $e;
        }
    }

}