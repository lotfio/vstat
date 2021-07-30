<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use Vstat\DataFilter;

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
class DataFilterTest extends TestCase
{
    /**
     * setting up our test object.
     */
    public function setUp(): void
    {
        $this->dataFilter = new DataFilter();
    }

    /**
     * test filter by pilot method that is returning
     * data by PILOT type.
     */
    public function testFilterByPilot()
    {
        $data = (object) [
            'clienttype' => 'PILOT',
        ];

        $this->assertTrue($this->dataFilter->filterByPilot($data));

        $data->clienttype = 'ATC';
        $this->assertFalse($this->dataFilter->filterByPilot($data));
    }

    /**
     * test filter by atc method that is returning
     * data by ATC type.
     */
    public function testFilterByAtc()
    {
        $data = (object) [
            'clienttype' => 'ATC',
        ];

        $this->assertTrue($this->dataFilter->filterByAtc($data));

        $data->clienttype = 'PILOT';
        $this->assertFalse($this->dataFilter->filterByAtc($data));
    }

    /**
     * test filter by airline method that is returning
     * data by callsign.
     */
    public function testFilterByAirline()
    {
        $data = (object) [
            'callsign' => 'BAW2566',
        ];

        $this->dataFilter->icao = 'BAW';
        $this->assertTrue($this->dataFilter->filterByAirline($data));

        $this->dataFilter->icao = 'DAH';
        $this->assertFalse($this->dataFilter->filterByAirline($data));
    }

    /**
     * test filter by id method that is returning
     * data by client id.
     */
    public function testFilterById()
    {
        $data = (object) [
            'cid' => '1319182',
        ];

        $this->dataFilter->cid = '1319182';
        $this->assertTrue($this->dataFilter->filterById($data));

        $this->dataFilter->cid = '141516';
        $this->assertFalse($this->dataFilter->filterById($data));
    }

    /**
     * test filter by callsign method that is returning
     * data by callsign.
     */
    public function testFilterbyCallSign()
    {
        $data = (object) [
            'callsign' => 'LA_OBS',
        ];

        $this->dataFilter->callsign = 'LA_OBS';
        $this->assertTrue($this->dataFilter->filterByCallsign($data));

        $this->dataFilter->callsign = 'ATC';
        $this->assertFalse($this->dataFilter->filterByCallsign($data));
    }
}
