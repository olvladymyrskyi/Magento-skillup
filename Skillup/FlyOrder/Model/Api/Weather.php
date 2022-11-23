<?php
namespace Skillup\FlyOrder\Model\Api;

use \Skillup\FlyOrder\Api\WeatherInterface;
use \Magento\Framework\HTTP\Client\Curl;
use \Magento\Framework\Serialize\Serializer\Json;

class Weather implements WeatherInterface
{
    /**
     * @var Curl
     */
    protected Curl $_curl;

    /**
     * @var \Magento\Framework\Serialize\Serializer\Json|mixed
     */
    protected $serializer;

    /**
     * @param Curl $curl
     * @param Json|null $serializer
     */
    public function __construct(Curl $curl, Json $serializer = null)
    {
        $this->_curl = $curl;
        $this->serializer = $serializer ?: \Magento\Framework\App\ObjectManager::getInstance()
            ->get(\Magento\Framework\Serialize\Serializer\Json::class);
    }

    /**
     * Get Weather widget data
     * @param string $city
     * @return string
     */
    public function getWeather(string $city): string
    {
        return '';
    }

    /**
     * Get name of wind by Beautort Scale
     * @param $windSpeed
     * @return string
     */
    protected function getByBeaufortScale($windSpeed): string
    {
        $title = '';
        $value = (int)($windSpeed * 3.6);
        switch ($value) {
            case ($value < 2):
                $title = __("Calm");
                break;
            case in_array($value, range(2, 6)):
                $title = __("Light air");
                break;
            case in_array($value, range(7, 11)):
                $title = __("Light breeze");
                break;
            case in_array($value, range(12, 19)):
                $title = __("Gentle breeze");
                break;
            case in_array($value, range(20, 30)):
                $title = __("Moderate breeze");
                break;
            case in_array($value, range(31, 39)):
                $title = __("Fresh breeze");
                break;
            case in_array($value, range(40, 50)):
                $title = __("Strong breeze");
                break;
            case in_array($value, range(51, 61)):
                $title = __("Moderate gale");
                break;
            case in_array($value, range(62, 74)):
                $title = __("Fresh gale");
                break;
            case in_array($value, range(75, 87)):
                $title = __("Strong gale");
                break;
            case in_array($value, range(88, 102)):
                $title = __("Whole gale");
                break;
            case in_array($value, range(103, 118)):
                $title = __("Storm");
                break;
            case ($value > 118):
                $title = __("Hurricane");
                break;
        }

        return $title;
    }

}
