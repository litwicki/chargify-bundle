<?php

namespace Litwicki\Bundle\ChargifyBundle\Services;

class ChargifyModel
{

    protected $id;

    /**
     * Get the base name of the class as the root element for XML requests.
     *
     * @throws \Exception
     */
    public function getXmlRootName()
    {
        try {
            return strtolower(get_class($this));
        }
        catch(\Exception $e) {
            throw $e;
        }
    }

    /**
     * Allow the soft "set" of an Id, but don't allow setting the id if one is already
     * established, to avoid PK conflicts and other silliness.
     *
     * @param $id
     *
     * @throws \Exception
     */
    public function setId($id)
    {
        if(is_numeric($this->id) && $this->id != $id) {
            throw new \Exception(sprintf('Cannot reassign Identifier for %s.', get_class($this)));
        }

        $this->id = $id;
    }

    /**
     * @param $name
     * @param $arguments
     *
     * @throws \Exception
     */
    function __call($name, $arguments)
    {
        throw new \Exception(sprintf('Method not found: %s', $name));
    }

    /**
     * When the object is treated as a string.
     *
     * @return string
     */
    function __toString()
    {
        $obj = new \ReflectionClass($this);
        $name = $obj->getShortName();
        return sprintf('%s #%s', $name, $this->id);
    }



}