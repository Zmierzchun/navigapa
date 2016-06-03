<?php

namespace GapaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Location
 */
class Location
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $latitude;

    /**
     * @var string
     */
    private $longitude;

    /**
     * @var string
     */
    private $direction;

    /**
     * @var string
     */
    private $speed;

    /**
     * @var string
     */
    private $acceleration;

    /**
     * @var \DateTime
     */
    private $time;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set latitude
     *
     * @param string $latitude
     * @return Location
     */
    public function setLatitude($latitude)
    {
        $this->latitude = $latitude;

        return $this;
    }

    /**
     * Get latitude
     *
     * @return string 
     */
    public function getLatitude()
    {
        return $this->latitude;
    }

    /**
     * Set longitude
     *
     * @param string $longitude
     * @return Location
     */
    public function setLongitude($longitude)
    {
        $this->longitude = $longitude;

        return $this;
    }

    /**
     * Get longitude
     *
     * @return string 
     */
    public function getLongitude()
    {
        return $this->longitude;
    }

    /**
     * Set direction
     *
     * @param string $direction
     * @return Location
     */
    public function setDirection($direction)
    {
        $this->direction = $direction;

        return $this;
    }

    /**
     * Get direction
     *
     * @return string 
     */
    public function getDirection()
    {
        return $this->direction;
    }

    /**
     * Set speed
     *
     * @param string $speed
     * @return Location
     */
    public function setSpeed($speed)
    {
        $this->speed = $speed;

        return $this;
    }

    /**
     * Get speed
     *
     * @return string 
     */
    public function getSpeed()
    {
        return $this->speed;
    }

    /**
     * Set acceleration
     *
     * @param string $acceleration
     * @return Location
     */
    public function setAcceleration($acceleration)
    {
        $this->acceleration = $acceleration;

        return $this;
    }

    /**
     * Get acceleration
     *
     * @return string 
     */
    public function getAcceleration()
    {
        return $this->acceleration;
    }

    /**
     * Set time
     *
     * @param \DateTime $time
     * @return Location
     */
    public function setTime($time)
    {
        $this->time = $time;

        return $this;
    }

    /**
     * Get time
     *
     * @return \DateTime 
     */
    public function getTime()
    {
        return $this->time;
    }
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $vehicles;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->vehicles = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add vehicles
     *
     * @param \GapaBundle\Entity\Vehicle $vehicles
     * @return Location
     */
    public function addVehicle(\GapaBundle\Entity\Vehicle $vehicles)
    {
        $this->vehicles[] = $vehicles;

        return $this;
    }

    /**
     * Remove vehicles
     *
     * @param \GapaBundle\Entity\Vehicle $vehicles
     */
    public function removeVehicle(\GapaBundle\Entity\Vehicle $vehicles)
    {
        $this->vehicles->removeElement($vehicles);
    }

    /**
     * Get vehicles
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getVehicles()
    {
        return $this->vehicles;
    }
    /**
     * @var string
     */
    private $accuracy;


    /**
     * Set accuracy
     *
     * @param string $accuracy
     * @return Location
     */
    public function setAccuracy($accuracy)
    {
        $this->accuracy = $accuracy;

        return $this;
    }

    /**
     * Get accuracy
     *
     * @return string 
     */
    public function getAccuracy()
    {
        return $this->accuracy;
    }
    /**
     * @var \GapaBundle\Entity\Track
     */
    private $track;


    /**
     * Set track
     *
     * @param \GapaBundle\Entity\Track $track
     * @return Location
     */
    public function setTrack(\GapaBundle\Entity\Track $track = null)
    {
        $this->track = $track;

        return $this;
    }

    /**
     * Get track
     *
     * @return \GapaBundle\Entity\Track 
     */
    public function getTrack()
    {
        return $this->track;
    }
    /**
     * @var \GapaBundle\Entity\Crossing
     */
    private $crossing;


    /**
     * Set crossing
     *
     * @param \GapaBundle\Entity\Crossing $crossing
     * @return Location
     */
    public function setCrossing(\GapaBundle\Entity\Crossing $crossing = null)
    {
        $this->crossing = $crossing;

        return $this;
    }

    /**
     * Get crossing
     *
     * @return \GapaBundle\Entity\Crossing 
     */
    public function getCrossing()
    {
        return $this->crossing;
    }
    /**
     * @var string
     */
    private $altitude;

    /**
     * @var string
     */
    private $altAcc;


    /**
     * Set altitude
     *
     * @param string $altitude
     *
     * @return Location
     */
    public function setAltitude($altitude)
    {
        $this->altitude = $altitude;

        return $this;
    }

    /**
     * Get altitude
     *
     * @return string
     */
    public function getAltitude()
    {
        return $this->altitude;
    }

    /**
     * Set altAcc
     *
     * @param string $altAcc
     *
     * @return Location
     */
    public function setAltAcc($altAcc)
    {
        $this->altAcc = $altAcc;

        return $this;
    }

    /**
     * Get altAcc
     *
     * @return string
     */
    public function getAltAcc()
    {
        return $this->altAcc;
    }
}
