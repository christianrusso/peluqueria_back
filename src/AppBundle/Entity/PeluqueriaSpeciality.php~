<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * PeluqueriaSpeciality
 *
 * @ORM\Table(name="peluqueria_speciality")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PeluqueriaSpecialityRepository")
 */
class PeluqueriaSpeciality
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
     * @ORM\ManyToOne(targetEntity="Speciality", inversedBy="peluqueria_speciality")
     * @ORM\JoinColumn(name="speciality_id", referencedColumnName="id")
     */
    private $speciality;

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="peluqueria_speciality")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;


    /**
     * @ORM\OneToMany(targetEntity="PeluqueriaSubSpeciality", mappedBy="peluqueria_speciality")
     */
    private $peluqueria_Subspeciality;

    public function __construct()
    {
        $this->peluqueria_Subspeciality = new ArrayCollection();
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
     * Set speciality
     *
     * @param \AppBundle\Entity\Specialist $speciality
     *
     * @return PeluqueriaSpeciality
     */
    public function setSpeciality(\AppBundle\Entity\Specialist $speciality = null)
    {
        $this->speciality = $speciality;

        return $this;
    }

    /**
     * Get speciality
     *
     * @return \AppBundle\Entity\Specialist
     */
    public function getSpeciality()
    {
        return $this->speciality;
    }

    /**
     * Set user
     *
     * @param \AppBundle\Entity\Specialist $user
     *
     * @return PeluqueriaSpeciality
     */
    public function setUser(\AppBundle\Entity\Specialist $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \AppBundle\Entity\Specialist
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Add peluqueriaSubspeciality
     *
     * @param \AppBundle\Entity\PeluqueriaSubSpeciality $peluqueriaSubspeciality
     *
     * @return PeluqueriaSpeciality
     */
    public function addPeluqueriaSubspeciality(\AppBundle\Entity\PeluqueriaSubSpeciality $peluqueriaSubspeciality)
    {
        $this->peluqueria_Subspeciality[] = $peluqueriaSubspeciality;

        return $this;
    }

    /**
     * Remove peluqueriaSubspeciality
     *
     * @param \AppBundle\Entity\PeluqueriaSubSpeciality $peluqueriaSubspeciality
     */
    public function removePeluqueriaSubspeciality(\AppBundle\Entity\PeluqueriaSubSpeciality $peluqueriaSubspeciality)
    {
        $this->peluqueria_Subspeciality->removeElement($peluqueriaSubspeciality);
    }

    /**
     * Get peluqueriaSubspeciality
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPeluqueriaSubspeciality()
    {
        return $this->peluqueria_Subspeciality;
    }
}
