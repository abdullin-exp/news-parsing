<?php

namespace App\Services\RSS\RBC\DTO\Storage;

class ListConditions
{
    public int $page = 1;
    public int $limit = 20;
    public ?string $sort = null;
    public array $fields = [];
}
