<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Client
 *
 * @ORM\Table(name="client")
 * @ORM\Entity
 */
class Client
{
    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=30, nullable=true)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="prenom", type="string", length=30, nullable=true)
     */
    private $prenom;

    /**
     * @var string
     *
     * @ORM\Column(name="adr_rue", type="string", length=30, nullable=true)
     */
    private $adrRue;

    /**
     * @var integer
     *
     * @ORM\Column(name="adr_cp", type="integer", nullable=true)
     */
    private $adrCp;

    /**
     * @var string
     *
     * @ORM\Column(name="adr_ville", type="string", length=30, nullable=true)
     */
    private $adrVille;

    /**
     * @var integer
     *
     * @ORM\Column(name="cln_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $clnId;



    /**
     * Set nom
     *
     * @param string $nom
     *
     * @return Client
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set prenom
     *
     * @param string $prenom
     *
     * @return Client
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * Get prenom
     *
     * @return string
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * Set adrRue
     *
     * @param string $adrRue
     *
     * @return Client
     */
    public function setAdrRue($adrRue)
    {
        $this->adrRue = $adrRue;

        return $this;
    }

    /**
     * Get adrRue
     *
     * @return string
     */
    public function getAdrRue()
    {
        return $this->adrRue;
    }

    /**
     * Set adrCp
     *
     * @param integer $adrCp
     *
     * @return Client
     */
    public function setAdrCp($adrCp)
    {
        $this->adrCp = $adrCp;

        return $this;
    }

    /**
     * Get adrCp
     *
     * @return integer
     */
    public function getAdrCp()
    {
        return $this->adrCp;
    }

    /**
     * Set adrVille
     *
     * @param string $adrVille
     *
     * @return Client
     */
    public function setAdrVille($adrVille)
    {
        $this->adrVille = $adrVille;

        return $this;
    }

    /**
     * Get adrVille
     *
     * @return string
     */
    public function getAdrVille()
    {
        return $this->adrVille;
    }

    /**
     * Get clnId
     *
     * @return integer
     */
    public function getClnId()
    {
        return $this->clnId;
    }
}
