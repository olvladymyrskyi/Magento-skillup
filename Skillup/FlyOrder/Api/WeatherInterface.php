<?php
namespace Skillup\FlyOrder\Api;

/**
 * @api
 */
interface WeatherInterface
{
    /**
     * @param string $city
     * @return string
     */
    public function getWeather( string $city) :string;
}
