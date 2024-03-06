<?php

declare(strict_types=1);

namespace Doctrine\ODM\MongoDB\Tests\Functional\Ticket;

use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;
use Doctrine\ODM\MongoDB\Tests\BaseTestCase;

class MODM72Test extends BaseTestCase
{
    public function testTest(): void
    {
        $class = $this->dm->getClassMetadata(MODM72User::class);
        self::assertEquals(['test' => 'test'], $class->fieldMappings['name']['options']);
    }
}

#[ODM\Document]
class MODM72User
{
    /** @var string|null */
    #[ODM\Id]
    public $id;

    /** @var string|null */
    #[ODM\Field(type: 'string', options: ['test' => 'test'])]
    public $name;
}
