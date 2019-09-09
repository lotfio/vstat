<?php

namespace Vstat\App;

use Vstat\Contracts\DataFilterInterface;

/**
 * Vstat is an open source PHP Package That
 * helps you get live statistics About Vatsim
 * (Virtual Air Traffic Simulation Network)
 * This package is developed and maintained
 * by lotfio lakehal.
 *
 * @version     0.2.0
 *
 * @author      Lotfio Lakehal <contact@lotfio.net>
 * @copyright   Lotfio Lakehal 2018
 * @license     MIT
 *
 * @link        https://github.com/lotfio/vstat
 */
class DataFilter implements DataFilterInterface
{
    /**
     * @var int vatsim id
     */
    public $cid;

    /**
     * @var int icao code
     */
    public $icao;

    /**
     * @var string callsign
     */
    public $callsign;

    /**
     * @method filter by pilot method
     *
     * @param  $data object
     *
     * @return bool
     */
    public function filterByPilot(object $data) : bool
    {
        return $data->clienttype == 'PILOT';
    }

    /**
     * @method filter by atc method
     *
     * @param  $data object
     *
     * @return bool
     */
    public function filterByAtc(object $data) : bool
    {
        return $data->clienttype == 'ATC';
    }

    /**
     * @method filter by airline method
     *
     * @param  $data object
     *
     * @return bool
     */
    public function filterByAirline(object $data) : bool
    {
        return !preg_match("/^$this->icao/", $data->callsign) === false;
    }

    /**
     * @method filter by vatsim id
     *
     * @param  $data object
     *
     * @return bool
     */
    public function filterById(object $data) : bool
    {
        return !preg_match("/^$this->cid/", $data->cid) === false;
    }

    /**
     * @method filter by callsign method
     *
     * @param  $data object
     *
     * @return bool
     */
    public function filterbyCallSign(object $data) : bool
    {
        return !preg_match("/^$this->callsign/", $data->callsign) === false;
    }
}
