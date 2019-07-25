<?php

namespace App\Service;

use App\Api\HueApi;

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
     * HueService constructor.
     *
     * @param HueApi $api
     */
    public function __construct(HueApi $api)
    {
        $this->api = $api;
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
     */
    private function getTemperature($sensorId)
    {
        $response =
            $this->api->get(
                'api/vxtUxmA98q524CYXRkOa0WuR3vMLvfdL8yQT97xi/sensors/' .
                $sensorId
            );

        $data = json_decode($response->getBody(), true);

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
