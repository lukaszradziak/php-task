<?php

namespace Recruitment\Entity;

use InvalidArgumentException;
use Recruitment\Entity\Exception\InvalidUnitPriceException;

class Product
{
    private $id;

    private $unitPrice;

    private $minimumQuantity;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getUnitPrice(): int
    {
        return $this->unitPrice;
    }

    public function setUnitPrice(int $unitPrice): void
    {
        if ($unitPrice <= 0) {
            throw new InvalidUnitPriceException();
        }

        $this->unitPrice = $unitPrice;
    }

    public function getMinimumQuantity(): int
    {
        return $this->minimumQuantity;
    }

    public function setMinimumQuantity($minimumQuantity): void
    {
        if ($minimumQuantity <= 0) {
            throw new InvalidArgumentException();
        }

        $this->minimumQuantity = $minimumQuantity;
    }
}
