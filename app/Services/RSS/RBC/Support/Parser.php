<?php

namespace App\Services\RSS\RBC\Support;

class Parser
{
    public function convertToArray(string $xml): array
    {
        $xmlObject = simplexml_load_string($xml);
        return json_decode(json_encode($xmlObject), true);
    }
}
