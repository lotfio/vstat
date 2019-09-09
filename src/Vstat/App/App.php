<?php

namespace Vstat\App;

/*
 * Vstat is an open source PHP Package That
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

use Vstat\Contracts\DataFilterInterface;
use Vstat\Contracts\DataParserInterface;
use Vstat\Contracts\DataTrimmerInterface;

class App
{
    /**
     * @var object dataParser
     */
    public $dataParser;

    /**
     * @var object dataTrimmer
     */
    public $dataTrimmer;

    /**
     * @var object dataFilter
     */
    public $dataFilter;

    /**
     * @var string vatsim data url
     */
    public $vatsimDataUrl;

    /**
     * @var data cache file
     */
    public $cacheFile;

    /**
     * @var cache time in seconds
     */
    public $cacheTime;

    public function __construct(DataTrimmerInterface $dataTrimmer, DataParserInterface $dataParser, DataFilterInterface $dataFilter)
    {
        $config = (object) require_once dirname(__DIR__).DIRECTORY_SEPARATOR.'config'.DIRECTORY_SEPARATOR.'app.php';

        // load config
        $this->vatsimDataUrl = $config->vatsimDataUrl;
        $this->cacheFile = $config->cacheFile;
        $this->cacheTime = $config->cacheTime;

        //inject dependencies
        $this->dataTrimmer = $dataTrimmer;
        $this->dataParser = $dataParser;
        $this->dataFilter = $dataFilter;
    }

    /**
     * @method cacheVatsimData
     *
     * check if vatsim data file doesn't exist or outdated
     * download it and cache it
     */
    public function cacheVatsimData() : void
    {
        if (!file_exists($this->cacheFile) or (filemtime($this->cacheFile) < (time() - 60 * $this->cacheTime))) {
            file_put_contents($this->cacheFile, preg_replace("/^\n+|^[\t\s]*\n+/m", ';', file_get_contents($this->vatsimDataUrl)),
            LOCK_EX);
        }
    }

    /**
     * @method  retrieve vatsim data
     * get vatsim data from cache file as an array
     */
    public function retrieveVatsimData() : array
    {
        $this->cacheVatsimData(); // cache data to local file if not exists
        return array_filter(file($this->cacheFile)); // get data as an array and remove empty elements if any
    }

    /**
     * @method array get all vatsim clients
     */
    public function getClients() : array
    {
        $data = $this->retrieveVatsimData();

        return array_values($this->dataTrimmer->trim($data, '!CLIENTS:', $this->dataParser, 'clientsParser'));
    }

    /**
     * @method array get all vatsim servers
     */
    public function getServers() : array
    {
        $data = $this->retrieveVatsimData();

        return  array_values($this->dataTrimmer->trim($data, '!SERVERS:', $this->dataParser, 'serversParser'));
    }

    /**
     * @method array get all vatsim prefile plans
     */
    public function getPreFile() : array
    {
        $data = $this->retrieveVatsimData();

        return  array_values($this->dataTrimmer->trim($data, '!PREFILE:', $this->dataParser, 'clientsParser'));
    }

    /**
     * @method array get all vatsim voice servers
     */
    public function getVoiceServers() : array
    {
        $data = $this->retrieveVatsimData();

        return  array_values($this->dataTrimmer->trim($data, '!VOICE SERVERS:', $this->dataParser, 'voiceServersParser'));
    }

    /**
     * @method array showByType vatsim clients
     */
    public function showByType($type = 'PILOT') : array
    {
        if ($type === 'PILOT') {
            return array_values(array_filter($this->getClients(), [$this->dataFilter, 'filterByPilot']));
        }

        return  array_values(array_filter($this->getClients(), [$this->dataFilter, 'filterByAtc']));
    }

    /**
     * @method array showBy Airline vatsim clients
     */
    public function showByAirline($icao = 'DLH') : array
    {
        $this->dataFilter->icao = $icao;

        return  array_values(array_filter($this->getClients(), [$this->dataFilter, 'filterByAirline']));
    }

    /**
     * @method array show by callsign vatsim clients
     */
    public function showByCallsign($callsign = null) : array
    {
        $this->dataFilter->callsign = $callsign;

        return array_values(array_filter($this->getClients(), [$this->dataFilter, 'filterbyCallSign']));
    }

    /**
     * @method array show by vatsim id
     */
    public function showByVatsimId($cid = null) : array
    {
        $this->dataFilter->cid = $cid;

        return array_values(array_filter($this->getClients(), [$this->dataFilter, 'filterbyId']));
    }

    /**
     * @method array get number of pilots
     */
    public function getNumberOfPilots() : int
    {
        return count($this->showByType());
    }

    /**
     * @method array get number of controllers
     */
    public function getNumberOfControllers() : int
    {
        return count($this->showByType('ATC'));
    }
}
