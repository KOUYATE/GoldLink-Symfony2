<?php

namespace GoldLink\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Reseau
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="GoldLink\UserBundle\Entity\ReseauRepository")
 */
class Reseau
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
     * @var string
     *
     * @ORM\Column(name="nomDuReseau", type="string", length=60)
     */
    private $nomDuReseau;

    /**
     * @var string
     *
     * @ORM\Column(name="logo", type="string", length=124)
     */
    private $logo;

    /**
     * @var string
     *
     * @ORM\Column(name="url", type="string", length=255)
     */
    private $url;




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
     * Set nomDuReseau
     *
     * @param string $nomDuReseau
     * @return Reseau
     */
    public function setNomDuReseau($nomDuReseau)
    {
        $this->nomDuReseau = $nomDuReseau;

        return $this;
    }

    /**
     * Get nomDuReseau
     *
     * @return string 
     */
    public function getNomDuReseau()
    {
        return $this->nomDuReseau;
    }

    /**
     * Set logo
     *
     * @param string $logo
     * @return Reseau
     */
    public function setLogo($logo)
    {
        $this->logo = $logo;

        return $this;
    }

    /**
     * Get logo
     *
     * @return string 
     */
    public function getLogo()
    {
        return $this->logo;
    }

    /**
     * Set url
     *
     * @param string $url
     * @return Reseau
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Get url
     *
     * @return string 
     */
    public function getUrl()
    {
        return $this->url;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->utilisateurs = new \Doctrine\Common\Collections\ArrayCollection();
    }


}
