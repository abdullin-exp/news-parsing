<?php

namespace App\Services\RSS\RBC\Repository;

use App\Services\RSS\RBC\DTO\Response as ResponseDTO;

interface IRss
{
    public function request(ILog $log): ?ResponseDTO;
}
