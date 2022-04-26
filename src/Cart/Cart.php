<?php

namespace Recruitment\Cart;

use Recruitment\Entity\Order;
use Recruitment\Entity\Product;

class Cart
{
    private $items = [];

    public function findByProduct(Product $product): ?Item
    {
        foreach ($this->items as $item) {
            if ($item->getProduct() === $product) {
                return $item;
            }
        }

        return null;
    }

    public function addProduct(Product $product, int $quantity = 1): Cart
    {
        $item = $this->findByProduct($product);

        if ($item) {
            $item->setQuantity($item->getQuantity() + $quantity);
        } else {
            $this->items[] = new Item($product, $quantity);
        }

        return $this;
    }

    public function removeProduct(Product $product): Cart
    {
        foreach ($this->items as $key => $item) {
            if ($item->getProduct() === $product) {
                unset($this->items[$key]);
            }
        }

        $this->items = array_values($this->items);

        return $this;
    }

    public function setQuantity(Product $product, int $quantity): Cart
    {
        $item = $this->findByProduct($product);

        if ($item) {
            $item->setQuantity($quantity);
        } else {
            $this->items[] = new Item($product, $quantity);
        }

        return $this;
    }

    public function getItem(int $index): Item
    {
        if (!isset($this->items[$index])) {
            throw new \OutOfBoundsException();
        }

        return $this->items[$index];
    }

    public function getItems(): array
    {
        return $this->items;
    }

    public function getTotalPrice(): int
    {
        $totalPrice = 0;

        foreach ($this->items as $item) {
            $totalPrice += $item->getTotalPrice();
        }

        return $totalPrice;
    }

    public function checkout(int $id): Order
    {
        $order = new Order($id, $this->items);

        $this->items = [];

        return $order;
    }
}
