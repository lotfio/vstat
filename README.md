# Vatsim Statistics API
![Vstat Logo](https://user-images.githubusercontent.com/18489496/49801711-30eccd00-fd4b-11e8-8743-9af2560c983e.png)


![licence](https://img.shields.io/badge/Licence-MIT-ffd32a.svg)
![language](https://img.shields.io/badge/PHP-7.2-808e9b.svg)
![version](https://img.shields.io/badge/Version-0.1.0-f53b57.svg)
![coverage](https://img.shields.io/badge/coverage-50%25-blue.svg)
![build](https://travis-ci.org/lotfio/vstat.svg?branch=master)
# Introduction :
VSTAT is a simple lightweight PHP MIT API developed by Lotfio Lakehal That help you to get VATSIM statistics and data in simple clean and easy way.

## Features :
- Easy to use.
- Simple instalation one line command with composer.
- Get all Vatsim Data.
- Get VATSIM servers data.
- Get clients data.
- Cache data to speed up the loading process.

## Instalation & Use :
```
    composer require lotfio/vstat
```

### Use it:
```php 
use Vstat\App\{DataParser,DataTrimmer,DataFilter,Vstat};
require 'vendor/autoload.php';

$trimmer = new DataTrimmer;
$parser  = new DataParser;
$filter  = new DataFilter;

$vstat = new Vstat($trimmer, $parser, $filter);

print_r($vstat->getClients());
```

### Config:
**Config file** is located inside `Vstat/config/app.php` where you can change vatsim data url, cache time and cache location.

By default **VSTAT** is generting data each 5 minutes from `https:vstat.lotfio.net/vatsim-data.txt`
You can change the time of data loading to 2 - 3 minutes.
**Recommended** I recommand that you create a cron job on your host and update `vatsim-data.txt` file every minute
which will highly increase the loading speed of you application. (if you do so make sure to keep php cache time higher than the cron job).


### Available methods :
```php
// get all vatsim clients
print_r(($vstat->getClients()));

// get prefile plans
print_r(($vstat->getPreFile()));

// get vatsim servers
print_r(($vstat->getServers()));

// get vatsim voice servers
print_r(($vstat->getVoiceServers()));

// filters
// show by Type ATC or PILOT by default show by PILOT
print_r(($vstat->showByType('ATC')));

// show by airline
print_r(($vstat->showByAirline('BAW')) );

// show by callsign
print_r(($vstat->showByCallsign('BAW96')));

// show by vatsim id
print_r(($vstat->showByVatsimId(131)));

// get number of pilots
print_r(($vstat->getNumberOfPilots()));

// get number of controllers
print_r(($vstat->getNumberOfControllers()));

// get number of clients connected with the same airline
echo count($vstat->showByAirline('DAH'));

// get data as json formt 
print_r(json_encode($vstat->showByAirline('DAH')));
```



## Contributing

Thank you for considering to contribute to Ouch. All the contribution guidelines are mentioned [here](CONTRIBUTE.md).

## ChangeLog

Here you can find the [ChangeLog](CHANGELOG.md).

## Support the development

- Share **VSTAT** and lets get more stars and more contributors.

## License

***VSTAT*** is an open-source software licensed under the [MIT license](LICENSE).