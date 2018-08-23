<?php
// src/AppBundle/Entity/User.php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

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
     */
    protected $id;

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
        $this->roles = array('ROLE_USER');

        // your own logic
    }



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
}
