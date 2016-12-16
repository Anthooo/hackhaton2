<?php
// src/CatchmeBundle/Entity/User.php

namespace CatchmeBundle\Entity;

use FOS\UserBundle\Entity\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 */
class User extends BaseUser
{


    /**
     * @var string
     */
    private $nom;

    /**
     * @var string
     */
    private $prenom;

    /**
     * @var integer
     */
    private $score = 0;

    /**
     * @var \CatchmeBundle\Entity\Image
     */
    private $image;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $challenges;


    /**
     * Set nom
     *
     * @param string $nom
     * @return User
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
     * Set prenom
     *
     * @param string $prenom
     * @return User
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * Get prenom
     *
     * @return string
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * Set score
     *
     * @param integer $score
     * @return User
     */
    public function setScore($score)
    {
        $this->score = $score;

        return $this;
    }

    /**
     * Get score
     *
     * @return integer
     */
    public function getScore()
    {
        return $this->score;
    }

    /**
     * Set image
     *
     * @param \CatchmeBundle\Entity\Image $image
     * @return User
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
     * Add challenges
     *
     * @param \CatchmeBundle\Entity\Challenge $challenges
     * @return User
     */
    public function addChallenge(\CatchmeBundle\Entity\Challenge $challenges)
    {
        $this->challenges[] = $challenges;

        return $this;
    }

    /**
     * Remove challenges
     *
     * @param \CatchmeBundle\Entity\Challenge $challenges
     */
    public function removeChallenge(\CatchmeBundle\Entity\Challenge $challenges)
    {
        $this->challenges->removeElement($challenges);
    }

    /**
     * Get challenges
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getChallenges()
    {
        return $this->challenges;
    }
}
