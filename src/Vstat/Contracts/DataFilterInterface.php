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
interface DataFilterInterface
{
    /**
     * @method  filer by pilot method
     *
     * @param   $data object of data to be filterd
     */
    public function filterByPilot(object $data) : bool;

    /**
     * @method  filer by atc method
     *
     * @param   $data object of data to be filterd
     */
    public function filterByAtc(object $data) : bool;

    /**
     * @method  filer by airline method
     *
     * @param   $data object of data to be filterd
     */
    public function filterByAirline(object $data) : bool;

    /**
     * @method  filer by vatsim id method
     *
     * @param   $data object of data to be filterd
     */
    public function filterById(object $data) : bool;

    /**
     * @method  filer by callsign method
     *
     * @param   $data object of data to be filterd
     */
    public function filterbyCallSign(object $data) : bool;
}
