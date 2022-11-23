<?php
namespace Skillup\FlyOrder\Model\Api;

use \Skillup\FlyOrder\Api\WeatherInterface;
use \Skillup\FlyOrder\Model\Api\Weather;

class AerisWeather extends Weather implements WeatherInterface
{
    const WIDGET_ICON_URL = '';
    const API_URL = '';
    const API_ID = 'XDs2GI89S0eVaQWN8i9D3';
    const API_SECRET = '7vD1IfenHEJTLmeLzENyJsM6NcZZrnVF1aSx230G';

    /**
     * Get Weather widget data
     * @param string $city
     * @return string
     */
    public function getWeather(string $city): string
    {
        return '';
    }
}
