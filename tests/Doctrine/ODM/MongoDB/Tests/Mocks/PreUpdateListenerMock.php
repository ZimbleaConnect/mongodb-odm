<?php

declare(strict_types=1);

namespace Doctrine\ODM\MongoDB\Tests\Mocks;

use Doctrine\Common\EventSubscriber;
use Doctrine\ODM\MongoDB\Event\OnFlushEventArgs;
use Doctrine\ODM\MongoDB\Event\PreUpdateEventArgs;

use Doctrine\ODM\MongoDB\UnitOfWork;

class PreUpdateListenerMock implements EventSubscriber
{
    public function getSubscribedEvents(): array
    {
        return [
            'onFlush',
            'preUpdate',
        ];
    }

    public function onFlush(OnFlushEventArgs $args): void
    {
        $uow = $args->getDocumentManager()->getUnitOfWork();
        foreach ($uow->getScheduledDocumentUpdates() as $document) {
            $uow->clearDocumentChangeSet(UnitOfWork::getUniqueId(($document)));
        }
    }

    public function preUpdate(PreUpdateEventArgs $args): void
    {
        return;
    }
}
