<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if (SITE_LIVE)
{
    //Live site database settings.
    $active_group = "default";
}
else 
{
    $active_group = "offline";
}


$query_builder = TRUE;

$db['offline'] = array(

	

	'username' => 'root',
	'password' => '',
	'database' => 'ci_ready_admin',
	'dsn'	=> '',
	'hostname' => 'localhost',
	'dbdriver' => 'mysqli',
	'dbprefix' => '',
	'pconnect' => FALSE,
	'db_debug' => (ENVIRONMENT !== 'production'),
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


$db['default'] = array(

	
	'username' => '',
	'password' => '',
	'database' => '',
	'dsn'	=> '',
	'hostname' => 'localhost',
	'dbdriver' => 'mysqli',
	'dbprefix' => '',
	'pconnect' => FALSE,
	'db_debug' => (ENVIRONMENT !== 'production'),
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


