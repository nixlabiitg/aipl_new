<?php
defined('BASEPATH') or exit('No direct script access allowed');

$active_group = 'default';
$query_builder = TRUE;

$db['default'] = array(
	'dsn'	=> '',
	'hostname' => 'localhost',
	// for server
	'username' => $_SERVER['HTTP_HOST'] == 'localhost' ? 'root' : 'u441502015_aipl',
	'password' => $_SERVER['HTTP_HOST'] == 'localhost' ? 'Otechnix@123' :'Otechnix@123#',
	'database' => $_SERVER['HTTP_HOST'] == 'localhost' ? 'aipl' : 'u441502015_aipl',
	// for local
	
	'dbdriver' => 'mysqli',
	'dbprefix' => '',
	'pconnect' => FALSE,
	'db_debug' => (ENVIRONMENT !== 'development'),
	'cache_on' => FALSE,
	'cachedir' => '',
	'char_set' => 'utf8',
	'dbcollat' => 'utf8_general_ci',
	'swap_pre' => '',
	'encrypt' => FALSE,
	'compress' => FALSE,
	'stricton' => FALSE,
	'failover' => array(),
	'save_queries' => TRUE
);
