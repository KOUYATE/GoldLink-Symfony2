<?php

namespace GoldLink\LienBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * LienEnregistrer
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="GoldLink\LienBundle\Entity\LienEnregistrerRepository")
 */
class LienEnregistrer
{

    /**
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="GoldLink\UserBundle\Entity\User" )
     */
    private $utilisateurAjouteur;
    /**
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="GoldLink\LienBundle\Entity\Lien",inversedBy="enregistrements")
     */
    private $lienConcerner;

    /**
     * Set utilisateurAjouteur
     *
     * @param \GoldLink\UserBundle\Entity\User $utilisateurAjouteur
     * @return LienEnregistrer
     */
    public function setUtilisateurAjouteur(\GoldLink\UserBundle\Entity\User $utilisateurAjouteur)
    {
        $this->utilisateurAjouteur = $utilisateurAjouteur;

        return $this;
    }

    /**
     * Get utilisateurAjouteur
     *
     * @return \GoldLink\UserBundle\Entity\User 
     */
    public function getUtilisateurAjouteur()
    {
        return $this->utilisateurAjouteur;
    }

    /**
     * Set lienConcerner
     *
     * @param \GoldLink\LienBundle\Entity\Lien $lienConcerner
     * @return LienEnregistrer
     */
    public function setLienConcerner(\GoldLink\LienBundle\Entity\Lien $lienConcerner)
    {
        $this->lienConcerner = $lienConcerner;

        return $this;
    }

    /**
     * Get lienConcerner
     *
     * @return \GoldLink\LienBundle\Entity\Lien 
     */
    public function getLienConcerner()
    {
        return $this->lienConcerner;
    }
}
