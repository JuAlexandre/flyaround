<?php
/**
 * Created by PhpStorm.
 * User: wilder12
 * Date: 14/05/18
 * Time: 21:13
 */

namespace AppBundle\Service;


class FlightInfo
{
    /**
     * @var string
     */
    private $unit;

    /**
     * FlightInfo constructor.
     * @param string $unit Defined in config.yml
     */
    public function __construct($unit)
    {
        $this->unit = $unit;
    }

    /**
     * Distance calculation between latitude/longitude based on Harnive's formula
     * http://www.codecodex.com/wiki/Calculate_Distance_Between_Two_Points_on_a_Globe#PHP
     *
     * @param float $latitudeFrom  Departure
     * @param float $longitudeFrom Departure
     * @param float $latitudeTo    Arrival
     * @param float $longitudeTo   Arrival
     *
     * @return float
     */
    public function getDistance($latitudeFrom, $longitudeFrom, $latitudeTo, $longitudeTo)
    {
        $distance = 0;
        $earth_radius = 6371;
        $dLat = deg2rad($latitudeTo - $latitudeFrom);
        $dLon = deg2rad($longitudeTo - $longitudeFrom);

        $a = sin($dLat/2) * sin($dLat/2) + cos(deg2rad($latitudeFrom)) * cos(deg2rad($latitudeTo)) * sin($dLon/2) * sin($dLon/2);
        $c = 2 * asin(sqrt($a));

        switch ($this->unit) {
            case 'km':
                $distance = $c * $earth_radius;
                break;
            case 'mi':
                $distance = $c * $earth_radius / 1.609344;
                break;
            case 'nmi':
                $distance = $c * $earth_radius / 1.852;
                break;
        }

        return $distance;
    }

    /**
     * Calculation of travel time as a function of the distance and cruising speed
     * t = D / V
     *
     * @param float $distance
     * @param float $cruiseSpeed
     *
     * @return float
     */
    public function getTime($distance, $cruiseSpeed)
    {
        $travelTime = 0;

        switch ($this->unit) {
            case 'km':
                $travelTime = $distance / $cruiseSpeed;
                break;
            case 'mi':
                $travelTime = ($distance * 1.609) / $cruiseSpeed;
                break;
            case 'nmi':
                $travelTime = ($distance * 1.852) / $cruiseSpeed;
                break;
        }

        return $travelTime;
    }
}