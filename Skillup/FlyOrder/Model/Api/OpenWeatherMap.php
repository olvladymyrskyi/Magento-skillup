<?php
namespace Skillup\FlyOrder\Model\Api;

use \Skillup\FlyOrder\Api\WeatherInterface;
use \Skillup\FlyOrder\Model\Api\Weather;

class OpenWeatherMap extends Weather implements WeatherInterface
{
    const WIDGET_ICON_URL = '//openweathermap.org/themes/openweathermap/assets/vendor/owm/img/widgets/';
    const API_URL = 'http://api.openweathermap.org/data/2.5/weather?q=';
    const API_KEY = '81495dbb50ff24bb2be39de7f757f19f';

    /**
     * Get Weather widget data
     * @param string $city
     * @return string
     */
    public function getWeather(string $city): string
    {
        $url =  self::API_URL . $city . '&units=metric' . '&appid=' . self::API_KEY;

        $this->_curl->get($url);
        $data = $this->serializer->unserialize($this->_curl->getBody());

        if(array_key_exists('cod', $data) && $data['cod'] == 404){
            return $this->_curl->getBody();
        }else{
            return $this->compose($data);
        }
    }

    /**
     * Compose result to one format for weather widget
     * @param $data
     * @return string
     */
    protected function compose($data): string
    {
        $imgUrl =  self::WIDGET_ICON_URL . $data['weather'][0]['icon'] . '.png';
        $result = [
            'city' => $data['name'],
            'country' => $data['sys']['country'],
            'icon' => $imgUrl,
            'temp' => (int)$data['main']['temp'],
            'title' => $data['weather'][0]['main'],
            'description' => $data['weather'][0]['description'],
            'windSpeed' => $data['wind']['speed'] . " m/h",
            'windBeaufort' => $this->getByBeaufortScale($data['wind']['speed'])
        ];

        return $this->serializer->serialize($result);
    }
}
