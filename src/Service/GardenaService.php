<?php

namespace App\Service;

use App\Api\GardenaApi;

/**
 *
 */
class GardenaService
{
    /**
     * @var GardenaApi
     */
    private $api;
    /**
     * @var string
     */
    private $user;
    /**
     * @var string
     */
    private $pass;

    /**
     * @param GardenaApi $api
     * @param string     $user
     * @param string     $pass
     */
    public function __construct(GardenaApi $api, string $user, string $pass)
    {
        $this->api = $api;
        $this->user = $user;
        $this->pass = $pass;
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
}
