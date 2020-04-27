<?php

use App\DevTools;
use App\LibsLoader;
use App\Models\Player;
use App\Models\Stats;

$loader = require '../vendor/autoload.php';

$libsLoader = new LibsLoader();
$libsLoader->loadLibraries();
$tools = new DevTools();
