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

    public function getItemsData(): array
    {
        $itemsData = [];

        foreach ($this->items as $item) {
            $itemsData[] = [
                'id' => $item->getProduct()->getId(),
                'quantity' => $item->getQuantity(),
                'total_price' => $item->getTotalPrice(),
                'tax' => $item->getTax(),
            ];
        }

        return $itemsData;
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
