<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as JMS;

/**
 * Speciality
 *
 * @ORM\Table(name="speciality")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\SpecialityRepository")
 */
class Speciality
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @JMS\Groups({"specility_index"})

     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255)
     * @JMS\Groups({"specility_index"})
     */
    private $description;

    /**
     * @ORM\OneToMany(targetEntity="SubSpeciality", mappedBy="speciality")
     */
    private $subSpecility;
    /**
     * @ORM\OneToMany(targetEntity="PeluqueriaSpeciality", mappedBy="speciality")
     */
    private $peluqueria_speciality;

    public function __construct()
    {
        $this->subSpecility = new ArrayCollection();
        $this->peluqueria_speciality = new ArrayCollection();

    }
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
     * @return Speciality
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
     * Add subSpecility
     *
     * @param \AppBundle\Entity\SubSpeciality $subSpecility
     *
     * @return Speciality
     */
    public function addSubSpecility(\AppBundle\Entity\SubSpeciality $subSpecility)
    {
        $this->subSpecility[] = $subSpecility;

        return $this;
    }

    /**
     * Remove subSpecility
     *
     * @param \AppBundle\Entity\SubSpeciality $subSpecility
     */
    public function removeSubSpecility(\AppBundle\Entity\SubSpeciality $subSpecility)
    {
        $this->subSpecility->removeElement($subSpecility);
    }

    /**
     * Get subSpecility
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSubSpecility()
    {
        return $this->subSpecility;
    }

    /**
     * Add peluqueriaSpeciality
     *
     * @param \AppBundle\Entity\PeluqueriaSpeciality $peluqueriaSpeciality
     *
     * @return Speciality
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
}
