<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Agence
 *
 * @ORM\Table(name="agence")
 * @ORM\Entity
 */
class Agence
{
    /**
     * @var integer
     *
     * @ORM\Column(name="code_agence", type="integer", nullable=true)
     */
    private $codeAgence;

    /**
     * @var string
     *
     * @ORM\Column(name="mot_de_passe", type="string", length=30, nullable=true)
     */
    private $motDePasse;

    /**
     * @var integer
     *
     * @ORM\Column(name="gnc_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $gncId;



    /**
     * Set codeAgence
     *
     * @param integer $codeAgence
     *
     * @return Agence
     */
    public function setCodeAgence($codeAgence)
    {
        $this->codeAgence = $codeAgence;

        return $this;
    }

    /**
     * Get codeAgence
     *
     * @return integer
     */
    public function getCodeAgence()
    {
        return $this->codeAgence;
    }

    /**
     * Set motDePasse
     *
     * @param string $motDePasse
     *
     * @return Agence
     */
    public function setMotDePasse($motDePasse)
    {
        $this->motDePasse = $motDePasse;

        return $this;
    }

    /**
     * Get motDePasse
     *
     * @return string
     */
    public function getMotDePasse()
    {
        return $this->motDePasse;
    }

    /**
     * Get gncId
     *
     * @return integer
     */
    public function getGncId()
    {
        return $this->gncId;
    }
}
