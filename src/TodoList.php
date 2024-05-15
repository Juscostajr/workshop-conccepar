<?php
namespace Jusce\WorkshopConccepar;

use JsonSerializable;

class TodoList implements JsonSerializable
{
    private array $todoList;

    public function add(TodoItem $item): void
    {
        $this->todoList[] = $item;
    }

    public function get(int $index): TodoItem
    {
        return $this->todoList[$index];
    }

    public function find($callable): array
    {
        return array_filter($this->todoList,$callable);
    }

    public function jsonSerialize(): mixed
    {
        return $this->todoList;
    }
}