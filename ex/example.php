<?php

declare(strict_types=1);

require 'vendor/autoload.php';

$vstat = new Vstat\Vstat;

// get all vatsim clients
print_r($vstat->getClients());

// get prefile plans
print_r($vstat->getPreFile());

// get vatsim servers
print_r($vstat->getServers());

// get vatsim voice servers
print_r($vstat->getVoiceServers());

// filters
// show by Type ATC or PILOT by default show by PILOT
print_r($vstat->showByType('ATC'));

// show by airline
print_r($vstat->showByAirline('BAW'));

// show by callsign
print_r($vstat->showByCallsign('BAW96'));

// show by vatsim id
print_r($vstat->showByVatsimId(131));

// get number of pilots
print_r($vstat->getNumberOfPilots());

// get number of controllers
print_r($vstat->getNumberOfControllers());

// get number of clients connected with the same airline
echo count($vstat->showByAirline('DAH'));

// get data as json formt
print_r(json_encode($vstat->showByAirline('DAH')));
