<?php

declare(strict_types=1);

namespace Documents;

use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;

#[ODM\EmbeddedDocument]
class IndirectlyReferencedUser
{
    /** @var User */
    #[ODM\ReferenceOne(targetDocument: User::class, storeAs: 'ref')]
    public $user;
}
