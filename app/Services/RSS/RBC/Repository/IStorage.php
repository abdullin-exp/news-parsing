<?php

namespace App\Services\RSS\RBC\Repository;

use App\Services\RSS\RBC\DTO\NewsCollection as NewsCollectionDTO;
use App\Services\RSS\RBC\DTO\Storage\ListConditions as ListConditionsDTO;

interface IStorage
{
    public function save(NewsCollectionDTO $newsCollectionDTO): bool;
    public function get(ListConditionsDTO $listConditionsDTO): array;
}
