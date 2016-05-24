<?php

namespace GoldLink\LienBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PublicationGroupe
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="GoldLink\LienBundle\Entity\PublicationGroupeRepository")
 */
class PublicationGroupe
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;
    /**
     * @ORM\ManyToOne(targetEntity="GoldLink\LienBundle\Entity\Lien")
     */
    private $lien;

    /**
     * @ORM\ManyToOne(targetEntity="GoldLink\UserBundle\Entity\User")
     */
    private $utilisateur;
    /**
     * @ORM\ManyToOne(targetEntity="GoldLink\UserBundle\Entity\Groupe")
     */
    private $groupe;
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
     * Set date
     *
     * @param \DateTime $date
     * @return PublicationGroupe
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime 
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set lien
     *
     * @param \GoldLink\LienBundle\Entity\Lien $lien
     * @return PublicationGroupe
     */
    public function setLien(\GoldLink\LienBundle\Entity\Lien $lien = null)
    {
        $this->lien = $lien;

        return $this;
    }

    /**
     * Get lien
     *
     * @return \GoldLink\LienBundle\Entity\Lien 
     */
    public function getLien()
    {
        return $this->lien;
    }

    /**
     * Set utilisateur
     *
     * @param \GoldLink\UserBundle\Entity\User $utilisateur
     * @return PublicationGroupe
     */
    public function setUtilisateur(\GoldLink\UserBundle\Entity\User $utilisateur = null)
    {
        $this->utilisateur = $utilisateur;

        return $this;
    }

    /**
     * Get utilisateur
     *
     * @return \GoldLink\UserBundle\Entity\User 
     */
    public function getUtilisateur()
    {
        return $this->utilisateur;
    }

    /**
     * Set groupe
     *
     * @param \GoldLink\UserBundle\Entity\Groupe $groupe
     * @return PublicationGroupe
     */
    public function setGroupe(\GoldLink\UserBundle\Entity\Groupe $groupe = null)
    {
        $this->groupe = $groupe;

        return $this;
    }

    /**
     * Get groupe
     *
     * @return \GoldLink\UserBundle\Entity\Groupe 
     */
    public function getGroupe()
    {
        return $this->groupe;
    }
}
