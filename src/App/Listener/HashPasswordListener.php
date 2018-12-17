<?php

namespace App\Listener;

use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Event\LifecycleEventArgs;
use App\Entity\User;
use App\Utility\PasswordEncoder;

class HashPasswordListener implements EventSubscriber
{
    /**
     * Pre persist
     *
     * @param LifecycleEventArgs $args
     */
    public function prePersist(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();
        if (! $entity instanceof User) {
            return;
        }

        $this->encodePassword($entity);
    }

    /**
     * Pre update
     *
     * @param LifecycleEventArgs $args
     */
    public function preUpdate(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();
        if (! $entity instanceof User) {
            return;
        }
        $this->encodePassword($entity);
        $entityManager = $args->getEntityManager();
        $meta = $entityManager->getClassMetadata(get_class($entity));
        $entityManager->getUnitOfWork()->recomputeSingleEntityChangeSet($meta, $entity);
    }

    /**
     * Encode password
     *
     * @param User $entity
     */
    public function encodePassword(User $entity)
    {
        $encoded = PasswordEncoder::encodePassword($entity->getPlainPassword());
        $entity->setPassword($encoded);
        $entity->eraseCredentials();
    }

    /**
     * Returns an array of events this subscriber wants to listen to.
     *
     * @return array|string[]
     */
    public function getSubscribedEvents()
    {
        return ['prePersist', 'preUpdate'];
    }
}
