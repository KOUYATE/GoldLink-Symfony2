<?php

namespace GoldLink\LienBundle\Entity;
use GoldLink\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Parametre
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="GoldLink\LienBundle\Entity\ParametreRepository")
 */
class Parametre
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
     * @var integer
     *
     * @ORM\Column(name="nombreDeVotant", type="integer")
     */
    private $nombreDeVotant;

    /**
     * @var integer
     *
     * @ORM\Column(name="noteMaximale", type="integer")
     */
    private $noteMaximale;

    /**
     * @var integer
     *
     * @ORM\Column(name="nombreDePartage", type="integer")
     */
    private $nombreDePartage;

    public function __construct(){
        $this->nombreDePartage = 5;
        $this->nombreDeVotant = 5;
        $this->noteMaximale = 5;
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
     * Set nombreDeVotant
     *
     * @param integer $nombreDeVotant
     * @return Parametre
     */
    public function setNombreDeVotant($nombreDeVotant)
    {
        $this->nombreDeVotant = $nombreDeVotant;

        return $this;
    }

    /**
     * Get nombreDeVotant
     *
     * @return integer 
     */
    public function getNombreDeVotant()
    {
        return $this->nombreDeVotant;
    }

    /**
     * Set noteMaximale
     *
     * @param integer $noteMaximale
     * @return Parametre
     */
    public function setNoteMaximale($noteMaximale)
    {
        $this->noteMaximale = $noteMaximale;

        return $this;
    }

    /**
     * Get noteMaximale
     *
     * @return integer 
     */
    public function getNoteMaximale()
    {
        return $this->noteMaximale;
    }

    /**
     * Set nombreDePartage
     *
     * @param integer $nombreDePartage
     * @return Parametre
     */
    public function setNombreDePartage($nombreDePartage)
    {
        $this->nombreDePartage = $nombreDePartage;

        return $this;
    }

    /**
     * Get nombreDePartage
     *
     * @return integer 
     */
    public function getNombreDePartage()
    {
        return $this->nombreDePartage;
    }

}
