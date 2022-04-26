<?php

namespace Recruitment\Entity;

class Order
{
    private $id;

    private $items;

    public function __construct(int $id, array $items)
    {
        $this->id = $id;
        $this->items = $items;
    }

    public function getItemsData()
    {
        $items = [];

        foreach ($this->items as $item) {
            $items[] = [
                'id' => $item->getProduct()->getId(),
                'quantity' => $item->getQuantity(),
                'total_price' => $item->getTotalPrice(),
            ];
        }

        return $items;
    }

    private function getTotalPrice(): int
    {
        $totalPrice = 0;

        foreach ($this->items as $item) {
            $totalPrice += $item->getTotalPrice();
        }

        return $totalPrice;
    }

    public function getDataForView(): array
    {
        return [
            'id' => $this->id,
            'items' => $this->getItemsData(),
            'total_price' => $this->getTotalPrice()
        ];
    }
}
