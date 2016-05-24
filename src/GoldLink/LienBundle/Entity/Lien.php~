<?php

namespace GoldLink\LienBundle\Entity;
use Doctrine\Common\Collections\ArrayCollection;
use GoldLink\LienBundle\Entity\Visibilite;
use Doctrine\ORM\Mapping as ORM;
/**
 * Lien
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="GoldLink\LienBundle\Entity\LienRepository")
 */
class Lien
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
     * @var string
     *
     * @ORM\Column(name="url", type="string", length=255)
     */
    private $url;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateCreation", type="datetime")
     */
    private $dateCreation;


    /**
     * @ORM\ManyToOne(targetEntity="GoldLink\LienBundle\Entity\thematique")
     */

    private $thematiqueLien;


    /**
     * @ORM\ManyToOne(targetEntity="GoldLink\UserBundle\Entity\User")
     */

    private $proprietaire;

    /**
     * @ORM\ManyToOne(targetEntity="GoldLink\LienBundle\Entity\Visibilite")
     */

    private $visibiliteLien;

    /**
     * @ORM\ManyToMany(targetEntity="GoldLink\UserBundle\Entity\Groupe")
     */
    private $groupeLiens;

    /**
     * @var string
     *
     * @ORM\Column(name="titre", type="string", length=255)
     */

    private $titre;


    /**
     * @ORM\ManyToMany(targetEntity="GoldLink\LienBundle\Entity\Tag", cascade={"persist"})
     */

    private $tags;

    /**
     * @ORM\OneToMany(targetEntity="GoldLink\LienBundle\Entity\publication", cascade={"persist"} , mappedBy="publicationLien")
     */

    private $publication;
    /**
     * @ORM\OneToMany(targetEntity="GoldLink\LienBundle\Entity\notations", mappedBy="LienNote")
     */
    private $notations;
    /**
     * @ORM\OneToMany(targetEntity="GoldLink\LienBundle\Entity\cliquer",  mappedBy="lienClique")
     */
    private $cliques;

    /**
     * @ORM\OneToMany(targetEntity="GoldLink\LienBundle\Entity\LienEnregistrer",  mappedBy="lienConcerner")
     */
    private $enregistrements;
    /**
     * @ORM\OneToMany(targetEntity="GoldLink\LienBundle\Entity\PublicationGroupe",  mappedBy="lien")
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
     * Set url
     *
     * @param string $url
     * @return Lien
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
     * Set dateCreation
     *
     * @param \DateTime $dateCreation
     * @return Lien
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
     * Constructor
     */
    public function __construct()
    {
        $this->groupeLiens = new ArrayCollection();
        $this->enregistrements = new ArrayCollection();
        $this->tags = new ArrayCollection();
        $this->setDateCreation(new \DateTime());
    }


    /**
     * Set thematiqueLien
     *
     * @param \GoldLink\LienBundle\Entity\thematique $thematiqueLien
     * @return Lien
     */
    public function setThematiqueLien(\GoldLink\LienBundle\Entity\thematique $thematiqueLien = null)
    {
        $this->thematiqueLien = $thematiqueLien;

        return $this;
    }

    /**
     * Get thematiqueLien
     *
     * @return \GoldLink\LienBundle\Entity\thematique 
     */
    public function getThematiqueLien()
    {
        return $this->thematiqueLien;
    }

    /**
     * Set visibiliteLien
     *
     * @param \GoldLink\LienBundle\Entity\Visibilite $visibiliteLien
     * @return Lien
     */
    public function setVisibiliteLien(\GoldLink\LienBundle\Entity\Visibilite $visibiliteLien)
    {
        $this->visibiliteLien = $visibiliteLien;

        return $this;
    }

    /**
     * Get visibiliteLien
     *
     * @return \GoldLink\LienBundle\Entity\Visibilite
     */
    public function getVisibiliteLien()
    {
        return $this->visibiliteLien;
    }

    /**
     * Add groupeLiens
     *
     * @param \GoldLink\UserBundle\Entity\Groupe $groupeLiens
     * @return Lien
     */
    public function addGroupeLien(\GoldLink\UserBundle\Entity\Groupe $groupeLiens)
    {
        $this->groupeLiens[] = $groupeLiens;

        return $this;
    }

    /**
     * Remove groupeLiens
     *
     * @param \GoldLink\UserBundle\Entity\Groupe $groupeLiens
     */
    public function removeGroupeLien(\GoldLink\UserBundle\Entity\Groupe $groupeLiens)
    {
        $this->groupeLiens->removeElement($groupeLiens);
    }

    /**
     * Get groupeLiens
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getGroupeLiens()
    {
        return $this->groupeLiens;
    }

    /**
     * Set titre
     *
     * @param string $titre
     * @return Lien
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;

        return $this;
    }

    /**
     * Get titre
     *
     * @return string 
     */
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * Set proprietaire
     *
     * @param \GoldLink\UserBundle\Entity\User $proprietaire
     * @return Lien
     */
    public function setProprietaire(\GoldLink\UserBundle\Entity\User $proprietaire = null)
    {
        $this->proprietaire = $proprietaire;

        return $this;
    }

    /**
     * Get proprietaire
     *
     * @return \GoldLink\UserBundle\Entity\User 
     */
    public function getProprietaire()
    {
        return $this->proprietaire;
    }

    /**
     * Add tags
     *
     * @param \GoldLink\LienBundle\Entity\Tag $tags
     * @return Lien
     */
    public function addTag(\GoldLink\LienBundle\Entity\Tag $tags)
    {
        $this->tags[] = $tags;

        return $this;
    }

    /**
     * Remove tags
     *
     * @param \GoldLink\LienBundle\Entity\Tag $tags
     */
    public function removeTag(\GoldLink\LienBundle\Entity\Tag $tags)
    {
        $this->tags->removeElement($tags);
    }

    /**
     * Get tags
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getTags()
    {
        return $this->tags;
    }

    public function clearTags(){
        $this->tags = [];
    }

    /**
     * Add publication
     *
     * @param \GoldLink\LienBundle\Entity\Publication $publication
     * @return Lien
     */
    public function addPublication(\GoldLink\LienBundle\Entity\Publication $publication)
    {
        $this->publication[] = $publication;

        return $this;
    }

    /**
     * Remove publication
     *
     * @param \GoldLink\LienBundle\Entity\Publication $publication
     */
    public function removePublication(\GoldLink\LienBundle\Entity\Publication $publication)
    {
        $this->publication->removeElement($publication);
    }

    /**
     * Get publication
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPublication()
    {
        return $this->publication;
    }


    /**
     * Add notations
     *
     * @param \GoldLink\LienBundle\Entity\notations $notations
     * @return Lien
     */
    public function addNotation(\GoldLink\LienBundle\Entity\notations $notations)
    {
        $this->notations[] = $notations;

        return $this;
    }

    /**
     * Remove notations
     *
     * @param \GoldLink\LienBundle\Entity\notations $notations
     */
    public function removeNotation(\GoldLink\LienBundle\Entity\notations $notations)
    {
        $this->notations->removeElement($notations);
    }

    /**
     * Get notations
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getNotations()
    {
        return $this->notations;
    }

    /**
     * Add cliques
     *
     * @param \GoldLink\LienBundle\Entity\cliquer $cliques
     * @return Lien
     */
    public function addClique(\GoldLink\LienBundle\Entity\cliquer $cliques)
    {
        $this->cliques[] = $cliques;

        return $this;
    }

    /**
     * Remove cliques
     *
     * @param \GoldLink\LienBundle\Entity\cliquer $cliques
     */
    public function removeClique(\GoldLink\LienBundle\Entity\cliquer $cliques)
    {
        $this->cliques->removeElement($cliques);
    }

    /**
     * Get cliques
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCliques()
    {
        return $this->cliques;
    }

    /**
     * Add enregistrements
     *
     * @param \GoldLink\LienBundle\Entity\LienEnregistrer $enregistrements
     * @return Lien
     */
    public function addEnregistrement(\GoldLink\LienBundle\Entity\LienEnregistrer $enregistrements)
    {
        $this->enregistrements[] = $enregistrements;

        return $this;
    }

    /**
     * Remove enregistrements
     *
     * @param \GoldLink\LienBundle\Entity\LienEnregistrer $enregistrements
     */
    public function removeEnregistrement(\GoldLink\LienBundle\Entity\LienEnregistrer $enregistrements)
    {
        $this->enregistrements->removeElement($enregistrements);
    }

    /**
     * Get enregistrements
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getEnregistrements()
    {
        return $this->enregistrements;
    }


    /**
     * Add publicationGroupe
     *
     * @param \GoldLink\LienBundle\Entity\PublicationGroupe $publicationGroupe
     * @return Lien
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
}
