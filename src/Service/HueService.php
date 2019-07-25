<?php

namespace App\Service;

use App\Api\HueApi;
use Exception;

/**
 *
 */
class HueService
{
    /**
     * @var HueApi
     */
    private $api;

    /**
     * @var string
     */
    private $userId;

    /**
     * @param HueApi $api
     * @param string $userId
     */
    public function __construct(HueApi $api, string $userId)
    {
        $this->api = $api;
        $this->userId = $userId;
    }

    /**
     * @return int
     */
    public function getTemperatureOf1stFloor()
    {
        return $this->getTemperature(10);
    }

    /**
     * @param $sensorId
     *
     * @return int
     * @throws Exception
     */
    private function getTemperature($sensorId)
    {
        $response =
            $this->api->get(
                'api/' . $this->userId . '/sensors/' .
                $sensorId
            );

        $data = json_decode($response->getBody(), true);

        if (!isset($data['state']['temperature']))
        {
            throw new Exception('Temperature data not available');
        }

        return intval($data['state']['temperature']);
    }

    /**
     * @return int
     */
    public function getTemperatureOf2ndFloor()
    {
        return $this->getTemperature(14);
    }
}
