<?php

namespace GoldLink\LienBundle\Entity;
use GoldLink\UserBundle\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * publication
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="GoldLink\LienBundle\Entity\publicationRepository")
 */
class publication
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
     * @ORM\ManyToOne(targetEntity="GoldLink\LienBundle\Entity\Lien")
     */

    private $publicationLien;


    /**
     * @ORM\ManyToOne(targetEntity="GoldLink\UserBundle\Entity\User")
     */

    private $publicationUser;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="datePublication", type="datetime")
     */
    private $datePublication;


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
     * Set datePublication
     *
     * @param \DateTime $datePublication
     * @return publication
     */
    public function setDatePublication($datePublication)
    {
        $this->datePublication = $datePublication;

        return $this;
    }

    /**
     * Get datePublication
     *
     * @return \DateTime 
     */
    public function getDatePublication()
    {
        return $this->datePublication;
    }

    /**
     * Set publicationLien
     *
     * @param \GoldLink\LienBundle\Entity\Lien $publicationLien
     * @return publication
     */
    public function setPublicationLien(\GoldLink\LienBundle\Entity\Lien $publicationLien = null)
    {
        $this->publicationLien = $publicationLien;

        return $this;
    }

    /**
     * Get publicationLien
     *
     * @return \GoldLink\LienBundle\Entity\Lien 
     */
    public function getPublicationLien()
    {
        return $this->publicationLien;
    }

    /**
     * Set publicationUser
     *
     * @param \GoldLink\UserBundle\Entity\User $publicationUser
     * @return publication
     */
    public function setPublicationUser(\GoldLink\UserBundle\Entity\User $publicationUser = null)
    {
        $this->publicationUser = $publicationUser;

        return $this;
    }

    /**
     * Get publicationUser
     *
     * @return \GoldLink\UserBundle\Entity\User 
     */
    public function getPublicationUser()
    {
        return $this->publicationUser;
    }
}
