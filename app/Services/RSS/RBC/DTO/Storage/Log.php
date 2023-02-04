<?php

namespace App\Services\RSS\RBC\DTO\Storage;

class Log
{
    public string $date;
    public string $requestMethod;
    public string $requestUrl;
    public int $responseHttpCode;
    public string $responseBody;
    public int $requestTime;
}
