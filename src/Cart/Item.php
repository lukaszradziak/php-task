<?php

namespace Recruitment\Cart;

use Recruitment\Cart\Exception\QuantityTooLowException;
use Recruitment\Entity\Product;

class Item
{
    private $product;

    private $quantity;

    private $tax = 0;

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
        $this->tax = $tax;
    }

    public function getTotalPriceGross(): int
    {
        $total = $this->quantity * $this->product->getUnitPrice();

        return $total * (1 + $this->tax);
    }
}
