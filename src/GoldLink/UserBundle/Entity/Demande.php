<?php

namespace GoldLink\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Demande
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="GoldLink\UserBundle\Entity\DemandeRepository")
 */
class Demande
{
    /**
     *
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="GoldLink\UserBundle\Entity\User" , inversedBy="demande")
     */
    private $emetteur;

    /**
     *
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="GoldLink\UserBundle\Entity\Groupe" , inversedBy="demande")
     */

    private $groupe;


    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateEnvoie", type="datetime")
     */
    private $dateEnvoie;

    public function __construct(){
        $this->dateEnvoie = new \DateTime();
    }


    /**
     * Set dateEnvoie
     *
     * @param \DateTime $dateEnvoie
     * @return Demande
     */
    public function setDateEnvoie($dateEnvoie)
    {
        $this->dateEnvoie = $dateEnvoie;

        return $this;
    }

    /**
     * Get dateEnvoie
     *
     * @return \DateTime
     */
    public function getDateEnvoie()
    {
        return $this->dateEnvoie;
    }

    /**
     * Set emetteur
     *
     * @param \GoldLink\UserBundle\Entity\User $emetteur
     * @return Demande
     */
    public function setEmetteur(\GoldLink\UserBundle\Entity\User $emetteur)
    {
        $this->emetteur = $emetteur;

        return $this;
    }

    /**
     * Get emetteur
     *
     * @return \GoldLink\UserBundle\Entity\User
     */
    public function getEmetteur()
    {
        return $this->emetteur;
    }

    /**
     * Set groupe
     *
     * @param \GoldLink\UserBundle\Groupe $groupe
     * @return Demande
     */
    public function setGroupe(\GoldLink\UserBundle\Entity\Groupe $groupe)
    {
        $this->groupe = $groupe;

        return $this;
    }

    /**
     * Get groupe
     *
     * @return \GoldLink\UserBundle\Groupe
     */
    public function getGroupe()
    {
        return $this->groupe;
    }


}
