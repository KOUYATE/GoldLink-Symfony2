<?php

namespace GoldLink\LienBundle\Entity;
use GoldLink\UserBundle\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * thematique
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="GoldLink\LienBundle\Entity\thematiqueRepository")
 */
class thematique
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
     * @ORM\Column(name="libelleThematique", type="string", length=255)
     */
    private $libelleThematique;


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
     * Set libelleThematique
     *
     * @param string $libelleThematique
     * @return thematique
     */
    public function setLibelleThematique($libelleThematique)
    {
        $this->libelleThematique = $libelleThematique;

        return $this;
    }

    /**
     * Get libelleThematique
     *
     * @return string 
     */
    public function getLibelleThematique()
    {
        return $this->libelleThematique;
    }
}
