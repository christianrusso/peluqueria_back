<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as JMS;

/**
 * SubSpeciality
 *
 * @ORM\Table(name="sub_speciality")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\SubSpecialityRepository")
 */
class SubSpeciality
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @JMS\Groups({"subSpeciality_index"})
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255)
     * @JMS\Groups({"subSpeciality_index"})
     */
    private $description;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="duration", type="time", nullable=true)
     * @JMS\Groups({"subSpeciality_index"})
     */
    private $duration;


    /**
     * @ORM\ManyToOne(targetEntity="Speciality", inversedBy="subSpecility")
     * @ORM\JoinColumn(name="specility_id", referencedColumnName="id")
     */
    private $speciality;

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
     * Set description
     *
     * @param string $description
     *
     * @return SubSpeciality
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
     * Set duration
     *
     * @param \DateTime $duration
     *
     * @return SubSpeciality
     */
    public function setDuration($duration)
    {
        $this->duration = $duration;

        return $this;
    }

    /**
     * Get duration
     *
     * @return \DateTime
     */
    public function getDuration()
    {
        return $this->duration;
    }

    /**
     * Set speciality
     *
     * @param \AppBundle\Entity\Speciality $speciality
     *
     * @return SubSpeciality
     */
    public function setSpeciality(\AppBundle\Entity\Speciality $speciality = null)
    {
        $this->speciality = $speciality;

        return $this;
    }

    /**
     * Get speciality
     *
     * @return \AppBundle\Entity\Speciality
     */
    public function getSpeciality()
    {
        return $this->speciality;
    }
}
