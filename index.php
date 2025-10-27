<?php
global $env;
global $rootPath;
$rootPath = __DIR__;

require 'vendor/autoload.php';
require __DIR__ . '/lib/index.php';

$env = parseEnvFile(__DIR__ . '/.env');


if ($_SERVER['REQUEST_URI'] == '/') {
	echo $blade->make('pages.home')->render();
} elseif ($_SERVER['REQUEST_URI'] == '/about') {
	echo $blade->make('pages.about')->render();
} else {
	http_response_code(404);
}
