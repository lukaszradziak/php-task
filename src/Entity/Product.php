<?php

namespace Recruitment\Entity;

use InvalidArgumentException;
use Recruitment\Entity\Exception\InvalidUnitPriceException;

class Product
{
    private $id;

    private $unitPrice;

    private $minimumQuantity = 1;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): Product
    {
        $this->id = $id;

        return $this;
    }

    public function getUnitPrice(): int
    {
        return $this->unitPrice;
    }

    public function setUnitPrice(int $unitPrice): Product
    {
        if ($unitPrice <= 0) {
            throw new InvalidUnitPriceException();
        }

        $this->unitPrice = $unitPrice;

        return $this;
    }

    public function getMinimumQuantity(): int
    {
        return $this->minimumQuantity;
    }

    public function setMinimumQuantity(int $minimumQuantity): Product
    {
        if ($minimumQuantity <= 0) {
            throw new InvalidArgumentException();
        }

        $this->minimumQuantity = $minimumQuantity;

        return $this;
    }
}
