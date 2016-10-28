<?php

// This is the database connection configuration.
return array(
	//'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
	// uncomment the following lines to use a MySQL database

	'connectionString' => 'mysql:host=localhost;dbname=myii_data',
	'emulatePrepare' => true,
	'username' => 'demo',
	'password' => 'demo',
	'charset' => 'utf8',
	'class'=>'CDbConnection',
);