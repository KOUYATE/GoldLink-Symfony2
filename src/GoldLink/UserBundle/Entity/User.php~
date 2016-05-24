<?php

namespace GoldLink\UserBundle\Entity;
use GoldLink\LienBundle\Entity;
use GoldLink\UserBundle\Controller;

use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as Utilisateur;

/**
 * User
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="GoldLink\UserBundle\Entity\UserRepository")
 */
class User extends Utilisateur
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected  $id;

    /**
     * @var string
     *
     * @ORM\Column(name="github_id", type="string", nullable=true)
     */
    private $githubID;

    /**
     * @var string
     *
     * @ORM\Column(name="facebook_id", type="string", nullable=true)
     */
    private $facebookID;



    /**
     * @var string
     *
     * @ORM\Column(name="google_id", type="string", nullable=true)
     */
    private $googleID;

    /**
     * @var string
     *
     * @ORM\Column(name="yahoo_id", type="string", nullable=true)
     */
    private $yahooID;

    /**
     * @var string
     *
     * @ORM\Column(name="dropbox_id", type="string", nullable=true)
     */
    private $dropboxID;
    /**
     * @var string
     *
     * @ORM\Column(name="windowslive_id", type="string", nullable=true)
     */
    private $windowsliveID;

    /**
     * @var string
     *
     * @ORM\Column(name="linkedin_id", type="string", nullable=true)
     */
    private $linkedinID;

    /**
     * @var string
     *
     * @ORM\Column(name="foursquare_id", type="string", nullable=true)
     */
    private $foursquareID;

    /**
     * @ORM\OneToMany(targetEntity="GoldLink\LienBundle\Entity\membres", mappedBy="userAdhesion")
     */
    private $groupes;

    /**
     * @var string
     * @ORM\Column(name="avatar",type="string",nullable=false)
     */
    private $avatar;

    /**
     * @var text
     * @ORM\Column(name="biographie", type="text" ,nullable=true)
     */
    private $biographie;

    /**
     * @var datetime
     * @ORM\Column(name="date_incription",type="datetime",nullable=false)
     */
    private $dateInscription;

    /**
     * @ORM\OneToMany(targetEntity="GoldLink\UserBundle\Entity\Demande", mappedBy="emetteur")
     */

    private $demande;


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
     * Set githubID
     *
     * @param string $githubID
     * @return User
     */
    public function setGithubID($githubID)
    {
        $this->githubID = $githubID;

        return $this;
    }

    /**
     * Get githubID
     *
     * @return string 
     */
    public function getGithubID()
    {
        return $this->githubID;
    }

    /**
     * Set facebookID
     *
     * @param string $facebookID
     * @return User
     */
    public function setFacebookID($facebookID)
    {
        $this->facebookID = $facebookID;

        return $this;
    }

    /**
     * Get facebookID
     *
     * @return string 
     */
    public function getFacebookID()
    {
        return $this->facebookID;
    }

    /**
     * Set googleID
     *
     * @param string $googleID
     * @return User
     */
    public function setGoogleID($googleID)
    {
        $this->googleID = $googleID;

        return $this;
    }

    /**
     * Get googleID
     *
     * @return string 
     */
    public function getGoogleID()
    {
        return $this->googleID;
    }

    /**
     * Set yahooID
     *
     * @param string $yahooID
     * @return User
     */
    public function setYahooID($yahooID)
    {
        $this->yahooID = $yahooID;

        return $this;
    }

    /**
     * Get yahooID
     *
     * @return string 
     */
    public function getYahooID()
    {
        return $this->yahooID;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->groupes = new \Doctrine\Common\Collections\ArrayCollection();
        $this->avatar =  'bundles/goldlinkuser/images/avatar.jpg';
        $this->dateInscription = new \DateTime();
        parent::__construct();
    }

    /**
     * Set avatar
     *
     * @param string $avatar
     * @return User
     */
    public function setAvatar($avatar)
    {
        $this->avatar = $avatar;

        return $this;
    }

    /**
     * Get avatar
     *
     * @return string 
     */
    public function getAvatar()
    {
        return $this->avatar;
    }

    /**
     * Set biographie
     *
     * @param string $biographie
     * @return User
     */
    public function setBiographie($biographie)
    {
        $this->biographie = $biographie;

        return $this;
    }

    /**
     * Get biographie
     *
     * @return string 
     */
    public function getBiographie()
    {
        return $this->biographie;
    }

    /**
     * Set dropboxID
     *
     * @param string $dropboxID
     * @return User
     */
    public function setDropboxID($dropboxID)
    {
        $this->dropboxID = $dropboxID;

        return $this;
    }

    /**
     * Get dropboxID
     *
     * @return string 
     */
    public function getDropboxID()
    {
        return $this->dropboxID;
    }

    /**
     * Set windowsliveID
     *
     * @param string $windowsliveID
     * @return User
     */
    public function setWindowsliveID($windowsliveID)
    {
        $this->windowsliveID = $windowsliveID;

        return $this;
    }

    /**
     * Get windowsliveID
     *
     * @return string 
     */
    public function getWindowsliveID()
    {
        return $this->windowsliveID;
    }

    /**
     * Set linkedinID
     *
     * @param string $linkedinID
     * @return User
     */
    public function setLinkedinID($linkedinID)
    {
        $this->linkedinID = $linkedinID;

        return $this;
    }

    /**
     * Get linkedinID
     *
     * @return string 
     */
    public function getLinkedinID()
    {
        return $this->linkedinID;
    }

    /**
     * Set foursquareID
     *
     * @param string $foursquareID
     * @return User
     */
    public function setFoursquareID($foursquareID)
    {
        $this->foursquareID = $foursquareID;

        return $this;
    }

    /**
     * Get foursquareID
     *
     * @return string 
     */
    public function getFoursquareID()
    {
        return $this->foursquareID;
    }

    /**
     * Set dateInscription
     *
     * @param \DateTime $dateInscription
     * @return User
     */
    public function setDateInscription($dateInscription)
    {
        $this->dateInscription = $dateInscription;

        return $this;
    }

    /**
     * Get dateInscription
     *
     * @return \DateTime 
     */
    public function getDateInscription()
    {
        return $this->dateInscription;
    }

    public function groupeNom($nom){
        $groupes=$this->getGroupes();

        foreach($groupes as $groupe){
            $n = $groupe->getGrouperAdhesion()->getNomDuGroupe();
            if($n === $nom){
                return true;
            }
        }
        return false;
    }


    /**
     * Add groupes
     *
     * @param \GoldLink\LienBundle\Entity\membres $groupes
     * @return User
     */
    public function addGroupe(\GoldLink\LienBundle\Entity\membres $groupes)
    {
        $this->groupes[] = $groupes;

        return $this;
    }

    /**
     * Remove groupes
     *
     * @param \GoldLink\LienBundle\Entity\membres $groupes
     */
    public function removeGroupe(\GoldLink\LienBundle\Entity\membres $groupes)
    {
        $this->groupes->removeElement($groupes);
    }

    /**
     * Get groupes
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getGroupes()
    {
        return $this->groupes;
    }

    public function isGranted($role)
    {
        return in_array($role, $this->getRoles());
    }

    /**
     * Add demande
     *
     * @param \GoldLink\UserBundle\Entity\Demande $demande
     * @return User
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
