<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use Vstat\DataParser;

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
class DataParserTest extends TestCase
{
    public $clientsData = [
        'AAL2135', '1315456', 'Neal Shamsudeen YMML', 'PILOT',
        '00', '42.36083', '-71.01946', '34', '0', 'A320', '410', 'KBOS', '22000',
        'KLGA', 'AUSTRALIA', '100', '1', '2000', '7', '7', '2', 'I', '1300', '1300',
        '0', '45', '2', '4', 'KBOS', '+VFPS+/V/PLANNED OPTIMUM FLIGHT LEVEL',
        'PATSS DCT NELIE DCT VALRE', '0', '0', '0', '0', '0', '0', '20181211103150',
        '92', '30.189', '221', ];

    public $serversData = ['123.55.1.3', 'T', '4', 'A8', ''];

    /**
     * setting up our test object.
     */
    public function setUp() : void
    {
        $this->parser = new DataParser();
    }

    /**
     * test clients parser method is returning
     * a valid array of data with 41 element.
     */
    public function testClientsParserIsReturningAvalidArray()
    {
        $this->assertIsArray($this->parser->clientsParser($this->clientsData));
        $this->assertCount(41, $this->parser->clientsParser($this->clientsData));
    }

    /**
     * test Servers parser method is returning
     * a valid array of data with 5 element.
     */
    public function testServersParserIsReturningAvalidArray()
    {
        $this->assertIsArray($this->parser->serversParser($this->serversData));
        $this->assertCount(5, $this->parser->serversParser($this->serversData));
    }

    /**
     * test voiceServers parser method is returning
     * a valid array of data with 5 element.
     */
    public function testVoiceServersParserIsReturningAvalidArray()
    {
        $this->assertIsArray($this->parser->voiceServersParser($this->serversData));
        $this->assertCount(5, $this->parser->voiceServersParser($this->serversData));
    }
}
