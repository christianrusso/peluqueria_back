<?php
// src/AppBundle/Entity/User.php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as JMS;

/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     * @JMS\Groups({ "user_single","peluqueria_speciality_index"})
     */
    protected $id;

    /**
     * @var string
     * @JMS\Groups({ "user_single","peluqueria_speciality_index"})
     */
    protected $username;

    /**
     * @ORM\OneToMany(targetEntity="Peluqueria_Patient", mappedBy="userComapny")
     */
    private $patientCompany;
    /**
     * @ORM\OneToMany(targetEntity="Peluqueria_Patient", mappedBy="userPatient")
     */
    private $patientUser;
    /**
     * @ORM\OneToMany(targetEntity="PeluqueriaSpeciality", mappedBy="user")
     */
    private $peluqueria_speciality;
    /**
     * @ORM\OneToMany(targetEntity="Specialist", mappedBy="user")
     */
    private $specialist;
    public function __construct()
    {
        parent::__construct(
            $this->patientCompany = new ArrayCollection(),
            $this->patientUser = new ArrayCollection(),
            $this->peluqueria_speciality = new ArrayCollection(),
            $this->specialist = new ArrayCollection()

    );
//        $this->roles = array('ROLE_USER');

        // your own logic
    }


    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text",nullable=true)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="address", type="string", length=255)
     */
    private $address;

    /**
     * @var string
     *
     * @ORM\Column(name="city", type="string", length=255)
     */
    private $city;

    /**
     * @var string
     *
     * @ORM\Column(name="latitude", type="string", length=255)
     */
    private $latitude;
    /**
     * @var string
     *
     * @ORM\Column(name="longitude", type="string", length=255)
     */
    private $longitude;
    /**
     * @var string
     *
     * @ORM\Column(name="logo", type="text",nullable=true )
     */
    private $logo;
    /**
     * Add patientCompany
     *
     * @param \AppBundle\Entity\Peluqueria_Patient $patientCompany
     *
     * @return User
     */
    public function addPatientCompany(\AppBundle\Entity\Peluqueria_Patient $patientCompany)
    {
        $this->patientCompany[] = $patientCompany;

        return $this;
    }

    /**
     * Remove patientCompany
     *
     * @param \AppBundle\Entity\Peluqueria_Patient $patientCompany
     */
    public function removePatientCompany(\AppBundle\Entity\Peluqueria_Patient $patientCompany)
    {
        $this->patientCompany->removeElement($patientCompany);
    }

    /**
     * Get patientCompany
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPatientCompany()
    {
        return $this->patientCompany;
    }

    /**
     * Add patientUser
     *
     * @param \AppBundle\Entity\Peluqueria_Patient $patientUser
     *
     * @return User
     */
    public function addPatientUser(\AppBundle\Entity\Peluqueria_Patient $patientUser)
    {
        $this->patientUser[] = $patientUser;

        return $this;
    }

    /**
     * Remove patientUser
     *
     * @param \AppBundle\Entity\Peluqueria_Patient $patientUser
     */
    public function removePatientUser(\AppBundle\Entity\Peluqueria_Patient $patientUser)
    {
        $this->patientUser->removeElement($patientUser);
    }

    /**
     * Get patientUser
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPatientUser()
    {
        return $this->patientUser;
    }

    /**
     * Add peluqueriaSpeciality
     *
     * @param \AppBundle\Entity\PeluqueriaSpeciality $peluqueriaSpeciality
     *
     * @return User
     */
    public function addPeluqueriaSpeciality(\AppBundle\Entity\PeluqueriaSpeciality $peluqueriaSpeciality)
    {
        $this->peluqueria_speciality[] = $peluqueriaSpeciality;

        return $this;
    }

    /**
     * Remove peluqueriaSpeciality
     *
     * @param \AppBundle\Entity\PeluqueriaSpeciality $peluqueriaSpeciality
     */
    public function removePeluqueriaSpeciality(\AppBundle\Entity\PeluqueriaSpeciality $peluqueriaSpeciality)
    {
        $this->peluqueria_speciality->removeElement($peluqueriaSpeciality);
    }

    /**
     * Get peluqueriaSpeciality
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPeluqueriaSpeciality()
    {
        return $this->peluqueria_speciality;
    }

    /**
     * Add specialist
     *
     * @param \AppBundle\Entity\Specialist $specialist
     *
     * @return User
     */
    public function addSpecialist(\AppBundle\Entity\Specialist $specialist)
    {
        $this->specialist[] = $specialist;

        return $this;
    }

    /**
     * Remove specialist
     *
     * @param \AppBundle\Entity\Specialist $specialist
     */
    public function removeSpecialist(\AppBundle\Entity\Specialist $specialist)
    {
        $this->specialist->removeElement($specialist);
    }

    /**
     * Get specialist
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSpecialist()
    {
        return $this->specialist;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return User
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set address
     *
     * @param string $address
     *
     * @return User
     */
    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get address
     *
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set city
     *
     * @param string $city
     *
     * @return User
     */
    public function setCity($city)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Get city
     *
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set latitude
     *
     * @param string $latitude
     *
     * @return User
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
     *
     * @return User
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
     * Set logo
     *
     * @param string $logo
     *
     * @return User
     */
    public function setLogo($logo)
    {
        $this->logo = $logo;

        return $this;
    }

    /**
     * Get logo
     *
     * @return string
     */
    public function getLogo()
    {
        return $this->logo;
    }
}
