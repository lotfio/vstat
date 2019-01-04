<?php

/**
 * Vstat is an open source PHP API That
 * helps you get live statistics About Vatsim
 * (Virtual Air Traffic Simulation Network)
 * This package is developed and maintained
 * by lotfio lakehal.
 * 
 * @package     Vstat
 * @version     0.1.0
 * @author      Lotfio Lakehal <contact@lotfio.net>
 * @copyright   Lotfio Lakehal 2018
 * @license     MIT
 * @link        https://github.com/lotfio/vstat
 * 
 */
 
 return [

 	// vatsim data file url
 	"vatsimDataUrl" => "https://vstat.lotfio.net/vatsim-data.txt",

 	// location where data file is cached
 	// you can use a cron job to load this file each
 	// 4 to 5 mintes instead of downloading it with php 
 	// this will increase the speed of your app
 	"cacheFile"     => dirname(__DIR__) . DIRECTORY_SEPARATOR . 'cache' . DIRECTORY_SEPARATOR . 'vatsim-data.txt',
 	
 	// in case of using cron job make sure that this cache time is higer than the cron job time
 	// to avoid php reload this file
 	"cacheTime"     => 500, // time in minutes 
 ];