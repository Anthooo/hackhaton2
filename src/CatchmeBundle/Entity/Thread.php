<?php
// src/CatchmeBundle/Entity/Thread.php

namespace CatchmeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use FOS\MessageBundle\Entity\Thread as BaseThread;

/**
 * @ORM\Entity
 */
class Thread extends BaseThread
{


    /**
     * Remove message
     *
     * @param \CatchmeBundle\Entity\Message $message
     */
    public function removeMessage(\CatchmeBundle\Entity\Message $message)
    {
        $this->messages->removeElement($message);
    }

    /**
     * Add metadatum
     *
     * @param \CatchmeBundle\Entity\ThreadMetadata $metadatum
     *
     * @return Thread
     */
    public function addMetadatum(\CatchmeBundle\Entity\ThreadMetadata $metadatum)
    {
        $this->metadata[] = $metadatum;

        return $this;
    }

    /**
     * Remove metadatum
     *
     * @param \CatchmeBundle\Entity\ThreadMetadata $metadatum
     */
    public function removeMetadatum(\CatchmeBundle\Entity\ThreadMetadata $metadatum)
    {
        $this->metadata->removeElement($metadatum);
    }

    /**
     * Get metadata
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getMetadata()
    {
        return $this->metadata;
    }
}
