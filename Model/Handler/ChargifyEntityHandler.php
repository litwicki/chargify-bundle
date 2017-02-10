<?php

namespace Litwicki\Bundle\ChargifyBundle\Model\Handler;

use GuzzleHttp\Client as Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Psr7;
use GuzzleHttp\Exception\RequestException;

use Litwicki\Bundle\ChargifyBundle\Entity\Statement;
use Litwicki\Bundle\ChargifyBundle\Entity\Subscription;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Litwicki\Bundle\ChargifyBundle\Model\Entity\ChargifyEntityInterface;

class ChargifyEntityHandler extends ChargifyApiHandler
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

    /**
     * ChargifyEntityHandler constructor.
     * @param $entityClass
     * @param $uri
     * @param $domain
     * @param $api_id
     * @param $api_secret
     * @param $api_password
     * @param $api_key
     * @param $shared_key
     * @param $format
     * @param $test_mode
     * @param $serializer
     */
    public function __construct($entityClass, $uri, $domain, $api_id, $api_secret, $api_password, $api_key, $shared_key, $format, $test_mode, $serializer)
    {
        parent::__construct($uri, $domain, $api_id, $api_secret, $api_password, $api_key, $shared_key, $format, $test_mode, $serializer);
        $this->entityClass = $entityClass;
    }

    /**
     * Get the base URI for this entity.
     *
     * @param ChargifyEntityInterface|null $entity
     * @return mixed
     */
    public function getUri(ChargifyEntityInterface $entity = null)
    {
        return $this->uri;
    }

    /**
     * Create an adjustment on a subscription.
     *
     * @param $entity
     *
     * @return mixed
     * @throws \Exception
     */
    public function create(ChargifyEntityInterface $entity)
    {
        try {
            $response = $this->request($this->getUri($entity), 'POST', $this->serialize($entity, $this->format()));
            return $this->apiResponse($response, $this->entityClass);
        }
        catch(\Exception $e) {
            throw $e;
        }
    }

    /**
     * Update (PUT) an Entity.
     *
     * @param ChargifyEntityInterface $entity
     * @return mixed
     * @throws \Exception
     */
    public function update(ChargifyEntityInterface $entity)
    {
        try {

            $uri = sprintf("%s/%s",
                $this->getUri(),
                $entity->getChargifyId()
            );

            $response = $this->request($uri, 'PUT', $this->serialize($entity, $this->format()));
            return $this->apiResponse($response->getBody(), $this->entityClass);

        }
        catch (\Exception $e) {
            throw $e;
        }
    }

    /**
     * Alias for update()
     *
     * @param ChargifyEntityInterface $entity
     * @return mixed
     */
    public function put(ChargifyEntityInterface $entity)
    {
        return $this->update($entity);
    }

    /**
     * Get a specific Entity by Id.
     *
     * @param $id
     * @param array $query
     * @return mixed
     * @throws \Exception
     */
    public function get($id, array $query = array())
    {
        try {

            $uri = sprintf("%s/%s",
                $this->getUri(),
                $id
            );

            $response = $this->request($uri);
            return $this->apiResponse($response->getContents(), $this->entityClass);

        }
        catch(\Exception $e) {
            throw $e;
        }
    }

    /**
     * Fetch all Entities.
     *
     * @param array $query
     *
     * @return mixed
     * @throws \Exception
     */
    public function getAll(array $query = array())
    {
        try {

            $uri = sprintf('%s?%s',
                $this->getUri(),
                http_build_query($query)
            );

            $response = $this->request($uri, 'GET', array());
            return $this->apiResponse($response->getBody(), $this->entityClass);

        }
        catch (\Exception $e) {
            throw $e;
        }
    }

    /**
     * Delete an Entity.
     *
     * @param $id
     * @return mixed
     * @throws \Exception
     */
    public function delete($id)
    {
        try {
            $uri = sprintf("%s/%s", $this->getUri(), $id);
            $response = $this->request($uri, 'GET', array());
            return $this->apiResponse($response->getReasonPhrase(), $this->entityClass);
        }
        catch(\Exception $e) {
            throw $e;
        }
    }

}