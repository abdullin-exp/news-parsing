<?php

namespace App\Repositories\RBC;

use App\Models\RBCLog as RBCLogModel;
use App\Services\RSS\RBC\DTO\Storage\Log as LogDTO;
use App\Services\RSS\RBC\Repository\ILog;

class Log implements ILog
{
    public function save(LogDTO $logDTO): bool
    {
        $status = RBCLogModel::create([
            'date' => $logDTO->date,
            'request_method' => $logDTO->requestMethod,
            'request_url' => $logDTO->requestUrl,
            'response_http_code' => $logDTO->responseHttpCode,
            'response_body' => $logDTO->responseBody,
            'request_time' => $logDTO->requestTime,
        ]);

        if (!$status) {
            return false;
        }

        return true;
    }
}
