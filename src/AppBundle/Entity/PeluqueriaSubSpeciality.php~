<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PeluqueriaSubSpeciality
 *
 * @ORM\Table(name="peluqueria_sub_specility")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PeluqueriaSubSpecilityRepository")
 */
class PeluqueriaSubSpeciality
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
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255)
     */
    private $description;

    /**
     * @var int
     *
     * @ORM\Column(name="duration", type="integer")
     */
    private $duration;

    /**
     * @ORM\ManyToOne(targetEntity="PeluqueriaSpeciality", inversedBy="peluqueria_Subspeciality")
     * @ORM\JoinColumn(name="peluqueria_speciality_id", referencedColumnName="id")
     */
    private $peluqueria_speciality;
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
     * @return PeluqueriaSubSpeciality
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
     * @param integer $duration
     *
     * @return PeluqueriaSubSpeciality
     */
    public function setDuration($duration)
    {
        $this->duration = $duration;

        return $this;
    }

    /**
     * Get duration
     *
     * @return int
     */
    public function getDuration()
    {
        return $this->duration;
    }

    /**
     * Set peluqueriaSpeciality
     *
     * @param \AppBundle\Entity\PeluqueriaSpeciality $peluqueriaSpeciality
     *
     * @return PeluqueriaSubSpeciality
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
