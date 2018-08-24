<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as JMS;

/**
 * Specialist
 *
 * @ORM\Table(name="specialist")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\SpecialistRepository")
 */
class Specialist
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @JMS\Groups({"specialist_index", "workingHours_single"})
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="firstName", type="string", length=255)
     * @JMS\Groups({"specialist_index", "workingHours_single"})
     */
    private $firstName;

    /**
     * @var string
     *
     * @ORM\Column(name="lastName", type="string", length=255, nullable=true)
     * @JMS\Groups({"specialist_index", "workingHours_single"})
     */
    private $lastName;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255, nullable=true)
     * @JMS\Groups({"specialist_index", "workingHours_single"})
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="phoneNumber", type="string", length=255, nullable=true)
     * @JMS\Groups({"specialist_index", "workingHours_single"})
     */
    private $phoneNumber;

    /**
     * @var string
     *
     * @ORM\Column(name="consultationLength", type="string", length=255, nullable=true)
     * @JMS\Groups({"specialist_index"})
     */
    private $consultationLength;

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="specialist")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;


    /**
     * @ORM\OneToMany(targetEntity="WorkingHours", mappedBy="specialist")
     * @JMS\Groups({"specialist_index"})
     */
    private $workinghours;

    /**
     * @ORM\ManyToOne(targetEntity="PeluqueriaSpeciality", inversedBy="specialist")
     * @ORM\JoinColumn(name="peluqueriaSpeciality_id", referencedColumnName="id")
     * @JMS\Groups({"specialist_index"})
     */
    private $peluqueria_speciality;



    public function __construct()
    {
        $this->workinghours = new ArrayCollection();

    }



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
     * Set firstName
     *
     * @param string $firstName
     *
     * @return Specialist
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * Get firstName
     *
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Set lastName
     *
     * @param string $lastName
     *
     * @return Specialist
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * Get lastName
     *
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return Specialist
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set phoneNumber
     *
     * @param string $phoneNumber
     *
     * @return Specialist
     */
    public function setPhoneNumber($phoneNumber)
    {
        $this->phoneNumber = $phoneNumber;

        return $this;
    }

    /**
     * Get phoneNumber
     *
     * @return string
     */
    public function getPhoneNumber()
    {
        return $this->phoneNumber;
    }

    /**
     * Set consultationLength
     *
     * @param string $consultationLength
     *
     * @return Specialist
     */
    public function setConsultationLength($consultationLength)
    {
        $this->consultationLength = $consultationLength;

        return $this;
    }

    /**
     * Get consultationLength
     *
     * @return string
     */
    public function getConsultationLength()
    {
        return $this->consultationLength;
    }

    /**
     * Set user
     *
     * @param \AppBundle\Entity\User $user
     *
     * @return Specialist
     */
    public function setUser(\AppBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \AppBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Add workinghour
     *
     * @param \AppBundle\Entity\WorkingHours $workinghour
     *
     * @return Specialist
     */
    public function addWorkinghour(\AppBundle\Entity\WorkingHours $workinghour)
    {
        $this->workinghours[] = $workinghour;

        return $this;
    }

    /**
     * Remove workinghour
     *
     * @param \AppBundle\Entity\WorkingHours $workinghour
     */
    public function removeWorkinghour(\AppBundle\Entity\WorkingHours $workinghour)
    {
        $this->workinghours->removeElement($workinghour);
    }

    /**
     * Get workinghours
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getWorkinghours()
    {
        return $this->workinghours;
    }

    /**
     * Set peluqueriaSpeciality
     *
     * @param \AppBundle\Entity\PeluqueriaSpeciality $peluqueriaSpeciality
     *
     * @return Specialist
     */
    public function setPeluqueriaSpeciality(\AppBundle\Entity\PeluqueriaSpeciality $peluqueriaSpeciality = null)
    {
        $this->peluqueria_speciality = $peluqueriaSpeciality;

        return $this;
    }

    /**
     * Get peluqueriaSpeciality
     *
     * @return \AppBundle\Entity\PeluqueriaSpeciality
     */
    public function getPeluqueriaSpeciality()
    {
        return $this->peluqueria_speciality;
    }
}
