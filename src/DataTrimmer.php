<?php

namespace Vstat;

use Vstat\Contracts\DataParserInterface;
use Vstat\Contracts\DataTrimmerInterface;

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
class DataTrimmer implements DataTrimmerInterface
{
    /**
     * @method  trim method
     *
     * @param $data       vatsim data array
     * @param $startLine  start trimming line
     * @param $dataParser data parser object
     * @param $method     data parser method
     */
    public function trim(array $data, string $startLine, DataParserInterface $dataParser, string $method): array
    {
        $allowed = false;
        $records = [];

        foreach ($data as $line) {
            if (substr($line, 0, 1) != ';') { // not a comment

                $line = iconv('ISO-8859-1', 'UTF-8', trim($line));

                if ($allowed == true && substr($line, 0, 1) != '!') {
                    $records[] = (object) call_user_func_array([$dataParser, $method], [explode(':', $line)]);
                } else {
                    $allowed = false;
                    if ($line == $startLine) {
                        $allowed = true;
                    } // $startLine = "!SERVER:"
                }
            }
        }

        return $records;
    }
}
