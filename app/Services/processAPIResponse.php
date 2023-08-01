<?php

namespace App\Services;
use GuzzleHttp\Client;

class processAPIResponse {
    public array $processedResponse;

    public function transformResponse($response): array
    {
        $this->invertKey($response);
        return $this->processedResponse;
    }
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

    public function invertKey($jsonBody)
    {
        $decodedJson = json_decode($jsonBody, true);
        foreach ($decodedJson as $key => $value) {
            $stringPartsKey = str_split($key);
            sort($stringPartsKey);

            $this->processedResponse[implode($stringPartsKey)] = $this->checkDataTypeofValue($value);;
        }
        // If the input is not a valid JSON object, return the original input
        return $jsonBody;
    }

    public function checkDataTypeofValue($value)
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
//            $decodedJson = $value;
//            foreach ($decodedJson as $key => $value) {
//                echo $key . " => " . $value . "\n";
//            }
//            // If the input is not a valid JSON object, return the original input
//            dd($jsonBody);
        }

        return $convertedValue;
    }
}