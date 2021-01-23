<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use Vstat\App\DataParser;
use Vstat\App\DataTrimmer;

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
class DataTrimmerTest extends TestCase
{
    protected function setUp() : void
    {
        $this->dataTrimmer = new DataTrimmer();
        $this->parser = new DataParser();
    }

    public function testTrimMethod()
    {
        $data = file(__DIR__.'/Stabs/vatsim-data.txt');
        $from = '!CLIENTS:';
        $res = $this->dataTrimmer->trim($data, $from, $this->parser, 'clientsParser');
        $this->assertIsArray($res);
        $this->assertIsObject($res[0]);
    }
}
