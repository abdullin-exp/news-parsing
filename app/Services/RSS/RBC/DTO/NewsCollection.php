<?php

namespace App\Services\RSS\RBC\DTO;

class NewsCollection implements \Iterator, \Countable
{
    private int $position = 0;
    private array $items = [];

    public function add(NewsItem $item)
    {
        $this->items[] = $item;
    }

    public function current(): NewsItem
    {
        return $this->items[$this->position];
    }

    public function next(): void
    {
        $this->position++;
    }

    public function key(): int
    {
        return $this->position;
    }

    public function valid(): bool
    {
        return isset($this->items[$this->position]);
    }

    public function rewind(): void
    {
        $this->position = 0;
    }

    public function count(): int
    {
        return count($this->items);
    }

    public function toArray(): array
    {
        return $this->items;
    }
}
