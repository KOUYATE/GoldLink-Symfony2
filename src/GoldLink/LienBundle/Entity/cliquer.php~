<?php

namespace GoldLink\LienBundle\Entity;
use GoldLink\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * cliquer
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="GoldLink\LienBundle\Entity\cliquerRepository")
 */
class cliquer
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     *
     */
    private $id;
    /**
     *
     * @var \DateTime
     *
     * @ORM\Column(name="dateclique", type="datetime")
     */
    private $dateclique;

    /**
     *
     * @ORM\ManyToOne(targetEntity="GoldLink\UserBundle\Entity\User")
     */
    private $userClique;


    /**
     *
     * @ORM\ManyToOne(targetEntity="GoldLink\LienBundle\Entity\Lien",inversedBy="cliques")
     */
    private $lienClique;




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
     * Set dateclique
     *
     * @param \DateTime $dateclique
     * @return cliquer
     */
    public function setDateclique($dateclique)
    {
        $this->dateclique = $dateclique;

        return $this;
    }

    /**
     * Get dateclique
     *
     * @return \DateTime 
     */
    public function getDateclique()
    {
        return $this->dateclique;
    }

    /**
     * Set userClique
     *
     * @param \GoldLink\UserBundle\Entity\User $userClique
     * @return cliquer
     */
    public function setUserClique(\GoldLink\UserBundle\Entity\User $userClique)
    {
        $this->userClique = $userClique;

        return $this;
    }

    /**
     * Get userClique
     *
     * @return \GoldLink\UserBundle\Entity\User 
     */
    public function getUserClique()
    {
        return $this->userClique;
    }

    /**
     * Set lienClique
     *
     * @param \GoldLink\LienBundle\Entity\Lien $lienClique
     * @return cliquer
     */
    public function setLienClique(\GoldLink\LienBundle\Entity\Lien $lienClique)
    {
        $this->lienClique = $lienClique;

        return $this;
    }

    /**
     * Get lienClique
     *
     * @return \GoldLink\LienBundle\Entity\Lien 
     */
    public function getLienClique()
    {
        return $this->lienClique;
    }
}
