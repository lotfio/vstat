<p align="center">
  <img src="https://user-images.githubusercontent.com/18489496/49801711-30eccd00-fd4b-11e8-8743-9af2560c983e.png"  alt="Vstat Preview">
  <p align="center">
    <img src="https://img.shields.io/badge/Licence-MIT-ffd32a.svg" alt="License">
    <img src="https://img.shields.io/badge/PHP-7.4-808e9b.svg" alt="PHP version">
    <img src="https://img.shields.io/badge/Version-0.3.0-f53b57.svg" alt="Version">
    <img src="https://img.shields.io/badge/coverage-40%25-27ae60.svg" alt="Coverage">
    <img src="https://travis-ci.org/lotfio/vstat.svg?branch=master" alt="Build Status">
    <img src="https://github.styleci.io/repos/159562913/shield?branch=master" alt="StyleCi">
    </p>
  <p align="center">
    <strong>:airplane: Vatsim statistics API.</strong>
  </p>
</p>

### 🔥 Introduction :
VSTAT is a simple lightweight PHP API That helps you to get VATSIM statistics and data in simple, clean way.

### 📌 Requirements :
- PHP 7.4 or newer versions
- PHPUnit >= 9 (for testing purpose)

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

require 'vendor/autoload.php';

$vstat = new Vstat\Vstat;

print_r($vstat->getClients());
```

### :wrench: Config:
By default **VSTAT** is generating data each 5 minutes from `http://data.vatsim.net/vatsim-data.txt`
You can change the time of data loading to 2 - 3 minutes.
**Recommended** I recommend that you create a cron job on your host and update `vatsim-data.txt` file every minute
which will highly increase the loading speed of you application. (if you do so make sure to keep php cache time higher than the cron job).


### :inbox_tray: Available methods :
```php
// get all vatsim clients
$vstat->getClients();

// get prefile plans
$vstat->getPreFile();

// get vatsim servers
$vstat->getServers();

// get vatsim voice servers
$vstat->getVoiceServers();

// filters
// show by Type ATC or PILOT by default show by PILOT
$vstat->showByType('ATC');

// show by airline
$vstat->showByAirline('BAW');

// show by callsign
$vstat->showByCallsign('BAW96');

// show by vatsim id
$vstat->showByVatsimId(131);

// get number of pilots
$vstat->getNumberOfPilots();

// get number of controllers
$vstat->getNumberOfControllers();
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