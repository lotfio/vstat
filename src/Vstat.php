<?php

namespace Vstat;

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

class Vstat
{
    /**
     * @var DataTrimmer dataTrimmer
     */
    public DataTrimmer $dataTrimmer;

    /**
     * @var DataParser data
     */
    public DataParser $dataParser;

    /**
     * @var DataFilter dataFilter
     */
    public DataFilter $dataFilter;

    /**
     * @var string vatsim data url
     */
    public string $vatsimDataUrl = 'http://data.vatsim.net/vatsim-data.txt';

    /**
     * @var string cache file
     */
    public string $cacheFile = __DIR__ . '/cache/vatsim-data.txt';

    /**
     * @var int time in seconds
     */
    public int $cacheTime = 5;

    /**
     * setup
     */
    public function __construct()
    {
        //setup dependencies
        $this->dataTrimmer = new DataTrimmer;
        $this->dataParser  = new DataParser;
        $this->dataFilter  = new DataFilter;
    }

    /**
     * check if vatsim data file doesn't exist or outdated
     * download it and cache it
     *
     * @return void
     */
    public function cacheVatsimData(): void
    {
        if (!file_exists($this->cacheFile) or (filemtime($this->cacheFile) < (time() - 60 * $this->cacheTime))) {
            file_put_contents($this->cacheFile, preg_replace("/^\n+|^[\t\s]*\n+/m", ';', file_get_contents($this->vatsimDataUrl)),
            LOCK_EX);
        }
    }

    /**
     * retreieve vatsim data after caching
     *
     * @return array
     */
    public function retrieveVatsimData(): array
    {
        $this->cacheVatsimData(); // cache data to local file if not exists
        return array_filter(file($this->cacheFile)); // get data as an array and remove empty elements if any
    }

    /**
     * get all vatsim clients
     *
     * @return array
     */
    public function getClients(): array
    {
        $data = $this->retrieveVatsimData();
        return array_values($this->dataTrimmer->trim($data, '!CLIENTS:', $this->dataParser, 'clientsParser'));
    }

    /**
     * get all vatsim servers
     *
     * @return array
     */
    public function getServers() : array
    {
        $data = $this->retrieveVatsimData();
        return  array_values($this->dataTrimmer->trim($data, '!SERVERS:', $this->dataParser, 'serversParser'));
    }

    /**
     * array get all vatsim prefile plans
     *
     * @return array
     */
    public function getPreFile() : array
    {
        $data = $this->retrieveVatsimData();
        return  array_values($this->dataTrimmer->trim($data, '!PREFILE:', $this->dataParser, 'clientsParser'));
    }

    /**
     * get voice servers
     *
     * @return array
     */
    public function getVoiceServers() : array
    {
        $data = $this->retrieveVatsimData();
        return  array_values($this->dataTrimmer->trim($data, '!VOICE SERVERS:', $this->dataParser, 'voiceServersParser'));
    }

    /**
     * show by type
     *
     * @param string $type
     * @return array
     */
    public function showByType($type = 'PILOT') : array
    {
        if ($type === 'PILOT') {
            return array_values(array_filter($this->getClients(), [$this->dataFilter, 'filterByPilot']));
        }

        return  array_values(array_filter($this->getClients(), [$this->dataFilter, 'filterByAtc']));
    }

    /**
     * show by airline code
     *
     * @param string $icao
     * @return array
     */
    public function showByAirline(string $icao = 'DLH') : array
    {
        $this->dataFilter->icao = $icao;
        return  array_values(array_filter($this->getClients(), [$this->dataFilter, 'filterByAirline']));
    }

    /**
     * show by callsign
     *
     * @param  int|null $callsign
     * @return array
     */
    public function showByCallsign(?int $callsign = null) : array
    {
        $this->dataFilter->callsign = $callsign;
        return array_values(array_filter($this->getClients(), [$this->dataFilter, 'filterbyCallSign']));
    }

    /**
     * show by vatsim id
     *
     * @param int|null $cid
     * @return array
     */
    public function showByVatsimId(?int $cid = null) : array
    {
        $this->dataFilter->cid = $cid;
        return array_values(array_filter($this->getClients(), [$this->dataFilter, 'filterbyId']));
    }

    /**
     * get number of pilots
     *
     * @return integer
     */
    public function getNumberOfPilots() : int
    {
        return count($this->showByType());
    }

    /**
     * get number of controllers
     *
     * @return integer
     */
    public function getNumberOfControllers() : int
    {
        return count($this->showByType('ATC'));
    }
}
