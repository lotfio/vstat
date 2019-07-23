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
interface DataTrimmerInterface
{
    /**
     * @method   trim vatsim data using data parser
     *
     * @param $data       array of vatsim data taken from vatsim-data.txt as an array using file() method
     * @param $startLine  line from where start trimming
     * @param $dataParser data parser Object
     * @param $method     string parsing method
     */
    public function trim(array $data, string $startLine, DataParserInterface $dataParser, string $method) : array;
}
