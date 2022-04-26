<?php

namespace Recruitment\Cart;

use InvalidArgumentException;
use Recruitment\Cart\Exception\QuantityTooLowException;
use Recruitment\Entity\Product;

class Item
{
    private $product;

    private $quantity;

    private $tax = 0;

    public const TAXES = [0, 0.05, 0.08, 0.23];

    public function __construct(Product $product, int $quantity)
    {
        if ($product->getMinimumQuantity() > $quantity) {
            throw new \InvalidArgumentException();
        }

        $this->product = $product;
        $this->quantity = $quantity;
    }

    public function getProduct(): Product
    {
        return $this->product;
    }

    public function getTotalPrice(): int
    {
        return $this->quantity * $this->product->getUnitPrice();
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): void
    {
        if ($this->product->getMinimumQuantity() > $quantity) {
            throw new QuantityTooLowException();
        }

        $this->quantity = $quantity;
    }

    public function getTax(): float
    {
        return $this->tax;
    }

    public function setTax(float $tax): void
    {
        if (in_array($tax, self::TAXES) === false) {
            throw new InvalidArgumentException();
        }

        $this->tax = $tax;
    }

    public function getTotalPriceGross(): int
    {
        $total = $this->quantity * $this->product->getUnitPrice();

        return $total * (1 + $this->tax);
    }
}
