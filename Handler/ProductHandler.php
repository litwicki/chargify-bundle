<?php

namespace Litwicki\Bundle\ChargifyBundle\Handler;

use Litwicki\Bundle\ChargifyBundle\Model\Handler\ChargifyHandler;
use Litwicki\Bundle\ChargifyBundle\Entity\Product;

class ProductHandler extends ChargifyHandler
{

    /**
     * Find all products in a specific Product Family.
     *
     * @param $product_family_id
     *
     * @throws \Exception
     */
    public function findAll($product_family_id)
    {
        try {

            $uri = sprintf('/product_families/%s/products',
                $product_family_id
            );

            $response = $this->request($uri);
            return $this->fetchMultiple($uri, '\Litwicki\Bundle\ChargifyBundle\Entity\Product', $response);

        }
        catch (\Exception $e) {
            throw $e;
        }
    }

    /**
     * Find a product by Id.
     *
     * @param $id
     *
     * @throws \Exception
     */
    public function find($id)
    {
        try {

            $uri = sprintf('/products/%s',
                $id
            );

            $response = $this->request($uri);
            return $this->serializer()->deserialize($response, '\Litwicki\Bundle\ChargifyBundle\Entity\Product', $this->format());

        }
        catch (\Exception $e) {
            throw $e;
        }
    }

    /**
     * Find a product by Handle.
     *
     * @param string $handle
     *
     * @throws \Exception
     */
    public function findByHandle($handle)
    {
        try {

            $uri = sprintf('/products/handle/%s',
                $handle
            );

            $response = $this->request($uri);
            return $this->serializer()->deserialize($response, '\Litwicki\Bundle\ChargifyBundle\Entity\Product', $this->format());

        }
        catch (\Exception $e) {
            throw $e;
        }
    }

    /**
     * Create a Product.
     *
     * @param \Litwicki\Bundle\ChargifyBundle\Entity\Product $entity
     * @param $product_family_id
     *
     * @throws \Exception
     */
    public function create(Product $entity, $product_family_id)
    {
        try {

            $uri = sprintf('/product_families/%s/products',
                $product_family_id
            );

            $response = $this->request($uri, $this->serializer()->serialize($entity, $this->format()));
            return $this->serializer()->deserialize($response, '\Litwicki\Bundle\ChargifyBundle\Entity\Product', $this->format());

        }
        catch (\Exception $e) {
            throw $e;
        }
    }

}