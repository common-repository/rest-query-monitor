<?php
/*
Plugin Name: REST Query Monitor
Plugin URI: https://perryrylance.com/rest-query-monitor
Author: Perry Rylance
Author URI: https://perryrylance.com
Description: This plugin will add dumps of SQL queries to REST response headers, for debugging REST systems.
Version: 1.0.1
Requires at least: 4.4.0
Requires PHP: 5.4
License: Apache License 2.0
Text Domain: rest-query-monitor
*/

namespace PerryRylance\WordPress\RestQueryMonitor;

require_once("autoload.php");

$restQueryMonitor = new Plugin();
