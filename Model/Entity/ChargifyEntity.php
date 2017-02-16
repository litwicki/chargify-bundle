<?php

namespace Litwicki\Bundle\ChargifyBundle\Model\Entity;

use JMS\Serializer\Annotation as Serializer;
use JMS\Serializer\Annotation\Accessor;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\VirtualProperty;
use JMS\Serializer\Annotation\Groups;
use JMS\Serializer\Annotation\MaxDepth;
use JMS\Serializer\Annotation\SerializedName;

use Litwicki\Bundle\ChargifyBundle\Exception\ChargifyMethodNotAccessibleException;
use Litwicki\Bundle\ChargifyBundle\Model\Entity\ChargifyEntityInterface;

class ChargifyEntity implements ChargifyEntityInterface
{

    /**
     * @Type("integer")
	 * @Groups({"api"})
	 * @Expose
     */
    protected $id;

    /**
     * @Type("integer")
	 * @Groups({"api"})
	 * @Expose
     */
    protected $chargify_id;

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
    public function setChargifyId($id)
    {
        if(is_numeric($this->id) && $this->id != $id) {
            throw new \Exception(sprintf('Cannot reassign Identifier for %s.', get_class($this)));
        }

        $this->id = $id;
    }

    public function getChargifyId()
    {
        return $this->chargify_id;
    }

    /**
     * @param $method
     * @param $args
     *
     * @return mixed
     * @throws \Exception
     */
    public function __call($method, $args)
    {
        if (strpos($method, 'getSerialized') === 0)
        {
            if(substr($method, -6) == 'iesIds') {
                $access = 'get' . substr($method, 13, -3);
                return Common::getEntityIds($this->$access());
            }
            else if (substr($method, -3) == 'Ids') {
                $access = 'get' . substr($method, 13, -3) . 's';
                return Common::getEntityIds($this->$access());
            }
            else if (substr($method, -2) == 'Id') {
                $access = 'get' . substr($method, 13, -2);
                return Common::getEntityId($this->$access());
            }
        }

        throw new \Exception(sprintf(
            'Attempt to call method %s which does not exist on class %s.', $method, get_class($this)
        ));
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