<?php

namespace Vstat\Contracts;

/**
 * Vstat is an open source PHP API That
 * helps you get live statistics About Vatsim
 * (Virtual Air Traffic Simulation Network)
 * This package is developed and maintained
 * by lotfio lakehal.
 *
 * @version     0.1.0
 *
 * @author      Lotfio Lakehal <contact@lotfio.net>
 * @copyright   Lotfio Lakehal 2018
 * @license     MIT
 *
 * @link        https://github.com/lotfio/vstat
 */
interface DataParserInterface
{
    /**
     * @method  clients parser method
     *
     * @param $data array of data comming from
     *               trimmer to be parsed and combined with available keys
     */
    public function clientsParser(array $array) : array;

    /**
     * @method  servers parser method
     *
     * @param $data array of data comming from
     *               trimmer to be parsed and combined with available keys
     */
    public function serversParser(array $array) : array;

    /**
     * @method  voice servers parser method
     *
     * @param $data array of data comming from
     *               trimmer to be parsed and combined with available keys
     */
    public function voiceServersParser(array $array) : array;
}
