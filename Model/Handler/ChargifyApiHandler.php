<?php

namespace Litwicki\Bundle\ChargifyBundle\Model\Handler;

use Blameable\Fixture\Document\Type;
use GuzzleHttp\Client as Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Psr7;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Exception\RequestException;
use JMS\Serializer\SerializationContext;

use Litwicki\Bundle\ChargifyBundle\LitwickiChargifyBundle;
use Litwicki\Bundle\ChargifyBundle\Entity\Statement;
use Litwicki\Bundle\ChargifyBundle\Entity\Subscription;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Litwicki\Bundle\ChargifyBundle\Exception\ChargifyInvalidApiFormatException;

class ChargifyApiHandler
{
    private $domain;
    private $test_mode;
    private $api_id;
    private $api_secret;
    private $api_password;
    private $api_key;
    private $format;
    protected $uri;

    protected $entityClass;
    protected $serializer;

    public function __construct($uri, $domain, $api_id, $api_secret, $api_password, $api_key, $shared_key, $format, $test_mode, $serializer)
    {
        $this->domain = $domain;
        $this->uri = $uri;
        $this->api_id = $api_id;
        $this->api_secret = $api_secret;
        $this->api_password = $api_password;
        $this->api_key = $api_key;
        $this->shared_key = $shared_key;
        $this->format = $format;
        $this->test_mode = $test_mode;
        $this->serializer = $serializer;
    }

    /**
     * Fetch the API Format.
     *
     * @return mixed
     */
    public function format()
    {
        if(!in_array($this->format, ['json', 'xml'])) {
            throw new ChargifyInvalidApiFormatException('%s is not a valid Api Format: `json` or `xml` only.');
        }

        return $this->format;
    }

    /**
     * Submit an API request to Chargify.
     *
     * @param $uri
     * @param string $method
     * @param string $data
     * @param array $query
     * @param bool $v2
     *
     * @return \Psr\Http\Message\StreamInterface
     * @throws \Exception
     */
    public function request($uri, $method = 'GET', $data = '', $query = array(), $v2 = false)
    {
        try {

            $base_uri = sprintf('https://%s.chargify.com', $this->domain);

            if ($v2) {
                $auth = array($this->api_secret, $this->api_password);
            } else {
                $auth = array($this->api_key, 'x');
            }

            $options = [
                'base_uri'        => $base_uri,
                'handler'         => HandlerStack::create(),
                'timeout'         => 10,
                'allow_redirects' => false,
                'auth'            => $auth,
                'headers'         => [
                    'User-Agent'   => 'chargify-bundle/' . LitwickiChargifyBundle::VERSION .' (https://github.com/litwicki/chargify-bundle)',
                    'Content-Type' => 'application/' . $this->format
                ]
            ];

            $client = new Client($options);

            $method  = strtoupper($method);
            $path    = ltrim($uri, '/');
            $path    = $path . '.' . $this->format;
            $options = [
                'query' => $query,
                'body' => null,
            ];

            $request = new Request($method, $path);

            if (in_array($method, array('POST', 'PUT'))) {
                if (null === $data) {
                    throw new BadMethodCallException('You must send raw data in a POST or PUT request');
                }
            }
            if (!empty($data)) {
                $options['body'] =  Psr7\stream_for($data); //$data;
            }

            try {
                $response = $client->send($request, $options);
            } catch (RequestException $e) {
                if ($e->hasResponse()) {
                    $response = $e->getResponse();
                } else {
                    $response = false;
                }
            }

            return $response->getBody();

        }
        catch (RequestException $e)
        {
            if ($e->hasResponse()) {
                throw new \Exception(Psr7\str($e->getResponse()));
            }
            throw new \Exception($e->getMessage());
        }
        catch(\Exception $e)
        {
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
    public function arrayToPostData($data)
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
     * Convert the response string to an array.
     *
     * @param $response
     *
     * @return mixed
     * @throws \Exception
     */
    public function responseToArray($response)
    {
        try {

            if($this->format() == 'json') {
                $data = json_decode($response, true);
            }
            else {
                $xml = json_encode($response);
                $data = json_decode($xml, true);
            }

            return $data;

        }
        catch(\Exception $e) {
            throw $e;
        }
    }

    /**
     * For now, the Serializer isn't necessary here because the response we get from Chargify
     * is already serialized in the format we requested (xml, json). So simply pass through
     * that data format string to the User here.
     *
     * @TODO: fix the deserialization to work in sync with the Doctrine Entity.
     *
     * @param $data
     * @param $entityClass
     * @return mixed
     * @throws \Exception
     */
    public function apiResponse($data, $entityClass)
    {
        try {
            $array = $this->responseToArray($data);
            $entity = reset($array);
            $string = $this->serializer->serialize($entity, $this->format());
            return $this->serializer->deserialize($string, $entityClass, $this->format());
        }
        catch(\Exception $e) {
            throw $e;
        }
    }

}