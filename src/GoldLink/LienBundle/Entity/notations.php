<?php

namespace GoldLink\LienBundle\Entity;
use GoldLink\UserBundle\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * notations
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="GoldLink\LienBundle\Entity\notationsRepository")
 */
class notations
{

    /**
     * @var integer
     *
     * @ORM\Column(name="nombreEtoile", type="integer")
     */
    private $nombreEtoile;



    /**
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="GoldLink\UserBundle\Entity\User")
     */
    private $userNote;

    /**
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="GoldLink\LienBundle\Entity\Lien" , inversedBy="notations")
     */
    private $LienNote;


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
     * Set nombreEtoile
     *
     * @param integer $nombreEtoile
     * @return notations
     */
    public function setNombreEtoile($nombreEtoile)
    {
        $this->nombreEtoile = $nombreEtoile;

        return $this;
    }

    /**
     * Get nombreEtoile
     *
     * @return integer 
     */
    public function getNombreEtoile()
    {
        return $this->nombreEtoile;
    }

    /**
     * Set userNote
     *
     * @param \GoldLink\UserBundle\Entity\User $userNote
     * @return notations
     */
    public function setUserNote(\GoldLink\UserBundle\Entity\User $userNote)
    {
        $this->userNote = $userNote;

        return $this;
    }

    /**
     * Get userNote
     *
     * @return \GoldLink\UserBundle\Entity\User 
     */
    public function getUserNote()
    {
        return $this->userNote;
    }

    /**
     * Set LienNote
     *
     * @param \GoldLink\LienBundle\Entity\Lien $lienNote
     * @return notations
     */
    public function setLienNote(\GoldLink\LienBundle\Entity\Lien $lienNote)
    {
        $this->LienNote = $lienNote;

        return $this;
    }

    /**
     * Get LienNote
     *
     * @return \GoldLink\LienBundle\Entity\Lien 
     */
    public function getLienNote()
    {
        return $this->LienNote;
    }
}
