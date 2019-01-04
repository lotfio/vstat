<?php

namespace Vstat\App;

use Vstat\Contracts\DataParserInterface;

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
class DataParser implements DataParserInterface
{
    /**
     * @var array clients array keys
     */
    public $clientsKeys = [
        'callsign', 'cid',
        'realname', 'clienttype',
        'frequency', 'latitude',
        'longitude', 'altitude',
        'groundspeed', 'planned_aircraft',
        'planned_tascruise', 'planned_depairport',
        'planned_altitude', 'planned_destairport',
        'server', 'protrevision',
        'rating', 'transponder',
        'facilitytype', 'visualrange',
        'planned_revision', 'planned_flighttype',
        'planned_deptime', 'planned_actdeptime',
        'planned_hrsenroute', 'planned_minenroute',
        'planned_hrsfuel', 'planned_minfuel',
        'planned_altairport', 'planned_remarks',
        'planned_route', 'planned_depairport_lat',
        'planned_depairport_lon', 'planned_destairport_lat',
        'planned_destairport_lon', 'atis_message',
        'time_last_atis_received', 'time_logon',
        'heading', 'QNH_iHg', 'QNH_Mb',
    ];

    /**
     * @var array servers array keys
     */
    public $serversKeys = [
        'ident', 'hostname_or_IP',
        'location', 'name', 'clients_connection_allowed',
    ];

    /**
     * @var array voice servers array keys
     */
    public $voiceServersKeys = [
        'hostname_or_IP', 'location', 'name',
        'clients_connection_allowed', 'type_of_voice_server',
    ];

    /**
     * @param $array array array of clients coming from dataTrimmer
     *
     * @return array combining keys and values coming from DataParser
     */
    public function clientsParser(array $array) : array
    {
        /*
         * slice array and make it 41 elements to fit the keys array
         * without slice sometimes it causes problems when clients enter
         * additional information
         */
        return array_combine($this->clientsKeys, array_slice($array, 0, 41));
    }

    /**
     * @param $array array array of clients coming from dataTrimmer
     *
     * @return array combining keys and values coming from DataParser
     */
    public function serversParser(array $array) : array
    {
        return array_combine($this->serversKeys, array_slice($array, 0, 5));
    }

    /**
     * @param $array array array of clients coming from dataTrimmer
     *
     * @return array combining keys and values coming from DataParser
     */
    public function voiceServersParser(array $array) : array
    {
        return array_combine($this->voiceServersKeys, array_slice($array, 0, 5));
    }
}
