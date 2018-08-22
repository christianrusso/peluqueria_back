<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Peluqueria_Patient
 *
 * @ORM\Table(name="peluqueria__patient")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\Peluqueria_PatientRepository")
 */
class Peluqueria_Patient
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="createdAt", type="datetime", nullable=true)
     */
    private $createdAt;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return Peluqueria_Patient
     */
    public function setCreatedAt($createdAt=null)
    {
        $this->createdAt = new \DateTime('now', new \DateTimeZone("America/Argentina/Cordoba"));
        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="patientCompany")
     * @ORM\JoinColumn(name="company_id", referencedColumnName="id")
     */
    private $userComapny;

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="patientUser")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $userPatient;



    /**
     * Set userComapny
     *
     * @param \AppBundle\Entity\User $userComapny
     *
     * @return Peluqueria_Patient
     */
    public function setUserComapny(\AppBundle\Entity\User $userComapny = null)
    {
        $this->userComapny = $userComapny;

        return $this;
    }

    /**
     * Get userComapny
     *
     * @return \AppBundle\Entity\User
     */
    public function getUserComapny()
    {
        return $this->userComapny;
    }

    /**
     * Set userPatient
     *
     * @param \AppBundle\Entity\User $userPatient
     *
     * @return Peluqueria_Patient
     */
    public function setUserPatient(\AppBundle\Entity\User $userPatient = null)
    {
        $this->userPatient = $userPatient;

        return $this;
    }

    /**
     * Get userPatient
     *
     * @return \AppBundle\Entity\User
     */
    public function getUserPatient()
    {
        return $this->userPatient;
    }
}
