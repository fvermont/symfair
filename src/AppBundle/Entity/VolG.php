<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * VolG
 *
 * @ORM\Table(name="vol_g", indexes={@ORM\Index(name="fk_code_arp_dep", columns={"code_arp_dep"}), @ORM\Index(name="fk_code_arp_arr", columns={"code_arp_arr"})})
 * @ORM\Entity
 */
class VolG
{
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="heure_dep", type="time", nullable=true)
     */
    private $heureDep;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="heure_arr", type="time", nullable=true)
     */
    private $heureArr;

    /**
     * @var integer
     *
     * @ORM\Column(name="prix", type="integer", nullable=true)
     */
    private $prix;

    /**
     * @var integer
     *
     * @ORM\Column(name="nbr_places", type="integer", nullable=true)
     */
    private $nbrPlaces;

    /**
     * @var string
     *
     * @ORM\Column(name="jour", type="string", length=10, nullable=true)
     */
    private $jour;

    /**
     * @var string
     *
     * @ORM\Column(name="vlg_num", type="string", length=20)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $vlgNum;

    /**
     * @var \AppBundle\Entity\Aeroport
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Aeroport")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="code_arp_arr", referencedColumnName="code")
     * })
     */
    private $codeArpArr;

    /**
     * @var \AppBundle\Entity\Aeroport
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Aeroport")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="code_arp_dep", referencedColumnName="code")
     * })
     */
    private $codeArpDep;


}

