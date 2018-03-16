<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Reservation
 *
 * @ORM\Table(name="reservation", indexes={@ORM\Index(name="fk_rsr_gnc", columns={"gnc_id"}), @ORM\Index(name="fk_cln_id", columns={"cln_id"}), @ORM\Index(name="FK_num_dep_vol", columns={"vlg_num", "date_dep"})})
 * @ORM\Entity
 */
class Reservation
{
    /**
     * @var integer
     *
     * @ORM\Column(name="nbr_places_res", type="integer", nullable=true)
     */
    private $nbrPlacesRes;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_reservation", type="date", nullable=true)
     */
    private $dateReservation;

    /**
     * @var integer
     *
     * @ORM\Column(name="rsr_num", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $rsrNum;

    /**
     * @var \AppBundle\Entity\Agence
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\Agence")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="gnc_id", referencedColumnName="gnc_id")
     * })
     */
    private $gnc;

    /**
     * @var \AppBundle\Entity\Vol
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Vol")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="vlg_num", referencedColumnName="vlg_num"),
     *   @ORM\JoinColumn(name="date_dep", referencedColumnName="date_dep")
     * })
     */
    private $vlgNum;

    /**
     * @var \AppBundle\Entity\Client
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Client")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="cln_id", referencedColumnName="cln_id")
     * })
     */
    private $cln;



    /**
     * Set nbrPlacesRes
     *
     * @param integer $nbrPlacesRes
     *
     * @return Reservation
     */
    public function setNbrPlacesRes($nbrPlacesRes)
    {
        $this->nbrPlacesRes = $nbrPlacesRes;

        return $this;
    }

    /**
     * Get nbrPlacesRes
     *
     * @return integer
     */
    public function getNbrPlacesRes()
    {
        return $this->nbrPlacesRes;
    }

    /**
     * Set dateReservation
     *
     * @param \DateTime $dateReservation
     *
     * @return Reservation
     */
    public function setDateReservation($dateReservation)
    {
        $this->dateReservation = $dateReservation;

        return $this;
    }

    /**
     * Get dateReservation
     *
     * @return \DateTime
     */
    public function getDateReservation()
    {
        return $this->dateReservation;
    }

    /**
     * Set rsrNum
     *
     * @param integer $rsrNum
     *
     * @return Reservation
     */
    public function setRsrNum($rsrNum)
    {
        $this->rsrNum = $rsrNum;

        return $this;
    }

    /**
     * Get rsrNum
     *
     * @return integer
     */
    public function getRsrNum()
    {
        return $this->rsrNum;
    }

    /**
     * Set gnc
     *
     * @param \AppBundle\Entity\Agence $gnc
     *
     * @return Reservation
     */
    public function setGnc(\AppBundle\Entity\Agence $gnc)
    {
        $this->gnc = $gnc;

        return $this;
    }

    /**
     * Get gnc
     *
     * @return \AppBundle\Entity\Agence
     */
    public function getGnc()
    {
        return $this->gnc;
    }

    /**
     * Set vlgNum
     *
     * @param \AppBundle\Entity\Vol $vlgNum
     *
     * @return Reservation
     */
    public function setVlgNum(\AppBundle\Entity\Vol $vlgNum = null)
    {
        $this->vlgNum = $vlgNum;

        return $this;
    }

    /**
     * Get vlgNum
     *
     * @return \AppBundle\Entity\Vol
     */
    public function getVlgNum()
    {
        return $this->vlgNum;
    }

    /**
     * Set cln
     *
     * @param \AppBundle\Entity\Client $cln
     *
     * @return Reservation
     */
    public function setCln(\AppBundle\Entity\Client $cln = null)
    {
        $this->cln = $cln;

        return $this;
    }

    /**
     * Get cln
     *
     * @return \AppBundle\Entity\Client
     */
    public function getCln()
    {
        return $this->cln;
    }
}
