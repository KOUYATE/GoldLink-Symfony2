<?php

namespace GoldLink\UserBundle\Entity;
use GoldLink\LienBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Groupe
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="GoldLink\UserBundle\Entity\GroupeRepository")
 */
class Groupe
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
     * @ORM\ManyToOne(targetEntity="GoldLink\UserBundle\Entity\User")
     * @ORM\JoinColumn(nullable=false)
     */
    private $administrateur;

    /**
     * @ORM\OneToMany(targetEntity="GoldLink\LienBundle\Entity\membres" , mappedBy="grouperAdhesion")
     */
    private $membres;

    /**
     * @ORM\OneToMany(targetEntity="GoldLink\UserBundle\Entity\Demande", mappedBy="groupe")
     */

    private $demande;


    /**
     * @var string
     *
     * @ORM\Column(name="droit", type="string")
     */

    private $droit;


    /**
     * @ORM\ManyToMany(targetEntity="Goldlink\LienBundle\Entity\Lien", inversedBy="groupeLiens")
     */
    private $liens;


    /**
     * @var text
     *
     * @ORM\Column(name="description", type="text")
     */

    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="nomDuGroupe", type="string", length=60)
     */

    private $nomDuGroupe;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateCreation", type="datetime")
     */
    private $dateCreation;

    /**
     * @ORM\OneToMany(targetEntity="GoldLink\LienBundle\Entity\PublicationGroupe" ,mappedBy="groupe")
     */

    private $publicationGroupe;

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
     * Set nomDuGroupe
     *
     * @param string $nomDuGroupe
     * @return Groupe
     */
    public function setNomDuGroupe($nomDuGroupe)
    {
        $this->nomDuGroupe = $nomDuGroupe;

        return $this;
    }

    /**
     * Get nomDuGroupe
     *
     * @return string
     */
    public function getNomDuGroupe()
    {
        return $this->nomDuGroupe;
    }

    /**
     * Set dateCreation
     *
     * @param \DateTime $dateCreation
     * @return Groupe
     */
    public function setDateCreation($dateCreation)
    {
        $this->dateCreation = $dateCreation;

        return $this;
    }

    /**
     * Get dateCreation
     *
     * @return \DateTime
     */
    public function getDateCreation()
    {
        return $this->dateCreation;
    }

    /**
     * Set administrateur
     *
     * @param \GoldLink\UserBundle\Entity\User $administrateur
     * @return Groupe
     */
    public function setAdministrateur(\GoldLink\UserBundle\Entity\User $administrateur)
    {
        $this->administrateur = $administrateur;

        return $this;
    }

    /**
     * Get administrateur
     *
     * @return \GoldLink\UserBundle\Entity\User
     */
    public function getAdministrateur()
    {
        return $this->administrateur;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->membres = new \Doctrine\Common\Collections\ArrayCollection();
        $this->dateCreation=new\DateTime();
    }

    /**
     * Add liens
     *
     * @param \Goldlink\LienBundle\Entity\Lien $liens
     * @return Groupe
     */
    public function addLien(\Goldlink\LienBundle\Entity\Lien $liens)
    {
        $this->liens[] = $liens;

        return $this;
    }

    /**
     * Remove liens
     *
     * @param \Goldlink\LienBundle\Entity\Lien $liens
     */
    public function removeLien(\Goldlink\LienBundle\Entity\Lien $liens)
    {
        $this->liens->removeElement($liens);
    }

    /**
     * Get liens
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getLiens()
    {
        return $this->liens;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Groupe
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set droit
     *
     * @param string $droit
     * @return Groupe
     */
    public function setDroit($droit)
    {
        $this->droit = $droit;

        return $this;
    }

    /**
     * Get droit
     *
     * @return string
     */
    public function getDroit()
    {
        return $this->droit;
    }

    /**
     * Add membres
     *
     * @param \GoldLink\LienBundle\Entity\membres $membres
     * @return Groupe
     */
    public function addMembre(\GoldLink\LienBundle\Entity\membres $membres)
    {
        $this->membres[] = $membres;

        return $this;
    }

    /**
     * Remove membres
     *
     * @param \GoldLink\LienBundle\Entity\membres $membres
     */
    public function removeMembre(\GoldLink\LienBundle\Entity\membres $membres)
    {
        $this->membres->removeElement($membres);
    }

    /**
     * Get membres
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getMembres()
    {
        return $this->membres;
    }

    /**
     * Add publicationGroupe
     *
     * @param \GoldLink\LienBundle\Entity\PublicationGroupe $publicationGroupe
     * @return Groupe
     */
    public function addPublicationGroupe(\GoldLink\LienBundle\Entity\PublicationGroupe $publicationGroupe)
    {
        $this->publicationGroupe[] = $publicationGroupe;

        return $this;
    }

    /**
     * Remove publicationGroupe
     *
     * @param \GoldLink\LienBundle\Entity\PublicationGroupe $publicationGroupe
     */
    public function removePublicationGroupe(\GoldLink\LienBundle\Entity\PublicationGroupe $publicationGroupe)
    {
        $this->publicationGroupe->removeElement($publicationGroupe);
    }

    /**
     * Get publicationGroupe
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPublicationGroupe()
    {
        return $this->publicationGroupe;
    }


    /**
     * Add demande
     *
     * @param \GoldLink\UserBundle\Entity\Demande $demande
     * @return Groupe
     */
    public function addDemande(\GoldLink\UserBundle\Entity\Demande $demande)
    {
        $this->demande[] = $demande;

        return $this;
    }

    /**
     * Remove demande
     *
     * @param \GoldLink\UserBundle\Entity\Demande $demande
     */
    public function removeDemande(\GoldLink\UserBundle\Entity\Demande $demande)
    {
        $this->demande->removeElement($demande);
    }

    /**
     * Get demande
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getDemande()
    {
        return $this->demande;
    }
}
