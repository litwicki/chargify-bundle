<?php namespace Litwicki\Bundle\ChargifyBundle\Entity;

use JMS\Serializer\Annotation as Serializer;
use JMS\Serializer\Annotation\Accessor;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\VirtualProperty;
use JMS\Serializer\Annotation\Groups;
use JMS\Serializer\Annotation\MaxDepth;
use JMS\Serializer\Annotation\SerializedName;

use Litwicki\Common;
use Litwicki\Bundle\ChargifyBundle\Handler\Entity\CustomerHandler;
use Litwicki\Bundle\ChargifyBundle\Model\Entity\ChargifyEntityInterface;
use Litwicki\Bundle\ChargifyBundle\Model\Entity\ChargifyEntity;

/**
 * Class Customer
 *
 * @package Litwicki\Bundle\ChargifyBundle\Entity
 */
class Customer extends ChargifyEntity implements ChargifyEntityInterface
{
    /**
     * @Type("string")
     * @Groups({"api"})
     * @Expose
     */
    protected $first_name;

    /**
     * @Type("string")
     * @Groups({"api"})
     * @Expose
     */
    protected $last_name;

    /**
     * @Type("string")
     * @Groups({"api"})
     * @Expose
     */
    protected $email;

    /**
     * @Type("string")
     * @Groups({"api"})
     * @Expose
     */
    protected $organization;

    /**
     * @Type("string")
     * @Groups({"api"})
     */
    protected $reference;

    /**
     * @Type("datetime")
     * @Groups({"api"})
     * @Expose
     */
    protected $created_at;

    /**
     * @Type("datetime")
     * @Groups({"api"})
     * @Expose
     */
    protected $updated_at;

    /**
     * @Type("integer")
     * @Groups({"api"})
     * @Expose
     */
    protected $vat_number;

    /**
     * @Type("string")
     * @Groups({"api"})
     * @Expose
     */
    protected $address;

    /**
     * @Type("string")
     * @Groups({"api"})
     * @Expose
     */
    protected $address_2;

    /**
     * @Type("string")
     * @Groups({"api"})
     * @Expose
     */
    protected $city;

    /**
     * @Type("string")
     * @Groups({"api"})
     * @Expose
     */
    protected $state;

    /**
     * @Type("integer")
     * @Groups({"api"})
     * @Expose
     */
    protected $zip;

    /**
     * @Type("string")
     * @Groups({"api"})
     * @Expose
     */
    protected $country;

    /**
     * @return mixed
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param mixed $address
     */
    public function setAddress($address)
    {
        $this->address = $address;
    }

    /**
     * @return mixed
     */
    public function getAddress2()
    {
        return $this->address_2;
    }

    /**
     * @param mixed $address_2
     */
    public function setAddress2($address_2)
    {
        $this->address_2 = $address_2;
    }

    /**
     * @return mixed
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @param mixed $city
     */
    public function setCity($city)
    {
        $this->city = $city;
    }

    /**
     * @return mixed
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * @param mixed $country
     */
    public function setCountry($country)
    {
        $this->country = $country;
    }

    /**
     * @return mixed
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * @param mixed $created_at
     */
    public function setCreatedAt($created_at)
    {
        $this->created_at = $created_at;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getFirstName()
    {
        return $this->first_name;
    }

    /**
     * @param mixed $first_name
     */
    public function setFirstName($first_name)
    {
        $this->first_name = $first_name;
    }

    /**
     * @return mixed
     */
    public function getLastName()
    {
        return $this->last_name;
    }

    /**
     * @param mixed $last_name
     */
    public function setLastName($last_name)
    {
        $this->last_name = $last_name;
    }

    /**
     * @return mixed
     */
    public function getOrganization()
    {
        return $this->organization;
    }

    /**
     * @param mixed $organization
     */
    public function setOrganization($organization)
    {
        $this->organization = $organization;
    }

    /**
     * @return mixed
     */
    public function getReference()
    {
        return $this->reference;
    }

    /**
     * @param mixed $reference
     */
    public function setReference($reference)
    {
        $this->reference = $reference;
    }

    /**
     * @return mixed
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * @param mixed $state
     */
    public function setState($state)
    {
        $this->state = $state;
    }

    /**
     * @return mixed
     */
    public function getUpdatedAt()
    {
        return $this->updated_at;
    }

    /**
     * @param mixed $updated_at
     */
    public function setUpdatedAt($updated_at)
    {
        $this->updated_at = $updated_at;
    }

    /**
     * @return mixed
     */
    public function getVatNumber()
    {
        return $this->vat_number;
    }

    /**
     * @param mixed $vat_number
     */
    public function setVatNumber($vat_number)
    {
        $this->vat_number = $vat_number;
    }

    /**
     * @return mixed
     */
    public function getZip()
    {
        return $this->zip;
    }

    /**
     * @param mixed $zip
     */
    public function setZip($zip)
    {
        $this->zip = $zip;
    }

}