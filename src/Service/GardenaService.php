<?php

namespace App\Service;

use App\Api\GardenaApi;
use Exception;

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
     * @var CacheService
     */
    private $cache;

    /**
     * @var string
     */
    private $locationId;

    /**
     * @var string
     */
    private $userId;

    /**
     * @var string
     */
    private $token;

    /**
     * @param GardenaApi   $api
     * @param string       $user
     * @param string       $pass
     * @param CacheService $cache
     */
    public function __construct(GardenaApi $api, string $user, string $pass, CacheService $cache)
    {
        $this->api = $api;
        $this->user = $user;
        $this->pass = $pass;
        $this->cache = $cache;

        try
        {
            $this->prepareAuth();
        } catch(Exception $exception)
        {
            die($exception->getMessage());
        }
    }

    /**
     * @throws Exception
     */
    private function prepareAuth()
    {
        $this->token = $this->cache->get(CacheKey::GARDENA_AUTH_TOKEN);
        $this->userId = $this->cache->get(CacheKey::GARDENA_AUTH_USER_ID);
        $this->locationId = $this->cache->get(CacheKey::GARDENA_LOCATION_ID);

        if (is_null($this->token) && is_null($this->userId))
        {
            $response =
                $this->api->post(
                    'sg-1/sessions',
                    [
                        'json' =>
                            [
                                'sessions' =>
                                    [
                                        'email'    => $this->user,
                                        'password' => $this->pass
                                    ]
                            ]
                    ]
                );

            $data = json_decode($response->getBody(), true);

            if (isset($data['sessions']['token']))
            {
                $this->token = $data['sessions']['token'];

                $this->cache->set(
                    CacheKey::GARDENA_AUTH_TOKEN,
                    $this->token
                );
            }
            else
            {
                throw new Exception('Session token not available');
            }

            if (isset($data['sessions']['user_id']))
            {
                $thiis->userId = $data['sessions']['user_id'];

                $this->cache->set(
                    CacheKey::GARDENA_AUTH_USER_ID,
                    $this->userId
                );
            }
            else
            {
                throw new Exception('User id not available');
            }
        }

        if (is_null($this->locationId))
        {
            $response =
                $this->api->get(
                    'sg-1/locations?user_id=' . $this->userId,
                    [
                        'headers' =>
                            [
                                'X-Session' => $this->token
                            ]
                    ]
                );

            $data = json_decode($response->getBody(), true);

            if (isset($data['locations'][0]['id']))
            {
                $this->locationId = $data['locations'][0]['id'];

                $this->cache->set(
                    CacheKey::GARDENA_LOCATION_ID,
                    $this->locationId
                );
            }
            else
            {
                throw new Exception('Location id not available');
            }
        }
    }

    /**
     * @return array
     */
    public function getDevicesData()
    {
        $response =
            $this->api->get(
                'sg-1/devices?locationId=' . $this->locationId,
                [
                    'headers' =>
                        [
                            'X-Session' => $this->token
                        ]
                ]
            );

        return json_decode($response->getBody(), true);
    }

    public function getDeviceData(array $devicesData, string $deviceName)
    {
        foreach ($devicesData as $deviceData){
        }
    }

    public function getSensorData(array $devicesData){

    }

    public function getWaterControlData(array $devicesData){

    }

}
