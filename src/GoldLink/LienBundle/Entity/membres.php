<?php

namespace GoldLink\LienBundle\Entity;
use GoldLink\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * membres
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="GoldLink\LienBundle\Entity\membresRepository")
 */
class membres
{


    /**
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="GoldLink\UserBundle\Entity\User", cascade={"remove"})
     */
    private $userAdhesion;

    /**
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="GoldLink\UserBundle\Entity\Groupe" )
     */
    private $grouperAdhesion;



    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateAdhesion", type="datetime")
     */
    private $dateAdhesion;




    /**
     * Set dateAdhesion
     *
     * @param \DateTime $dateAdhesion
     * @return membres
     */
    public function setDateAdhesion($dateAdhesion)
    {
        $this->dateAdhesion = $dateAdhesion;

        return $this;
    }

    /**
     * Get dateAdhesion
     *
     * @return \DateTime 
     */
    public function getDateAdhesion()
    {
        return $this->dateAdhesion;
    }

    /**
     * Set userAdhesion
     *
     * @param \GoldLink\UserBundle\Entity\User $userAdhesion
     * @return membres
     */
    public function setUserAdhesion(\GoldLink\UserBundle\Entity\User $userAdhesion)
    {
        $this->userAdhesion = $userAdhesion;

        return $this;
    }

    /**
     * Get userAdhesion
     *
     * @return \GoldLink\UserBundle\Entity\User 
     */
    public function getUserAdhesion()
    {
        return $this->userAdhesion;
    }

    /**
     * Set grouperAdhesion
     *
     * @param \GoldLink\UserBundle\Entity\Groupe $grouperAdhesion
     * @return membres
     */
    public function setGrouperAdhesion(\GoldLink\UserBundle\Entity\Groupe $grouperAdhesion)
    {
        $this->grouperAdhesion = $grouperAdhesion;

        return $this;
    }

    /**
     * Get grouperAdhesion
     *
     * @return \GoldLink\UserBundle\Entity\Groupe 
     */
    public function getGrouperAdhesion()
    {
        return $this->grouperAdhesion;
    }
}
