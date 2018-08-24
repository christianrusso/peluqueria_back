<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as JMS;

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
     * @JMS\Groups({"peluqueria_speciality_index"})
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="Speciality", inversedBy="peluqueria_speciality")
     * @ORM\JoinColumn(name="speciality_id", referencedColumnName="id")
     * @JMS\Groups({"peluqueria_speciality_index","specility_single","specialist_index"})
     */
    private $speciality;

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="peluqueria_speciality")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     * @JMS\Groups({"peluqueria_speciality_index","user_single"})
     */
    private $user;


    /**
     * @ORM\OneToMany(targetEntity="PeluqueriaSubSpeciality", mappedBy="peluqueria_speciality")
     * @JMS\Groups({"peluqueria_speciality_index","peluqueriaSubspeciality_single","specialist_index"})
     */
    private $peluqueria_Subspeciality;

    /**
     * @ORM\OneToMany(targetEntity="Specialist", mappedBy="peluqueria_speciality")
     */
    private $specialist;


    public function __construct()
    {
        $this->peluqueria_Subspeciality = new ArrayCollection();
        $this->specialist = new ArrayCollection();
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
     * Set speciality
     *
     * @param \AppBundle\Entity\Speciality $speciality
     *
     * @return PeluqueriaSpeciality
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

    /**
     * Set user
     *
     * @param \AppBundle\Entity\User $user
     *
     * @return PeluqueriaSpeciality
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

    /**
     * Add specialist
     *
     * @param \AppBundle\Entity\Specialist $specialist
     *
     * @return PeluqueriaSpeciality
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
