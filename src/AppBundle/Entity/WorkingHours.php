<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * WorkingHours
 *
 * @ORM\Table(name="working_hours")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\WorkingHoursRepository")
 */
class WorkingHours
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
     * @ORM\Column(name="dayNumber", type="string", length=255)
     */
    private $dayNumber;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="start", type="time")
     */
    private $start;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="end", type="time")
     */
    private $end;

    /**
     * @ORM\ManyToOne(targetEntity="Specialist", inversedBy="workinghours")
     * @ORM\JoinColumn(name="specialist_id", referencedColumnName="id")
     */
    private $specialist;

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
     * Set dayNumber
     *
     * @param string $dayNumber
     *
     * @return WorkingHours
     */
    public function setDayNumber($dayNumber)
    {
        $this->dayNumber = $dayNumber;

        return $this;
    }

    /**
     * Get dayNumber
     *
     * @return string
     */
    public function getDayNumber()
    {
        return $this->dayNumber;
    }

    /**
     * Set start
     *
     * @param \DateTime $start
     *
     * @return WorkingHours
     */
    public function setStart($start)
    {
        $this->start = $start;

        return $this;
    }

    /**
     * Get start
     *
     * @return \DateTime
     */
    public function getStart()
    {
        return $this->start;
    }

    /**
     * Set end
     *
     * @param \DateTime $end
     *
     * @return WorkingHours
     */
    public function setEnd($end)
    {
        $this->end = $end;

        return $this;
    }

    /**
     * Get end
     *
     * @return \DateTime
     */
    public function getEnd()
    {
        return $this->end;
    }

    /**
     * Set specialist
     *
     * @param \AppBundle\Entity\Specialist $specialist
     *
     * @return WorkingHours
     */
    public function setSpecialist(\AppBundle\Entity\Specialist $specialist = null)
    {
        $this->specialist = $specialist;

        return $this;
    }

    /**
     * Get specialist
     *
     * @return \AppBundle\Entity\Specialist
     */
    public function getSpecialist()
    {
        return $this->specialist;
    }
}
