<?php

namespace App\Services\RSS\RBC\DTO;

class NewsItem
{
    public string $name;
    public string $shortDescription;
    public string $publicDate;
    public ?string $author = null;
    public ?string $image = null;
}
