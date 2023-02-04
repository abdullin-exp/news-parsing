<?php

namespace App\Repositories\RBC;

use App\Services\RSS\RBC\DTO\Response as ResponseDTO;
use App\Services\RSS\RBC\DTO\Storage\Log as LogDTO;
use App\Services\RSS\RBC\Repository\ILog;
use App\Services\RSS\RBC\Repository\IRss;
use Illuminate\Support\Facades\Http;

class Rss implements IRss
{
    private string $url;

    public function __construct(string $url)
    {
        $this->url = $url;
    }

    public function request(ILog $log): ?ResponseDTO
    {
        if ($this->url == '') {
            return null;
        }

        $logDTO = new LogDTO();
        $logDTO->date = date('Y-m-d H:i:s');
        $logDTO->requestMethod = 'GET';
        $logDTO->requestUrl = $this->url;

        $begin = floor(microtime(true) * 1000);
        $response = Http::get($this->url);
        $requestTime = floor(microtime(true) * 1000) - $begin;

        $logDTO->requestTime = $requestTime;
        $logDTO->responseHttpCode = $response->status();
        $logDTO->responseBody = $response->body();

        $log->save($logDTO);

        $responseDTO = new ResponseDTO();
        $responseDTO->successful = $response->successful();
        $responseDTO->status = $response->status();
        $responseDTO->body = $response->body();

        return $responseDTO;
    }
}
