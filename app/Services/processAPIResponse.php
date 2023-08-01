<?php

namespace App\Services;
use GuzzleHttp\Client;

class processAPIResponse {
    public array $processedResponse;


    public function getFrom3rdPartyAPI($url)
    {
        $client = new Client();
        try {
            $response = $client->get($url);

            return $response->getBody()->getContents();
        } catch (\Exception $e) {
            // Handle any exceptions if necessary
            dd($e->getMessage());
        }
    }

    public function transformResponse($response): array
    {
        $response = json_decode($response, true);
        $this->invertKey($response);
        $this->getTotalCount();
        return $this->processedResponse;
    }


    public function getTotalCount() : void
    {
        $this->processedResponse = array('objectCount' => count($this->processedResponse)) + $this->processedResponse;
    }
    public function invertKey($decodedJson) : void
    {
        foreach ($decodedJson as $key => $value) {
            $stringPartsKey = str_split($key);
            sort($stringPartsKey);
            $this->processedResponse[implode($stringPartsKey)] = $this->checkDataTypeofValue(implode($stringPartsKey), $value);
        }
    }

    public function checkDataTypeofValue($invertedKey, $value)
    {
        $convertedValue = $value;
        if(is_string($value))
        {
            $stringPartsValue = str_split($value);
            sort($stringPartsValue);
            $convertedValue = implode($stringPartsValue);
        }
        if(is_integer($value))
        {
            $convertedValue = $value;
        }

        if(is_array($value))
        {
//            $this->invertKey(json_encode($value));
//            $this->processedResponse[$invertedKey]
//            $this->invertKey($value);
        }
        return $convertedValue;
    }
}