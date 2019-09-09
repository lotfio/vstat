<?php

namespace Vstat;

/*
 * Vstat is an open source PHP API That
 * helps you get live statistics About Vatsim
 * (Virtual Air Traffic Simulation Network)
 * This package is developed and maintained
 * by lotfio lakehal.
 *
 * @package     Vstat
 * @version     0.2.0
 * @author      Lotfio Lakehal <contact@lotfio.net>
 * @copyright   Lotfio Lakehal 2018
 * @license     MIT
 * @link        https://github.com/lotfio/vstat
 *
 */

use Vstat\App\App;
use Vstat\App\DataParser;
use Vstat\App\DataTrimmer;
use Vstat\App\DataFilter;

class Vstat
{
    /**
     * vstat app instance
     *
     * @var object
     */
    private static $app;

    /**
     * available methods
     *
     * @var array
     */
    private static $availMethods = array(
        "getClients",
        "getPreFile",
        "getServers",
        "getVoiceServers",
        "showByType",
        "showByAirline",
        "showByCallsign",
        "showByVatsimId",
        "getNumberOfPilots",
        "getNumberOfControllers"
    );

    /**
     * static proxy call for vstat methods
     *
     * @param  string $name
     * @param  array $arguments
     * @return array
     */
    public static function __callStatic($name, $arguments)
    {
        if(!in_array($name, self::$availMethods))
            throw new \Exception("Method $name not found", 4);

        if(!isset(self::$app))
        {
            $trimmer    = new DataTrimmer;
            $parser     = new DataParser;
            $filter     = new DataFilter;
            self::$app  = new App($trimmer, $parser, $filter);
        }

        return   self::$app->{$name}(...$arguments);
    }
}