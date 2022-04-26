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

    public function getDataForView(): array
    {
        return [
            'id' => $this->id,
            'items' => $this->items
        ];
    }
}
