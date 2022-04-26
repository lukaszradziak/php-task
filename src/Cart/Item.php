<?php

namespace Recruitment\Cart;

use Recruitment\Cart\Exception\QuantityTooLowException;
use Recruitment\Entity\Product;

class Item
{
    private $product;

    private $quantity;

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
}
