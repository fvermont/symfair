<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Vol
 *
 * @ORM\Table(name="vol", indexes={@ORM\Index(name="FK_vol_volg", columns={"vlg_num"})})
 * @ORM\Entity
 */
class Vol
{
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_arr", type="date", nullable=true)
     */
    private $dateArr;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_dep", type="date")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $dateDep;

    /**
     * @var \AppBundle\Entity\VolG
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\VolG")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="vlg_num", referencedColumnName="vlg_num")
     * })
     */
    private $vlgNum;


}

