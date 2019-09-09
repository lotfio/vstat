<?php

declare(strict_types=1);

use Vstat\Vstat;

require 'vendor/autoload.php';

// get all vatsim clients
print_r((Vstat::getClients()));

// get prefile plans
print_r((Vstat::getPreFile()));

// get vatsim servers
print_r((Vstat::getServers()));

// get vatsim voice servers
print_r((Vstat::getVoiceServers()));

// filters
// show by Type ATC or PILOT by default show by PILOT
print_r((Vstat::showByType('ATC')));

// show by airline
print_r((Vstat::showByAirline('BAW')));

// show by callsign
print_r((Vstat::showByCallsign('BAW96')));

// show by vatsim id
print_r((Vstat::showByVatsimId(131)));

// get number of pilots
print_r((Vstat::getNumberOfPilots()));

// get number of controllers
print_r((Vstat::getNumberOfControllers()));

// get number of clients connected with the same airline
echo count(Vstat::showByAirline('DAH'));

// get data as json formt
print_r(json_encode(Vstat::showByAirline('DAH')));
