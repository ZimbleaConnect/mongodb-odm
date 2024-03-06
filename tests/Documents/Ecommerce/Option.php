<?php

declare(strict_types=1);

namespace Documents\Ecommerce;

use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;
use InvalidArgumentException;

#[ODM\EmbeddedDocument]
class Option
{
    /** @var string|null */
    #[ODM\Id]
    protected $id;

    /** @var string */
    #[ODM\Field(type: 'string')]
    protected $name;

    /** @var Money */
    #[ODM\EmbedOne(targetDocument: Money::class)]
    protected $money;

    /** @var StockItem */
    #[ODM\ReferenceOne(targetDocument: StockItem::class, cascade: 'all')]
    protected $stockItem;

    public function __construct(string $name, Money $money, StockItem $stockItem)
    {
        $this->name = $name;
        if (empty($this->name)) {
            throw new InvalidArgumentException('option name cannot be empty');
        }

        $this->money     = $money;
        $this->stockItem = $stockItem;
    }

    public function getName(): string
    {
        return $this->name;
    }

    /** @return float|Money */
    public function getPrice(?bool $object = false)
    {
        if ($object === true) {
            return $this->money;
        }

        return $this->money->getAmount();
    }

    public function getStockItem(): StockItem
    {
        return $this->stockItem;
    }
}
