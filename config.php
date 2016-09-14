<?php

require 'environment.php';

$hostname = getenv("USERNAME");

global $config;

$config = array();
if (ENVIRONMENT == 'development' && $hostname == 'JORGITO-NB') {
    $config['dbname'] = 'conta';
    $config['host'] = 'localhost';
    $config['dbuser'] = 'rootnb';
    $config['dbpass'] = '!Camelo69';
	$config['ambiente'] = ENVIRONMENT;
	$config['hostname'] = $hostname;
} elseif (ENVIRONMENT == 'development' && $hostname == 'JORGITO-PC') {
    $config['dbname'] = 'conta';
    $config['host'] = 'localhost';
    $config['dbuser'] = 'root';
    $config['dbpass'] = 'camelo69';
	$config['ambiente'] = ENVIRONMENT;
	$config['hostname'] = $hostname;
} else if (ENVIRONMENT == 'development' && $hostname == 'jorgito.paiva') {
	$config['dbname'] = 'conta';
    $config['host'] = 'localhost';
    $config['dbuser'] = 'root';
    $config['dbpass'] = 'root';
	$config['ambiente'] = ENVIRONMENT;
	$config['hostname'] = $hostname;
}

