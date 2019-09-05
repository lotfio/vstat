<p align="center">
  <img src="https://user-images.githubusercontent.com/18489496/49801711-30eccd00-fd4b-11e8-8743-9af2560c983e.png"  alt="Vstat Preview">
  <p align="center">
    <img src="https://img.shields.io/badge/Licence-MIT-ffd32a.svg" alt="License">
    <img src="https://img.shields.io/badge/PHP-7.2-808e9b.svg" alt="PHP version">
    <img src="https://img.shields.io/badge/Version-0.1.5-f53b57.svg" alt="Version">
    <img src="https://img.shields.io/badge/coverage-40%25-27ae60.svg" alt="Coverage">
    <img src="https://travis-ci.org/lotfio/vstat.svg?branch=master" alt="Build Status">
    <img src="https://github.styleci.io/repos/159562913/shield?branch=master" alt="StyleCi">
    </p>
  <p align="center">
    <strong>:airplane: PHP Vatsim statistics package.</strong>
  </p>
</p>

### 🔥 Introduction :
VSTAT is a simple lightweight PHP MIT Package developed by Lotfio Lakehal That helps you to get VATSIM statistics and data in simple clean and easy way.

### 📌 Requirements :
- PHP 7.2 or newer versions
- PHPUnit >= 8 (for testing purpose)

### :ok_hand: Features :
- Easy to use.
- Simple installation one line command with composer.
- Get all Vatsim Data.
- Get VATSIM servers data.
- Get clients data.
- Cache data to speed up the loading process.

### 🚀 Installation & Use :
```
    composer require lotfio/vstat
```

### :pencil2: Use it :
```php
use Vstat\App\{DataParser,DataTrimmer,DataFilter,Vstat};
require 'vendor/autoload.php';

$trimmer = new DataTrimmer;
$parser  = new DataParser;
$filter  = new DataFilter;

$vstat = new Vstat($trimmer, $parser, $filter);

print_r($vstat->getClients());
```

### :wrench: Config:
**Config file** is located inside `Vstat/config/app.php` where you can change vatsim data url, cache time and cache location.

By default **VSTAT** is generating data each 5 minutes from `http://vatsim-data.hardern.net/vatsim-data.txt`
You can change the time of data loading to 2 - 3 minutes.
**Recommended** I recommend that you create a cron job on your host and update `vatsim-data.txt` file every minute
which will highly increase the loading speed of you application. (if you do so make sure to keep php cache time higher than the cron job).


### :inbox_tray: Available methods :
```php
// get all vatsim clients
print_r(($vstat->getClients()));

// get profile plans
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

// show by callSing
print_r(($vstat->showByCallsign('BAW96')));

// show by vatsim id
print_r(($vstat->showByVatsimId(131)));

// get number of pilots
print_r(($vstat->getNumberOfPilots()));

// get number of controllers
print_r(($vstat->getNumberOfControllers()));

// get number of clients connected with the same airline
echo count($vstat->showByAirline('DAH'));

// get data as json format
print_r(json_encode($vstat->showByAirline('DAH')));
```

### :computer: Contributing

- Thank you for considering to contribute to Ouch. All the contribution guidelines are mentioned [here](CONTRIBUTE.md).

### :page_with_curl: ChangeLog

- Here you can find the [ChangeLog](CHANGELOG.md).

### :beer: Support the development

- Share ***VSTAT*** and lets get more stars and more contributors.
- If this project helped you reduce time to develop, you can give me a cup of coffee :) : **[Paypal](https://www.paypal.me/lotfio)**. 💖

### :clipboard: License

- ***VSTAT*** is an open-source software licensed under the [MIT license](LICENSE).