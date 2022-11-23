<?php
namespace Skillup\FlyOrder\Model\Api;

use \Skillup\FlyOrder\Api\WeatherInterface;
use \Skillup\FlyOrder\Model\Api\Weather;

class AccuWeather extends Weather implements WeatherInterface
{
    const WIDGET_ICON_URL = 'https://developer.accuweather.com/sites/default/files/';
    const API_URL = 'http://api.openweathermap.org/data/2.5/weather?q=';
    const API_KEY = 'bORbN0GpejMwqyAjo3VAhMQwfWHyyXIC';

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
