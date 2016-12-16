<?php

namespace CatchmeBundle\Entity;

/**
 * Challenge
 */
class Challenge
{

//    GENERATE CODE



    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $nom;

    /**
     * @var string
     */
    private $description;

    /**
     * @var string
     */
    private $localisation;

    /**
     * @var float
     */
    private $longitude;

    /**
     * @var float
     */
    private $latitude;

    /**
     * @var \CatchmeBundle\Entity\Image
     */
    private $image;

    /**
     * @var \CatchmeBundle\Entity\User
     */
    private $user_meneur;

    /**
     * @var \CatchmeBundle\Entity\User
     */
    private $user_createur;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $users;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->users = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set nom
     *
     * @param string $nom
     * @return Challenge
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string 
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Challenge
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
     * Set localisation
     *
     * @param string $localisation
     * @return Challenge
     */
    public function setLocalisation($localisation)
    {
        $this->localisation = $localisation;

        return $this;
    }

    /**
     * Get localisation
     *
     * @return string 
     */
    public function getLocalisation()
    {
        return $this->localisation;
    }

    /**
     * Set longitude
     *
     * @param float $longitude
     * @return Challenge
     */
    public function setLongitude($longitude)
    {
        $this->longitude = $longitude;

        return $this;
    }

    /**
     * Get longitude
     *
     * @return float 
     */
    public function getLongitude()
    {
        return $this->longitude;
    }

    /**
     * Set latitude
     *
     * @param float $latitude
     * @return Challenge
     */
    public function setLatitude($latitude)
    {
        $this->latitude = $latitude;

        return $this;
    }

    /**
     * Get latitude
     *
     * @return float 
     */
    public function getLatitude()
    {
        return $this->latitude;
    }

    /**
     * Set image
     *
     * @param \CatchmeBundle\Entity\Image $image
     * @return Challenge
     */
    public function setImage(\CatchmeBundle\Entity\Image $image = null)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return \CatchmeBundle\Entity\Image 
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set user_meneur
     *
     * @param \CatchmeBundle\Entity\User $userMeneur
     * @return Challenge
     */
    public function setUserMeneur(\CatchmeBundle\Entity\User $userMeneur = null)
    {
        $this->user_meneur = $userMeneur;

        return $this;
    }

    /**
     * Get user_meneur
     *
     * @return \CatchmeBundle\Entity\User 
     */
    public function getUserMeneur()
    {
        return $this->user_meneur;
    }

    /**
     * Set user_createur
     *
     * @param \CatchmeBundle\Entity\User $userCreateur
     * @return Challenge
     */
    public function setUserCreateur(\CatchmeBundle\Entity\User $userCreateur = null)
    {
        $this->user_createur = $userCreateur;

        return $this;
    }

    /**
     * Get user_createur
     *
     * @return \CatchmeBundle\Entity\User 
     */
    public function getUserCreateur()
    {
        return $this->user_createur;
    }

    /**
     * Add users
     *
     * @param \CatchmeBundle\Entity\User $users
     * @return Challenge
     */
    public function addUser(\CatchmeBundle\Entity\User $users)
    {
        $this->users[] = $users;

        return $this;
    }

    /**
     * Remove users
     *
     * @param \CatchmeBundle\Entity\User $users
     */
    public function removeUser(\CatchmeBundle\Entity\User $users)
    {
        $this->users->removeElement($users);
    }

    /**
     * Get users
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getUsers()
    {
        return $this->users;
    }
}
