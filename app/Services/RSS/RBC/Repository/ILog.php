<?php

namespace App\Services\RSS\RBC\Repository;

use App\Services\RSS\RBC\DTO\Storage\Log as LogDTO;

interface ILog
{
    public function save(LogDTO $logDTO): bool;
}
